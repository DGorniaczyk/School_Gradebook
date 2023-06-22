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
  <title>Admin Control Panel</title>
</head>
<body>
<h4 class="welcome">Admin Control Panel</h4>
<table class='tableContainer'>
  <tr>
    <th class="tableHeaders">Name</th>
    <th  class="tableHeaders">Surname</th>
    <th  class="tableHeaders">Action</th>
  </tr>

<?php
  $email = $_SESSION["email"];
  require_once "../scripts/database.php";
  $sql = "SELECT * FROM teacher;";
  $result = $conn->query($sql);
  echo "<h4 class=welcome>". "TEACHERS" . "</h4>";
  while($user = $result->fetch_assoc()){
    echo <<< TABLEUSERS
      <tr>
        <td class="tableElement">$user[first_Name]</td>
        <td class="tableElement">$user[surname]</td>
        <td><button class='deleteBtn'><a href='../scripts/delete_teacher.php?teacher_ID=$user[teacher_ID]'>Delete User</a></button></td>
      </tr> 
TABLEUSERS;
  }
  echo "</table>";
  echo "<h4 class=welcome>" . "STUDENTS" . "</h4>";
echo '<table class="tableContainer">';
echo '<tr>';
echo '<th  class="tableHeaders">Name</th>';
echo '<th  class="tableHeaders">Surname</th>';
echo '<th  class="tableHeaders">Action</th>';
echo '</tr>';
$sql = "SELECT * FROM student;";
$result = $conn->query($sql);
while($user = $result->fetch_assoc()){
  echo <<< TABLEUSERS
    <tr>
      <td class="tableElement">$user[name]</td>
      <td class="tableElement">$user[surname]</td>
      <td><button class='deleteBtn'><a href='../scripts/delete_student.php?student_ID=$user[student_ID]'>Delete User</a></button></td>
    </tr> 
TABLEUSERS;
}
echo '</table>';
?>
<div class="submitContainer">
  <button class="submitBtn">
        <a href="admin_register.php">Add Admin</a>
        </button>
    </div>
    <div class="submitContainer">
    <button class="submitBtn">
        <a href="register.php">Add User</a>
        </button>
    </div>
    <div class="logoutContainer">
  <button class="logoutBtn">
        <a href="../scripts/logout.php">Logout</a>
</button>
    </div>
</body>
</html>