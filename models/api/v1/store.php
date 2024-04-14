<?php
/**!
 * @package   miniapi-webdb
 * @filename  api list.php model
 * @route     >api>v1>store
 * @version   1.0
 */

class api_v1_store_model extends model {

    private $errormessage = 'error, cannot store values of data, error on parameters or arguments or error in data storage';
    private $urlarguments = null;
    private $savedatatodb = false;
    private $savedatafull = false;
    private $codehttpisok = 404;

    public function notFound() {
        $this->borrow('notFoundApi')->show();
    }

    public function processdata($parameter, $urlarguments) {

        //api/vi/lists/<asd>?PAL=UPV&ced1=nnnn&ced2=nnn

        $varpal = 'NUL,(not received)';
        $varis0 = array_key_exists('PAL', $urlarguments);
        if($varis0) $varpal = $urlarguments['PAL'];

        $varcd1 = 'NUL,(not received)';
        $varis1 = array_key_exists('ced1', $urlarguments);
        if($varis1) $varcd1 = $urlarguments['ced1'];

        $varcd2 = 'NUL,(not received)';
        $varis2 = array_key_exists('ced2', $urlarguments);
        if($varis2) $varcd2 = $urlarguments['ced2'];

        $validator   = new validator($urlarguments);
        $validations = array(
            'PAL' => array(
                'type'      => 'string',
                "required"  => true
            ),
            'ced1' => array(
                'type'      => 'integer',
                "required"  => true
            ),
            'ced2' => array(
                'type'      => 'integer',
                "required"  => false
            ),
        );
        $check = $validator->execute($validations);

        $this->sucess = $check[0];
        if($this->sucess) 
            $this->codehttpisok = 200;
        $this->errormessage = ''.$check[1].' received parameteres are '.$varpal.' '.$varcd1.' '.$varcd2;
    }

    public function show($parameters = null) {
      $errormessage = $this->errormessage;
      $httpcode = $this->codehttpisok;
      $sucess = $this->sucess;
      $variables = array('sucess'=>$sucess,'message'=>$errormessage,'httpcode'=>$httpcode,'data'=>$parameters);
      $this->renderOutput($variables,true);
    }

}
