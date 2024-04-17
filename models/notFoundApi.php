<?php
/**!
 * @package   skindb-webdb
 * @filename  notFoundApi_model.php controller
 * @route     >api>notfound
 * @version   1.0
 */
class notFoundApi_model extends model {

    public function show($errormessage = 'function and/or argument not found or parameters are incorrect') {
    
        $variables = array('message'=>$errormessage,'httpcode'=>'404');
        $this->renderOutput($variables,'json');
    }

}
