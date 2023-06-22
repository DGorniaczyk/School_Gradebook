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
  <title>Class Grades</title>
</head>
<body>
<h4 class="welcome">Grades</h4>
<table class="tableContainer">
  <tr>
    <th class='tableHeaders'>Name</th>
    <th class='tableHeaders'>Surname</th>
    <th class='tableHeaders'>Grades</th>
    <th class='tableHeaders'>Action</th>
  </tr>

<?php
  $email = $_SESSION["email"];
  if(!isset($_SESSION["subject"]))
  {
    $subject_ID = $_GET['subject_ID'];
    $_SESSION["subject"] = $subject_ID;
  }
  if(isset($_SESSION["error"]))
  {
    $error = $_SESSION["error"];
    $_SESSION["error"] = null;
    echo $error;
  }
  $subject_ID = $_SESSION["subject"];
  require_once "../scripts/database.php";
  $sql = "SELECT * FROM subject s RIGHT JOIN class c on s.class_ID=c.class_ID RIGHT JOIN student s2 on c.class_ID=s2.class_ID WHERE s.subject_ID='$subject_ID';";
  $result = $conn->query($sql);
  while($user = $result->fetch_assoc()){
    $student_ID = $user['student_ID'];
    $sql = "SELECT * FROM grade g WHERE student_ID=$student_ID AND subject_ID='$subject_ID';";
    $result2 = $conn->query($sql);
    echo '<tr>';
    echo '<td class="tableElement">' . $user['name'] . '</td>';
    echo '<td class="tableElement">' . $user['surname'] . '</td>';
    echo  '<td>';
    while($grade = $result2->fetch_assoc()){
          echo "<button class='gradeBtn'><a href='edit_grade.php?grade_ID=" .$grade['grade_ID']. "'>" . "$grade[grade]" . '</a></button>';
    }
    echo '</td>';
    echo "<td><button class='submitBtn'><a href='add_grade.php?student_ID=" . $user['student_ID'] . "'>" . "Add Grade" . '</a></button></td>';
    echo '</tr>';
  }
  echo "</table>";
?>
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