<?php
require_once __DIR__ . '/../controllers/attachment.php';
require_once __DIR__ . '/../views/attachment.php';
require_once __DIR__ . '/page.php';
require_once __DIR__ . '/../templates/attachment/create.php';
require_once __DIR__ . '/../templates/attachment/view.php';
require_once __DIR__ . '/../templates/attachment/delete.php';
require_once __DIR__ . '/../templates/attachment/list.php';
require_once __DIR__ . '/../templates/generic/link.php';

class AttachmentPage extends Page
{
    public function create()
    {
        $error_messages = [];
        $success_messages = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $controller = new AttachmentController();

            try {
                $id = $controller->create();

                if ($id) {
                    $id_html = urlencode(htmlspecialchars($id, ENT_QUOTES));
                    $id_link = (new LinkTemplate())->html(
                        "'{$id}'",
                        "?page=attachment&action=view&id={$id_html}",
                        ['alert-link']
                    );

                    $success_messages[] = "Attachment data inserted as {$id_link} into database successfully.";
                } else {
                    $error_message = $controller->model->db->getLastError();

                    $error_messages[] = "Could not insert attachment data to database: {$error_message}";
                }
            } catch (\Exception $e) {
                $error_messages[] = $e->getMessage();
            }
        }

        $item = [];

        if (!empty($_REQUEST['id'])) {
            $view = new AttachmentView();

            $item = $view->getById();
        } elseif (!empty($error_messages)) {
            $item = $_REQUEST;
        }

        return (new CreateAttachmentTemplate())->html($success_messages, $error_messages, $item);
    }

    public function list()
    {
        $view = new AttachmentView();

        $view->model->db->orderBy('updatedAt');
        $items = $view->model->db->get($view->model->table_name, 10);

        return (new ListAttachmentTemplate())->html($items);
    }

    public function view()
    {
        /*
        $view = new AttachmentView();

        $item = $view->getById();

        if (!$item) {
            throw new \Exception('Not found');
            return false;
        }
        */

        $view = new CampaignAttachmentView();

        $id = !empty($_REQUEST['id']) ? $_REQUEST['id'] : '';
        $id = $view->model->db->escape($id);

        $item = $view->model->db->rawQuery("
        SELECT
            (
                SELECT CONCAT('[', GROUP_CONCAT(
                            JSON_OBJECT('id', id, 'title', title, 'description', description, 'url', url) SEPARATOR ', '), ']') AS campaigns 
                FROM campaign AS c
                WHERE c.id in (
                    SELECT campaign_id FROM campaign_attachment WHERE attachment_id={$id}
                )
            ) AS campaign_json, a.* FROM attachment AS a WHERE a.id={$id}
        
        ");

        $item = $item ? $item[0] : false;

        if (!$item) {
            throw new \Exception('Not found');
            return false;
        }

        return (new ViewAttachmentTemplate())->html($item);
    }

    public function delete()
    {
        $view = new AttachmentView();

        $item = $view->getById();

        if (!$item) {
            throw new \Exception('Not found');
            return false;
        }

        if (!isset($_REQUEST['confirm'])) {
            return (new DeleteAttachmentTemplate())->confirm($item);
        }

        $controller = new AttachmentController();

        $success_messages = [];
        $error_messages = [];

        $controller->model->db->where('id', $item['id']);
        if ($controller->model->db->delete($controller->model->table_name)) {
            $success_messages[] = "O anexo '{$item['id']}' foi removido com sucesso";
        } else {
            $error_message = $controller->model->db->getLastError();
            $error_messages[] = "Erro ao remover o anexo '{$item['id']}': {$error_message}";
        }

        return (new DeleteAttachmentTemplate())->deleted($success_messages, $error_messages);
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
