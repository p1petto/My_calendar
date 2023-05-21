<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles/style.css" type="text/css" rel="stylesheet"/>

    <title>Document</title>
</head>
<body>
<?php
list($date, $time) = explode(' ', $task['date_time']);
?>
<div class="container editor">
    <form action='/index.php' method='GET' name='close' class='close-form'>
    <button type='submit' name='closeBt' class='bt bt-close' id='close'>Отмена</button>
    </form>
    <form action='' method='POST' name='edit' class='edit-form'>
        <table class='edit-form-table'>
            <tr>
                <td><label for='theme'>Тема:</label></td>
                <?php
                echo " <td><input type='text' name='theme' id='theme' required value='", $task['theme'], "'></td>";
                ?>
            </tr>
            <tr>
                <td><label for='type'>Тип:</label></td>
                <td><select name = 'type'>
                <?php
                foreach($types as $key => $value){
                echo "<option value =" . $value['id'] . ">" . $value['name'] . "</option>";
                }
                echo "</select>";
                ?>
                </td>
            </tr>
            <tr>
                <td><label for='place'>Место:</label></td>
                <?php
                echo "
                <td><input class='input-text' type='text' name='place' id='place' value='", $task['place'], "'></td>";
                ?>
            </tr>
            <tr>
                <td><label for='date'>Дата и время:</label></td>
                <?php
                echo "<td><input type='date' class='input-text' name='date' id='date' required value='", $date, "'>
                <input type='time' name='time' id='time' required value='", $time, "'></td>";
                ?>
            </tr>
            <tr>
                <td><label for='duration'>Длительность:</label>:</td>
                <td><select name = 'duration'>";
                <?php
                foreach($durations as $key => $value){
                    echo "<option value =" . $value['id'] . ">" . $value['name'] . "</option>";
                    }
                    echo "</select>";
                ?>
                </td>
            </tr>
            <tr>
                <td><label for='comment'>Комментарий:</label>:</td>
                <?php
                echo "<td><input class='input-text' type='text' name='comment' id='comment' value='", $task['comment'], "'></td>";
                ?>
            </tr>
            <tr>
                <td>
                <label for='status'>Выполнено</label>
                <?php
                if ($task['status'] == 'completed'){
                    echo "<input class='chbox' type='checkbox' name='status' checked value='",$task['id'],"'>";
                }
                else{
                    echo "<input class='chbox' type='checkbox' name='status' value='",$task['id'],"'>";
                }
                ?>
                </td>
                <td>
                <label for='delete'>Удалить</label>
                <?php
                echo "<input type='checkbox' class='chbox' name='delete' value='",$task['id'],"'>";
                ?>
                </td>
            </tr>
            <tr>
            <?php
                echo "<td></td><td class='save-bt'><button type='submit' class='bt bt-save' name='save' value='",$task['id'] ,"'>Сохранить</button></td>";
            ?>
            </tr>
        </table>
    </form>  

</div>
</body>
</html>

