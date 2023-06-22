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
  <title>Student's Grades</title>
</head>
<body>
<h4 class="welcome">School Gradebook</h4>
<table class="tableContainer">
  <tr>
    <th class="tableHeaders">Subject</th>
    <th class="tableHeaders">Class</th>
  </tr>

<?php
  $email = $_SESSION["email"];
  require_once "../scripts/database.php";
  $sql = "SELECT * FROM student s RIGHT JOIN subject s2 on s.class_ID=s2.class_ID WHERE s.email='$email';";
  $result = $conn->query($sql);
  while($user = $result->fetch_assoc()){
    $student_ID = $user['student_ID'];
    $subject_ID = $user['subject_ID'];
    $sql = "SELECT * FROM grade WHERE student_ID=$student_ID AND subject_ID='$subject_ID';";
    $result2 = $conn->query($sql);
    echo '<tr>';
    echo '<td class="tableElement">' . $user['subject_Name'] . '</td>';
    echo  '<td>';
    while($grade = $result2->fetch_assoc()){
      echo '<button class="gradeBtn">'  .  $grade['grade'] . '</button>';
    }
    echo '</td>';
    echo '</tr>';
  }
  echo "</table>";
?>
<div class="logoutContainer">
    <button class="logoutBtn">
        <a href="../scripts/logout.php">Logout</a>
    </button>
    </div>
</body>
</html>