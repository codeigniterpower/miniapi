<?php

/*la clase del modelo*/

abstract class model {

    protected $db = null;
    protected $auth = null;
    protected $router = null;
    public $view = null;

    /* Constructor
     *
     * INPUT: object database, object settings, object user, object page, object view[, object language]
     * OUTPUT: -
     * ERROR:  -
     */
    public function __construct($db, $auth, $router, $view) {
        $this->db = $db;
        $this->auth = $auth;
        $this->router = $router;
        $this->view = $view;
    }

    /**
     * Crea el ID loco de PICCORO posta no es loco.. 
     * allows touse autoincremnet ODBC compiland and SQL ansi!
     * con esto identificas varias cosas, fecha, donde cuando 
     * ah y de paso se ordena solo ya que nunca dara unnumero menor
     * @return string YYYYMMDDHHmmss
     */
    private function mkid() {
        return date('YmdHis');
    }

    /* Borrow function from other model
     *
     * INPUT:  string module name
     * OUTPUT: object model
     * ERROR:  null
     */
    protected function borrow($module) {
        if (file_exists($file = "../models/".$module.".php") == false) {
            header("Content-Type: text/plain");
            printf("Can't borrow model '%s'.\n", $module);
            exit();
        }

        require_once($file);

        $model_class = str_replace("/", "_", $module)."_model";
        if (class_exists($model_class) == false) {
            return null;
        } else if (is_subclass_of($model_class, "model") == false) {
            return null;
        }

        return new $model_class($this->db, $this->auth, $this->router, $this->view);
    }

    /*implemnetacion basica vistas sin mucho paja*/
    public function view($viewfile = null, $data = null) {

        if(is_array($data)) {
            foreach ($data as $key => $value) {
                $this->values[$key] = $value;
                $this->$key = $value;
                $$key = $value;
            }
        }

        if (file_exists($viewfile = DIR_VIEWS . $viewfile.".php")) {
            $this->view = $viewfile;
            include($this->view);
        }
    }

    /* show api output in json format
     *
     * INPUT:  array
     * OUTPUT: string
     * ERROR:  null
     */
    protected function renderOutput($variables, $jsonout = false) {

        $contentt = 'Content-Type: text/plain';
        $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
        $httpcode = '412';
        $sucess = false;
        $message = 'No message was specified, the server could not process the content or the page does not exist';
        $page = 1;
        $pages = 1;
        $per_page = 1;
        $data = array($message);

        if(is_array($variables) ) {
            foreach($variables as $key => $value) {
                $$key = $value;
            }
        }

        $GLOBALS['http_response_code'] = $httpcode;
        if( !is_null($jsonout) and !empty($jsonout)) {
            $contentt = 'Content-Type: application/json; charset=utf-8';
            header($contentt);
            $jsondata = array(
                    'sucess' => $sucess,
                    'message' => $message,
                    'page' => $page,
                    'pages' => $pages,
                    'per_page' => $per_page,
                    'data'=> $data
                );
            print(json_encode($jsondata));
        }
        else {
            $contentt = 'Content-Type: text/html; charset=UTF-8';
            header($contentt);
            include(DIR_VIEWS."notfoundview.php");
        }
    }
}
