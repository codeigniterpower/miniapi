<?php
/**!
 * @package   miniapi-webdb
 * @filename  api list.php model
 * @route     >api>v1>store
 * @version   1.0
 */

class api_v1_store_model extends model {

    private $sql = null;

    private $errormessage = 'error, cannot store values of data, error on parameters or arguments or error in data storage';
    private $urlarguments = null;
    private $savedatatodb = false;
    private $savedatafull = false;
    private $codehttpisok = 412;

    public function notFound() {
        $this->borrow('notFoundApi')->show();
    }

    public function processdata($parameter, $urlarguments) {

        //api/vi/store/<asd>?PAL=UPV&cedh=nnnn&cedp=nnn

        $this->urlarguments = $urlarguments;
        $validator   = new validator($urlarguments);
        $validations = array(
            'PAL' => array(
                'type'      => 'string',
                "required"  => true
                ),
            'cedh' => array(
                'type'      => 'integer',
                "required"  => false
                ),
            'cedp' => array(
                'type'      => 'integer',
                "required"  => false
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

        $this->sucess = $this->_dbdatasave();
        if(! $this->sucess) {
            $this->errormessage = $this->errormessage.' Data not saved into database';
            return false;
        }

        $this->errormessage = 'Data saved into database';
        $this->codehttpisok = 200;
        $this->sucess = true;
        return true;
    }

    private function _dbdatasave() {
        $results = false;
        $this->errormessage = ' Data save on db storage result in error when inserting, duplicate data or format error..';
        if($this->savedatafull)
            $results = $this->db->execute($this->sql,$this->urlarguments['cedh'],$this->urlarguments['cedp']);
        else
            $results = $this->db->execute($this->sql,$this->urlarguments['cedh']);
        return $results;
    }

    private function _dbdatainit() {
        $results = false;
        $this->errormessage = ' Database structure seems not ready, trying to initialize error';
        $this->sql = "ALTER TABLE datatree ADD COLUMN nodes_childs VARCHAR(40) NULL;";
        $results = $results + $this->db->execute($this->sql);
        $this->sql = "ALTER TABLE datatree ADD COLUMN nodes_parent VARCHAR(40) NULL;";
        $results = $results + $this->db->execute($this->sql);
        $this->sql = "ALTER TABLE datatree ADD COLUMN nodes_notes VARCHAR(40) NULL;";
        $results = $results + $this->db->execute($this->sql);
        $this->sql = "CREATE TABLE IF NOT EXISTS datatree(nodes_childs VARCHAR(40),nodes_parent VARCHAR(40) Default -1,nodes_notes VARCHAR(40),PRIMARY KEY(nodes_childs),FOREIGN KEY (nodes_parent) REFERENCES datatree(nodes_childs) ON UPDATE CASCADE);";
        $results = $results + $this->db->execute($this->sql);
        if( $results == 0)
            return true;
        return $results;
    }

    private function _dbdatavars() {
        if( array_key_exists('cedp', $this->urlarguments)) {
            $this->savedatafull = true;
            if( trim($this->urlarguments['cedp']) == '') {
                $this->urlarguments['cedp'] = NULL;
                $this->savedatafull = false;
            }
            $this->savedatatodb = true;
        }
        if($this->savedatafull)
            $sql = "INSERT INTO datatree (nodes_childs, nodes_parent) VALUES (%s, %s);";
        else
            $sql = "INSERT INTO datatree (nodes_childs, nodes_parent) VALUES (%s);";
        $this->sql = $sql;
    }

    public function show($parameters = null) {
      $errormessage = $this->errormessage;
      $httpcode = $this->codehttpisok;
      $sucess = $this->sucess;
      $variables = array('sucess'=>$sucess,'message'=>$errormessage,'httpcode'=>$httpcode,'data'=>$parameters);
      $this->renderOutput($variables,true);
    }

}
