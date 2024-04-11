<?php
/**!
 * @package   miniapi-webdb
 * @filename  api/api.php controller
 * @route     >api
 * @version   1.0
 */
class api_api_controller extends controller {

  public function execute() {
        $this->model->show();
  }
}
