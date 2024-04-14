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
        $arguments = array('id'=>-1);

        $parameters = $this->router->parameters;
        foreach($parameters as $key => $value) {
            $$key = $value;
        }
        $arguments = array_merge($arguments, $_GET);
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            foreach($_GET as $keyp => $valuep) {
                $$keyp = $valuep;
            }
        }
        $arguments = array_merge($arguments, $_POST);
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            foreach($_POST as $keyp => $valuep) {
                $$keyp = $valuep;
            }
        }

        $this->model->processdata($parameters, $arguments);

        $this->model->show();

        return;
    }
}
