<?php
class Page
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
}
