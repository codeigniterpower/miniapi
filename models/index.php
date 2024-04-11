<?php
/**!
 * @package   miniapi-webdb
 * @filename  index.php model
 * @route     >index
 * @version   1.0
 */
class index_model extends model {

  public function notFound() {
    $this->borrow('notFound')->show();
  }

  public function show() {
    $httpcode = 200;
    include(DIR_VIEWS."index.php");
  }
}
