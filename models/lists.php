<?php
/**!
 * @package   miniapi-webdb
 * @filename  lists.php model
 * @route     >lists
 * @version   1.0
 */
class lists_model extends model {

  public function notFound() {
    $this->borrow('notFound')->show();
  }

  public function show() {
    $httpcode = 200;
    include(DIR_VIEWS."index.php");
  }

}
