<?php
/**!
 * @package   miniapi-webdb
 * @filename  lists.php controller
 * @route     >api>v1>lists
 * @version   1.0
 */
class api_v1_lists_controller extends controller {

    public function execute($post = null) {

        $parameters = array(0=>"lists");

        $parameters = $this->router->parameters;
        
        foreach($parameters as $key => $value) {
            $$value = $value;
        }

        $this->model->show();

        return;
    }

}
