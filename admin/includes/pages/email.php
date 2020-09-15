<?php
require_once __DIR__ . '/../controllers/email.php';
require_once __DIR__ . '/../views/email.php';
require_once __DIR__ . '/page.php';
require_once __DIR__ . '/../templates/email/create.php';
require_once __DIR__ . '/../templates/email/view.php';
require_once __DIR__ . '/../templates/email/delete.php';
require_once __DIR__ . '/../templates/email/list.php';
require_once __DIR__ . '/../templates/generic/link.php';

class EmailPage extends Page
{
    public function create()
    {
        $error_messages = [];
        $success_messages = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $controller = new EmailController();

            try {
                $id = $controller->create();

                if ($id) {
                    $id_html = urlencode(htmlspecialchars($id, ENT_QUOTES));
                    $id_link = (new LinkTemplate())->html(
                        "'{$id}'",
                        "?page=email&action=view&id={$id_html}",
                        ['alert-link']
                    );

                    $success_messages[] = "Email data inserted as {$id_link} into database successfully.";
                } else {
                    $error_message = $controller->model->db->getLastError();

                    $error_messages[] = "Could not insert email data to database: {$error_message}";
                }
            } catch (\Exception $e) {
                $error_messages[] = $e->getMessage();
            }
        }

        $item = [];

        if (!empty($_REQUEST['id'])) {
            $view = new EmailView();

            $item = $view->getById();
        } elseif (!empty($error_messages)) {
            $item = $_REQUEST;
        }

        return (new CreateEmailTemplate())->html($success_messages, $error_messages, $item);
    }

    public function list()
    {
        $view = new EmailView();

        $view->model->db->orderBy('updatedAt');
        $items = $view->model->db->get($view->model->table_name, 10);

        return (new ListEmailTemplate())->html($items);
    }

    public function view()
    {
        $view = new EmailView();

        $item = $view->getById();

        //$item = $item ? $item[0] : false;

        if (!$item) {
            throw new \Exception('Not found');
            return false;
        }

        return (new ViewEmailTemplate())->html($item);
    }

    public function delete()
    {
        $view = new EmailView();

        $item = $view->getById();

        if (!$item) {
            throw new \Exception('Not found');
            return false;
        }

        if (!isset($_REQUEST['confirm'])) {
            return (new DeleteEmailTemplate())->confirm($item);
        }

        $controller = new EmailController();

        $success_messages = [];
        $error_messages = [];

        $controller->model->db->where('id', $item['id']);
        if ($controller->model->db->delete($controller->model->table_name)) {
            $success_messages[] = "O E-Mail '{$item['id']}' foi removido com sucesso";
        } else {
            $error_message = $controller->model->db->getLastError();
            $error_messages[] = "Erro ao remover o E-Mail '{$item['id']}': {$error_message}";
        }

        return (new DeleteEmailTemplate())->deleted($success_messages, $error_messages);
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
