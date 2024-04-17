<?php
/**!
 * @package   miniapi-webdb
 * @filename  api list.php model
 * @route     >api>v1>lists
 * @version   1.0
 */

class api_v1_lists_model extends model {

    private $sql = null;

    private $errormessage = 'error, cannot store values of data, error on parameters or arguments or error in data storage';
    private $urlarguments = null;
    private $savedatafull = array('nodes_child'=>'-1');
    private $codehttpisok = 412;

    public function notFound() {
        $this->borrow('notFoundApi')->show();
    }

    public function processdata($parameter, $pagenm) {

        //api/vi/lists/<ced>

        $this->urlarguments = array('nodeid'=>$parameter, 'page'=>$pagenm);
        $validator   = new validator($this->urlarguments);
        $validations = array(
            'cedp' => array(
                'type'      => 'integer',
                "required"  => true
                ),
            );
        $check = $validator->execute($validations);

        $this->sucess = $check[0];
        if(! $this->sucess) {
            $this->errormessage = $check[1];
            return false;
        }

        $this->sucess = $this->_dbdatainit();
        if(! $this->sucess) {
            $this->errormessage = $this->errormessage.' please check DB layer structure!';
            return false;
        }
        $this->sucess = $this->_dbdatavars();

        $this->sucess = $this->_dbdatagets();
        if(! $this->sucess) {
            $this->errormessage = $this->errormessage.' Data error or no data/database';
            return false;
        }

        $this->errormessage = 'Data present, check "data" variable';
        $this->codehttpisok = 200;
        $this->sucess = true;
        return true;
    }

    private function _dbdatagets() {
        $results = false;
        $this->savedatafull = $this->db->execute($this->sql,$this->urlarguments['cedp']);
        if(is_array($this->savedatafull) and is_array($this->savedatafull[0]))
            $results = true;
        return $results;
    }

    private function _dbdatainit() {
        $results = -1;
        $this->errormessage = ' Database structure seems not ready';
        $this->sql = "SELECT count(nodes_childs) as nodes_childs FROM datatree LIMIT 1";
        $results = $this->db->execute($this->sql);
        if(is_array($results) and is_array($results[0])) {
            $results = $results[0]['nodes_childs'];
            return true;
        }
        return false;
    }

    private function _dbdatavars() {
        $this->errormessage = ' Seems there is no data in database or maybe database layer is not ready..';
        if( array_key_exists('cedp', $this->urlarguments)) {
            if( trim($this->urlarguments['cedp']) == '') {
                $this->urlarguments['cedp'] = '-1';
            }
        }
        else
            $this->urlarguments['cedp'] = '-1';
        $sql = "
            SELECT * FROM (
                    SELECT e1.nodes_childs, e1.nodes_parent, e1.nodes_notes
                        FROM datatree e1
                        WHERE e1.nodes_parent = %s
                    UNION ALL
                    SELECT e2.nodes_childs, e2.nodes_parent, e2.nodes_notes
                        FROM datatree e2
                    JOIN datatree e3 ON e2.nodes_parent = e3.nodes_childs
                ) nodes WHERE nodes_parent <> 0
            ";
        $this->sql = $sql;
    }

    public function show($parameters = null) {
      $errormessage = $this->errormessage;
      $httpcode = $this->codehttpisok;
      $sucess = $this->sucess;
      if($this->sucess) $parameters = $this->savedatafull; else $sucess = 'false';
      $variables = array('sucess'=>$sucess,'message'=>$errormessage,'httpcode'=>$httpcode,'data'=>$parameters);
      $this->renderOutput($variables,true);
    }

}
