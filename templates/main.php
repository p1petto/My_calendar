<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles/style.css" type="text/css" rel="stylesheet"/>
    <title>Мой календарь</title>
</head>
<body>
<?php 
  // session_start();
?>
<div class="container"> 
  <h1>Мой календарь</h1>
  <form action="" method="POST" name="newTask" class="new-task">
    <table class="form-list">
        <tr>
          <td><label for="theme">Тема:</label></td>
          <td><input type="text" name="theme" id="theme" required></td>
        </tr>
        <tr>
        <td><label for="type">Тип:</label></td>
        <td>
          <?php
          echo "<select name = 'type'>";
          foreach($types as $key => $value){
          echo "<option value =" . $value['id'] . ">" . $value['name'] . "</option>";
          }

          echo "</select>";
        ?>
        </td>
        </tr>
        <tr>
        <td><label for="place">Место:</label></td>
        <td><input type="text" name="place" id="place"></td>
        </tr>
        <tr>
        <td><label for="date">Дата и время:</label></td>
        <td class="data-time"><input type="date" name="date" id="date" class="input-data" required>
        <input type="time" name="time" id="time" class="input-time" required></td>
        </tr>
        <tr>
        <td><label for="duration">Длительность:</label></td>
        <td>
          <?php
          echo "<select name = 'duration'>";
          foreach($durations as $key => $value){
          echo "<option value =" . $value['id'] . ">" . $value['name'] . "</option>";
          }

          echo "</select>";
        ?>
        </td>
        </tr>
        <tr>
        <td><label for="comment">Комментарий:</label></td>
        <td><input type="text" name="comment" class="comment"></td>
        </tr>
        <tr>
        <td></td><td class='td-bt'><button type="submit" class="bt add" name="add">Добавить</button></td>
        </tr>
        </table>
  </form>


  <div class="container-list">
  <div class="buttons">
  <form action="" method="GET" name="listTaskAll" class="list-task"> 
    <button type="submit" id="allTasks" name="allTasks" class="bts bt">Все</button>
  </form>
  <form action="" method="GET" name="listTaskCur" class="list-task"> 
    <button type="submit" id="curTasks" name="curTasks" class="bts bt">Текущие</button>
  </form>
  <form action="" method="GET" name="listTaskOverTime" class="list-task"> 
    <button type="submit" id="overTimeTasks" name="overTimeTasks" class="bts bt">Просроченные</button>
  </form>
  <form action="" method="GET" name="listTaskCompleted"class="list-task"> 
    <button type="submit" id="completedTasks" name="completedTasks" class="bts bt">Выполненные</button>
  </form>
  <form action="" method="GET" name="listTaskDate" class="list-task"> 
    <button type="submit" id="dateTasks" name="dateTasks" class="bts bt btright">На конкретную дату</button>
  </form>
  </div>

  <table class='task-list-table'>
  <?php
  if (isset($is_calendar)){
    ?>
    <form action="" method="GET" name="dateTaskForm">
            <input type="date" name="dateTask" id="dateTask" required>
            <button type="submit" name="selectDate" class='bt'>Показать</button>
    </form>
    <?php
  }
  ?>
  <tr><th></th><th>Тема</th><th>Тип</th><th>Место</th><th>Дата и время</th><th>Длительность</th><th>Комментарий</th></tr>
  <?php
    if (isset($tasks)){
      foreach ($tasks as $key => $value) {        
          echo "<tr>
          <form action='../editor.php' method=\"GET\" name=\"editForm\">
          <td><button type=\"submit\" value=\"", $value['id'], "\" name=\"edit\" class='bt edit'><img src='icons/pencil-svgrepo-com.svg' alt='Иконка' width='20' height='20'></button></td>
          </form>
          <td>", $value['theme'], "</td>
          <td>", $value['type_id'], "</td>
          <td>", $value['place'], "</td>
          <td>", $value['date_time'], "</td>
          <td>", $value['duration_id'], "</td>
          <td>", $value['comment'], "</td></tr>";
      }
    }
    ?>
    </table>
  </div>
</div>


</body>
</html>