<?php
namespace App\Controllers;

use App\View;
use App\DB;

class Controller
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
        
        if (isset($_GET['allTasks'])){
            $tasks = DB::getAll("SELECT t.id, t.theme, ty.name AS type_id, t.place, t.date_time, d.name AS duration_id, t.comment, t.status FROM `tasks` t JOIN `type` ty ON t.type_id = ty.id JOIN `duration` d ON t.duration_id = d.id");
            $this->view->render("main",['durations' => $durations,"types" => $types, "tasks" => $tasks]);
        }
        elseif (isset($_GET['curTasks'])){
            $tasks = DB::getAll("SELECT t.id, t.theme, ty.name AS type_id, t.place, t.date_time, d.name AS duration_id, t.comment, t.status FROM `tasks` t JOIN `type` ty ON t.type_id = ty.id JOIN `duration` d ON t.duration_id = d.id WHERE `status` is NULL AND `date_time` > CURDATE()");
            $this->view->render("main",['durations' => $durations,"types" => $types, "tasks" => $tasks]);
        }
        elseif (isset($_GET['overTimeTasks'])){
            $tasks = DB::getAll("SELECT t.id, t.theme, ty.name AS type_id, t.place, t.date_time, d.name AS duration_id, t.comment, t.status FROM `tasks` t JOIN `type` ty ON t.type_id = ty.id JOIN `duration` d ON t.duration_id = d.id WHERE `status` is NULL AND `date_time` < CURDATE();");
            $this->view->render("main",['durations' => $durations,"types" => $types, "tasks" => $tasks]);
        }
        elseif (isset($_GET['completedTasks'])){
            $tasks = DB::getAll("SELECT t.id, t.theme, ty.name AS type_id, t.place, t.date_time, d.name AS duration_id, t.comment, t.status FROM `tasks` t JOIN `type` ty ON t.type_id = ty.id JOIN `duration` d ON t.duration_id = d.id WHERE `status` = ?;", array('completed'));
            $this->view->render("main",['durations' => $durations,"types" => $types, "tasks" => $tasks]);
        }
        elseif (isset($_GET['dateTasks'])){
            $this->view->render("main",['durations' => $durations,"types" => $types, "is_calendar" => true]);
        }
        elseif (isset($_GET['selectDate'])){
            $dateTask = $_GET['dateTask']; 
            $tasks = DB::getAll("SELECT t.id, t.theme, ty.name AS type_id, t.place, t.date_time, d.name AS duration_id, t.comment, t.status FROM `tasks` t JOIN `type` ty ON t.type_id = ty.id JOIN `duration` d ON t.duration_id = d.id WHERE DATE(`date_time`) = ?;", array($dateTask));
            $this->view->render("main",['durations' => $durations,"types" => $types, "tasks" => $tasks]);

        }
        else{
            $tasks = DB::getAll("SELECT t.id, t.theme, ty.name AS type_id, t.place, t.date_time, d.name AS duration_id, t.comment, t.status FROM `tasks` t JOIN `type` ty ON t.type_id = ty.id JOIN `duration` d ON t.duration_id = d.id");
            $this->view->render("main",['durations' => $durations,"types" => $types, "tasks" => $tasks]);
        }
        // $tasks = DB::getAll("SELECT t.id, t.theme, ty.name AS type_id, t.place, t.date_time, d.name AS duration_id, t.comment, t.status FROM `tasks` t JOIN `type` ty ON t.type_id = ty.id JOIN `duration` d ON t.duration_id = d.id");
    }
    public function store(){
        if (isset($_POST['add'])){
            $theme = strip_tags($_POST['theme']); 
            $type = strip_tags($_POST['type']);
            $place = strip_tags($_POST['place']);
            $date = strip_tags($_POST['date']);
            $time = strip_tags($_POST['time']);
            $duration = strip_tags($_POST['duration']);
            $comment = strip_tags($_POST['comment']);
    
            $date_time = $date . ' ' . $time;
    
            $insert_id = DB::add("INSERT INTO `tasks` SET `theme` = ?, `type_id` = ?, `place` = ?, `date_time` = ?, `duration_id` = ?, `comment` = ?", 
                array($theme, $type, $place, $date_time, $duration, $comment));
                header('refresh: 0');
        }
        
    }
}