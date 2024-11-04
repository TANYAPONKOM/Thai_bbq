<?php
  require_once 'TypeMenu.php';
  require_once '../connect.php';
  $Type_id = $_GET['TypeMenu_ID'];
  echo $Type_id;
  $sql = "SELECT * FROM typemenu WHERE TypeMenu_ID ='$Type_id'";
  $result = $con->query($sql);
  $row = mysqli_fetch_array($result);
  $sql = "DELETE FROM typemenu WHERE TypeMenu_ID='$Type_id'";
  $result = $con->query($sql);
  if (!$result) {
    echo "<script>alert('ไม่สามารถลบข้อมูลได้')</script>";
  } else {
    echo "<script>window.location.href='TypeMenu.php'</script>";
  }
?>