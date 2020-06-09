<?php

   $errors = "";

 //conectar
$db = mysqli_connect('localhost', 'root','linuxlinux','todo');
// añadir
if(isset($_POST['submit'])){
    $task = $_POST['task'];
    if(empty($task)){
        $errors = "Tienes que añadir una tarea";
    } else  {

        mysqli_query($db, "INSERT INTO tasks (task) VALUES ('$task')");
        header('location: index.php');
    }
    //Eliminar
    if (isset($_GET['del_task'])) {
        $id = $_GET['del_task'];
        mysqli_query($db, "DELETE FROM tasks WHERE id=$id");
        header('location: index.php');
    }
}

      $tasks = mysqli_query($db,"SELECT * FROM tasks");

?>

<!DOCTYPE html>
<html>
<head>

    <title> TODO LIST</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="todo"> TO DO</div>

    <form method="post" action="index.php">
        <?php if (isset($errors)) {    ?>
            <p><?php echo $errors; ?></p>

        <?php } ?>


        <input type="text" name="task" class="task_input">
        <button type="submit" class="add_btn" name="submit">Añadir Tarea</button>

    </form>


      <table>
          <thead>
          <tr>
              <th>Nº</th>
              <th>Tarea</th>
              <th>Acción</th>
          </tr>



          </thead>

          <tbody>
          <?php
          while ($row = mysqli_fetch_array($tasks)){  ?>
              <tr>
                  <td><?php echo $row['$id']; ?></td>
                  <td class="task"><?php echo $row['task']; ?></td>
                  <td class="delete">
                      <a href="index.php?del_task=<?php echo $row['id']; ?>">X</a>
                  </td>


              </tr>
          <?php } ?>




          </tbody>




      </table>



</body>



</html>