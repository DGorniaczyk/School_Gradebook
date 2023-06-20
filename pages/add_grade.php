<?php
session_start();
if (!isset($_SESSION["user"]))
{
    header("Location: ../pages/login.php");
}

?>
<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../css/table.css">
  <title>Użytkownicy</title>
</head>
<body>
<h4>School Gradebook</h4>


<?php
  $email = $_SESSION["email"];
  $student_ID = $_GET['student_ID'];
  echo  $student_ID;
  $subject_ID = $_SESSION["subject"];
  $date = date("Y/m/d");
  require_once "../scripts/database.php";
  if (isset($_POST["submit"]))
  {
    $grade = $_POST["Grade"];
    $sql = "INSERT INTO grade (student_ID, subject_ID, grade, date) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    $prepareSTMT = mysqli_stmt_prepare($stmt, $sql);
    if ($prepareSTMT)
    {
      mysqli_stmt_bind_param($stmt, "iiis", $student_ID, $subject_ID, $grade, $date);
      mysqli_stmt_execute($stmt);
    }
    else
        {
            die("Something went wrong");
        }
  }
?>
<form action="add_grade.php" method="post">
        <div class="input-group mb-3">
          <input type="int" class="form-control" name="Grade" placeholder="New Grade">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="col-4">
            <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
          </div>
<div class="container">
        <a href="../scripts/logout.php" class="btn btn-warning">Logout</a>
    </div>
</body>
</html>