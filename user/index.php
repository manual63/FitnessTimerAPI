<?php

require __DIR__ . '/../libs/Jacwright/RestServer/RestServer.php';
require 'UserController.php';

// respond to preflights
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
  // return only the headers and not the content
  // only allow CORS if we're doing a GET - i.e. no saving for now.
  if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']) &&
       $_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'] == 'GET' &&
       isset($_SERVER['HTTP_ORIGIN']) &&
       is_approved($_SERVER['HTTP_ORIGIN'])) {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: X-Requested-With');
  }
  exit;
}

$server = new \Jacwright\RestServer\RestServer('debug');
$server->addClass('UserController');
$server->handle();
