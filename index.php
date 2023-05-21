<?php
  spl_autoload_register();
  use App\Controllers\Controller;
  $controller = new Controller;


  switch(getenv("REQUEST_METHOD")){
    case "GET":
      $controller->show();
      break;
      case "POST":
        $controller->store();
      break;
  }
