<?php
/**!
 * @package   miniapi-webdb
 * @filename  notFound_model.php model
 * @route     >notfound
 * @version   1.0
 */
class notFound_model extends model {

  public function show($errormessage = 'The page could not be found or was moved, or your request is not valid, please consult upstream') {
        $variables = array('message'=>$errormessage,'httpcode'=>'404');
        $this->renderOutput($variables);
  }

}
