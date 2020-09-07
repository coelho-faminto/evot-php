<?php
require_once __DIR__ . '/_view.php';
require_once __DIR__ . '/../models/attachment.php';

class AttachmentView extends View
{
    public $model;

    public function __construct()
    {
        $this->model = new AttachmentModel();
    }

    public function getAttachmentById($id = '')
    {
        if (empty($id)) {
            $id = !empty($_REQUEST['id']) ? $_REQUEST['id'] : '';
        }

        $this->model->db->where('id', $id);
        return $this->model->db->getOne($this->model->table_name);
    }
}
