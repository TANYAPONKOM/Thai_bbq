<?php
  require_once 'Buy.php';
  require_once '../connect.php';
  $Buy_ID = $_GET['Buy_ID'];
  echo $Buy_ID;
  $sql = "SELECT * FROM buy WHERE Buy_ID ='$Buy_ID'";
  $result = $con->query($sql);
  $row = mysqli_fetch_array($result);
  $sql = "DELETE FROM buy WHERE Buy_ID='$Buy_ID'";
  $result = $con->query($sql);
  if (!$result) {
    echo "<script>alert('ไม่สามารถลบข้อมูลได้')</script>";
  } else {
    echo "<script>window.location.href='Buy.php'</script>";
  }
?>