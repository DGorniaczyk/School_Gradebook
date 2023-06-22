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
  <link rel="stylesheet" href="../css/style.css">
  <title>Użytkownicy</title>
</head>
<body>
<h4 class="welcome">Edit/Delete Grade</h4>


<?php
  $_SESSION["grade"] = $_GET['grade_ID'];
?>
<form action="../scripts/grade_edit_script.php" method="post">
        <div class="inputContainer">
          <input type="number" class="input_number" name="Grade" placeholder="New Grade" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="submitContainer">
            <button type="submit" name="submit" class="submitBtn">Submit</button>
          </div>
<div class="submitContainer">
  <button class="deleteBtn">
        <a href="../scripts/delete_grade.php">Delete Grade</a>
</button>
      </div>
    <div class="logoutContainer">
  <button class="logoutBtn">
        <a href="../scripts/logout.php">Logout</a>
</button>
    </div>
    <div class="goBackContainer">
  <button class="backBtn">
        <a href="teacher_index.php">Go Back</a>
</button>
    </div>
</body>
</html>