<?php
    header('Content-Type: application/json; charset=utf-8');
    print( json_encode([
      'ok' => true,
      'msg' => $this->hellovar . ' to framework',
    ]));
?>