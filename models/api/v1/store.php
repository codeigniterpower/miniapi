<?php
/**!
 * @package   miniapi-webdb
 * @filename  api list.php model
 * @route     >api>v1>store
 * @version   1.0
 */

class api_v1_store_model extends model {

  public function notFound() {
    $this->borrow('notFoundApi')->show();
  }

  public function show() {
    $errormessage = 'function not found or parameters are incorrect';
    $httpcode = 404;
    $variables = array('message'=>$errormessage,'httpcode'=>$httpcode);
    $this->renderOutput($variables,true);
  }

}
