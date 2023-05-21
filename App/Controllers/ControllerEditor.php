<?php
namespace App\Controllers;

use App\View;
use App\DB;

class ControllerEditor
{
    private $model;
    private $view;
    private $database;

    public function __construct() {
        $this->model;
        $this->view = new View();
        
    }
    public function show(){
        $durations = DB::getAll("SELECT * FROM `duration`");
        $types = DB::getAll("SELECT * FROM `type`");
        if (isset($_GET['edit'])){
            $task = DB::getAll("SELECT * FROM `tasks` WHERE `id` = ?", array($_GET['edit']))[0];
            $this->view->render("editorPage",['durations' => $durations, "types" => $types, "task" => $task]);
        }
    }
    public function store(){
        if (isset($_POST['save'])){
        
            $theme = $_POST['theme']; 
            $type = $_POST['type'];
            $place = $_POST['place'];
            $date = $_POST['date'];
            $time = $_POST['time'];
            $duration = $_POST['duration'];
            $comment = $_POST['comment'];
    
            $date_time = $date . ' ' . $time;
    
            if (isset($_POST['delete'])){
                DB::set("DELETE FROM `tasks` WHERE `id` = ?", array($_POST['delete']));                   
            }
            else{
                if (isset($_POST['status'])) {
                    $insert_id = DB::add("UPDATE LOW_PRIORITY IGNORE `tasks` SET `theme` = ?, `type_id` = ?, `place` = ?, `date_time` = ?, 
                    `duration_id` = ?, `comment` = ?, `status` = ? WHERE `id` = ?", 
                    array($theme, $type, $place, $date_time, $duration, $comment, 'completed', $_POST['save']));   
                }
                else {
                    $insert_id = DB::add("UPDATE LOW_PRIORITY IGNORE `tasks` SET `theme` = ?, `type_id` = ?, `place` = ?, `date_time` = ?, 
                    `duration_id` = ?, `comment` = ?, `status` = ? WHERE `id` = ?", 
                    array($theme, $type, $place, $date_time, $duration, $comment, NULL, $_POST['save']));                    
                }
            }
            header('Location: /index.php');     
        }
    }
}