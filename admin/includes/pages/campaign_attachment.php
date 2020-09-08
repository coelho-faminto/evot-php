<?php
require_once __DIR__ . '/../controllers/campaign_attachment.php';
require_once __DIR__ . '/../views/campaign_attachment.php';
require_once __DIR__ . '/page.php';
require_once __DIR__ . '/../templates/campaign_attachment/create.php';
require_once __DIR__ . '/../templates/campaign_attachment/view.php';
require_once __DIR__ . '/../templates/campaign_attachment/delete.php';
require_once __DIR__ . '/../templates/campaign_attachment/list.php';
require_once __DIR__ . '/../templates/generic/link.php';

class CampaignAttachmentPage extends Page
{
    public function create()
    {
        $error_messages = [];
        $success_messages = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $controller = new CampaignAttachmentController();

            try {
                $id = $controller->create();

                if ($id) {
                    $id_html = urlencode(htmlspecialchars($id, ENT_QUOTES));
                    $id_link = (new LinkTemplate())->html(
                        "'{$id}'",
                        "?page=campaign_attachment&action=view&id={$id_html}",
                        ['alert-link']
                    );

                    $success_messages[] = "Campaign -> attachment relational data inserted as {$id_link} into database successfully.";
                } else {
                    $error_message = $controller->model->db->getLastError();

                    $error_messages[] = "Could not insert relational between attachment and campaign data in database: {$error_message}";
                }
            } catch (\Exception $e) {
                $error_messages[] = $e->getMessage();
            }
        }

        $item = [];

        if (!empty($_REQUEST['id'])) {
            $view = new CampaignAttachmentView();

            $item = $view->getById();
        } elseif (!empty($error_messages)) {
            $item = $_REQUEST;
        }

        $viewCampaign = new CampaignView();
        $viewCampaign->model->db->orderBy('id');

        $campaigns = $viewCampaign->model->db->get($viewCampaign->model->table_name);

        $viewAttachment = new AttachmentView();
        $viewAttachment->model->db->orderBy('id');

        $attachments = $viewAttachment->model->db->get($viewAttachment->model->table_name);

        return (new CreateCampaignAttachmentTemplate())->html($success_messages, $error_messages, $item, $campaigns, $attachments);
    }

    public function list()
    {
        /*
        $view = new CampaignAttachmentView();

        $view->model->db->orderBy('updatedAt');
        $items = $view->model->db->get($view->model->table_name, 10);
        */

        $view = new CampaignAttachmentView();
        $viewCampaign = new CampaignView();
        $viewAttachment = new AttachmentView();

        $view->model->db->join("{$viewCampaign->model->table_name} c", 't.campaign_id=c.id', 'LEFT');
        $view->model->db->join("{$viewAttachment->model->table_name} a", 't.attachment_id=a.id', 'LEFT');

        //$item = $view->getById();

        $view->model->db->orderBy('updatedAt');
        $items = $view->model->db->get("{$view->model->table_name} t", 10, 't.*, c.title AS campaign_title, a.title AS attachment_title, a.url');

        return (new ListCampaignAttachmentTemplate())->html($items);
    }

    public function view()
    {
        $view = new CampaignAttachmentView();
        $viewCampaign = new CampaignView();
        $viewAttachment = new AttachmentView();

        $id = !empty($_REQUEST['id']) ? $_REQUEST['id'] : '';

        $view->model->db->join("{$viewCampaign->model->table_name} c", 't.campaign_id=c.id', 'LEFT');

        $view->model->db->join("{$viewAttachment->model->table_name} a", 't.attachment_id=a.id', 'LEFT');

        //$item = $view->getById();

        $view->model->db->where('t.id', $id);

        $item = $view->model->db->getOne("{$view->model->table_name} t", 't.*, c.title AS campaign_title, a.title AS attachment_title, a.url');

        //var_dump($view->model->db->getLastQuery());

        if (!$item) {
            throw new \Exception('Not found');
            return false;
        }

        return (new ViewCampaignAttachmentTemplate())->html($item);
    }

    public function delete()
    {
        $view = new CampaignAttachmentView();

        $item = $view->getById();

        if (!$item) {
            throw new \Exception('Not found');
            return false;
        }

        if (!isset($_REQUEST['confirm'])) {
            return (new DeleteCampaignAttachmentTemplate())->confirm($item);
        }

        $controller = new CampaignAttachmentController();

        $success_messages = [];
        $error_messages = [];

        $controller->model->db->where('id', $item['id']);
        if ($controller->model->db->delete($controller->model->table_name)) {
            $success_messages[] = "O vínculo entre a campanha e o anexo '{$item['id']}' foi removido com sucesso";
        } else {
            $error_message = $controller->model->db->getLastError();
            $error_messages[] = "Erro ao remover o vínculo entre a campanha e o anexo '{$item['id']}': {$error_message}";
        }

        return (new DeleteCampaignAttachmentTemplate())->deleted($success_messages, $error_messages);
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
