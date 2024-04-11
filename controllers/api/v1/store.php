<?php
/**!
 * @package   miniapi-webdb
 * @filename  store.php controller
 * @route     >api>v1>store
 * @version   1.0
 */
class api_v1_store_controller extends controller {

    public function execute($post = null) {

        $parameters = array(0=>"store");

        $parameters = $this->router->parameters;
        
        foreach($parameters as $key => $value) {
            $$value = $value;
        }

        $this->model->show();

        return;
    }

}
