<?php
/*
            ____                  _     _
           / ___|_   _  __ _  ___| |__ (_)
          | |  _| | | |/ _` |/ __| '_ \| |
          | |_| | |_| | (_| | (__| | | | |
           \____|\__,_|\__,_|\___|_| |_|_|
Copyright (c) 2014  Díaz  Víctor  aka  (Máster Vitronic)
Copyright (c) 2018  Díaz  Víctor  aka  (Máster Vitronic)
*/
class XXX_model extends model {
  private $sql;
  private $err;
  public function notFound() {
    $this->borrow('notFound')->show();
  }
  public function show() {
    $this->save();
  }
  public function save() {
    print 'Hola Mundo!';
  }
  private function save_ok() {
  }
}
