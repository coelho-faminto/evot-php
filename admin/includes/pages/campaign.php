<?php
require_once __DIR__ . '/../controllers/campaign.php';
require_once __DIR__ . '/../views/campaign.php';
require_once __DIR__ . '/../views/campaign_attachment.php';
require_once __DIR__ . '/../views/attachment.php';
require_once __DIR__ . '/page.php';
require_once __DIR__ . '/../templates/campaign/create.php';
require_once __DIR__ . '/../templates/campaign/view.php';
require_once __DIR__ . '/../templates/campaign/delete.php';
require_once __DIR__ . '/../templates/campaign/list.php';
require_once __DIR__ . '/../templates/generic/link.php';

class CampaignPage extends Page
{
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

            $item = $view->getById();
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
        $view = new CampaignAttachmentView();

        $id = !empty($_REQUEST['id']) ? $_REQUEST['id'] : '';
        $id = $view->model->db->escape($id);

        /*
        $view->model->db->join("{$viewCampaign->model->table_name} c", 't.campaign_id=c.id', 'RIGHT');

        $view->model->db->join("{$viewAttachment->model->table_name} a", 't.attachment_id=a.id', 'LEFT');
        */

        //$item = $view->getById();

        //$view->model->db->where('c.id', $id);

        //$item = $view->model->db->getOne("{$view->model->table_name} t", 't.*, c.title AS campaign_title, a.title AS attachment_title');

        $item = $view->model->db->rawQuery("
        SELECT
            (
                SELECT CONCAT('[', GROUP_CONCAT(
                            JSON_OBJECT('id', id, 'title', title, 'description', description, 'url', url) SEPARATOR ', '), ']') AS attachments 
                FROM attachment AS a
                WHERE a.id in (
                    SELECT attachment_id FROM campaign_attachment WHERE campaign_id={$id}
                )
            ) AS attachment_json, c.* FROM campaign AS c WHERE c.id={$id}
        
        ");

        $item = $item ? $item[0] : false;

        //var_dump($view->model->db->getLastQuery());

        if (!$item) {
            throw new \Exception('Not found');
            return false;
        }

        return (new ViewCampaignTemplate())->html($item);
    }

    public function delete()
    {
        $view = new CampaignView();

        $item = $view->getById();

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
