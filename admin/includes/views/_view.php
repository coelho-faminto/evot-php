<?php
// this class needs always to be extended, cannot be used directly
class View
{
    public function getById($id = '')
    {
        if (empty($id)) {
            $id = !empty($_REQUEST['id']) ? $_REQUEST['id'] : '';
        }

        $this->model->db->where('id', $id);
        return $this->model->db->getOne($this->model->table_name);
    }
}
