<?php
/**!
 * @package   miniapi-webdb
 * @filename  index.php controller
 * @route     >index
 * @version   1.0
 */
class index_controller extends controller {

  public function execute() {
        $this->model->show();
  }
}
