<?php
/**!
 * @package   miniapi-webdb
 * @filename  api/api.php controller
 * @route     >api
 * @version   1.0
 */
class api_api_model extends model {

    public function notFound() {
        $this->borrow('notFound')->show();
    }

    public function show() {
        $httpcode = 200;
        include(DIR_VIEWS."apiview.php");
    }
}
