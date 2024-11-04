<?php
  require_once 'Employee.php';
  require_once '../connect.php';
  $Emp_ID = $_GET['Emp_ID'];
  echo $Emp_ID;
  $sql = "SELECT * FROM employee WHERE Emp_ID ='$Emp_ID'";
  $result = $con->query($sql);
  $row = mysqli_fetch_array($result);
  $sql = "DELETE FROM employee WHERE Emp_ID='$Emp_ID'";
  $result = $con->query($sql);
  if (!$result) {
    echo "<script>alert('ไม่สามารถลบข้อมูลได้')</script>";
  } else {
    echo "<script>window.location.href='Employee.php'</script>";
  }
?>