<?php
  spl_autoload_register();
  use App\Controllers\ControllerEditor;
  $controller = new ControllerEditor;


  switch(getenv("REQUEST_METHOD")){
    case "GET":
      $controller->show();
      break;
      case "POST":
        $controller->store();
      break;
  }
?>