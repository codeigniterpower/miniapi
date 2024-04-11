<?php
/**!
 * @package   skindb-webdb
 * @filename  lists.php controller
 * @route     >lists
 * @version   1.0
 */
class lists_controller extends controller {

    public function execute($post = null) {
        $this->model->show();
        return;
    }

}
