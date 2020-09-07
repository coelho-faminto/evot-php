<?php
require_once __DIR__ . '/../controllers/campaign.php';
require_once __DIR__ . '/../views/campaign.php';
require_once __DIR__ . '/page.php';
require_once __DIR__ . '/../templates/campaign/create.php';
require_once __DIR__ . '/../templates/campaign/view.php';
require_once __DIR__ . '/../templates/campaign/delete.php';
require_once __DIR__ . '/../templates/campaign/list.php';
require_once __DIR__ . '/../templates/generic/link.php';

class CampaignPage extends Page
{
    public function html()
    {
        $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'index';

        if (!method_exists($this, $action)) {
            $class_name = get_class($this);
            throw new \Exception("Method '{$action}' not found in '{$class_name}' page");
        }

        return $this->{$action}();
    }

    public function create()
    {
        $error_messages = [];
        $success_messages = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $controller = new CampaignController();

            try {
                $id = $controller->create();

                if ($id) {
                    $id_html = urlencode(htmlspecialchars($id, ENT_QUOTES));
                    $id_link = (new LinkTemplate())->html(
                        "'{$id}'",
                        "?page=campaign&action=view&id={$id_html}",
                        ['alert-link']
                    );

                    $success_messages[] = "Campaign data inserted as {$id_link} into database successfully.";
                } else {
                    $error_message = $controller->model->db->getLastError();

                    $error_messages[] = "Could not insert campaign data to database: {$error_message}";
                }
            } catch (\Exception $e) {
                $error_messages[] = $e->getMessage();
            }
        }

        $item = [];

        if (!empty($_REQUEST['id'])) {
            $view = new CampaignView();

            $view->model->db->where('id', $_REQUEST['id']);
            $item = $view->model->db->getOne($view->model->table_name);
        } elseif (!empty($error_messages)) {
            $item = $_REQUEST;
        }

        return (new CreateCampaignTemplate())->html($success_messages, $error_messages, $item);
    }

    public function list()
    {
        $view = new CampaignView();

        $view->model->db->orderBy('updatedAt');
        $items = $view->model->db->get($view->model->table_name, 10);

        return (new ListCampaignTemplate())->html($items);
    }

    public function view()
    {
        $view = new CampaignView();

        $item = $view->getCampaignById();

        if (!$item) {
            throw new \Exception('Not found');
            return false;
        }

        return (new ViewCampaignTemplate())->html($item);
    }

    public function delete()
    {
        $view = new CampaignView();

        $item = $view->getCampaignById();

        if (!$item) {
            throw new \Exception('Not found');
            return false;
        }

        if (!isset($_REQUEST['confirm'])) {
            return (new DeleteCampaignTemplate())->confirm($item);
        }

        $controller = new CampaignController();

        $success_messages = [];
        $error_messages = [];

        $controller->model->db->where('id', $item['id']);
        if ($controller->model->db->delete($controller->model->table_name)) {
            $success_messages[] = "A campanha '{$item['id']}' foi removida com sucesso";
        } else {
            $error_message = $controller->model->db->getLastError();
            $error_messages[] = "Erro ao remover a campanha '{$item['id']}': {$error_message}";
        }

        return (new DeleteCampaignTemplate())->deleted($success_messages, $error_messages);
    }

    public function edit()
    {
        return $this->create();
    }

    public function index()
    {
        return $this->create();
    }
}
