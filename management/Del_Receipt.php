<?php
  require_once 'Receipt.php';
  require_once '../connect.php';
  $Receipt_ID = $_GET['Receipt_ID'];
  echo $Receipt_ID;
  $sql = "SELECT * FROM receipt WHERE Receipt_ID ='$Receipt_ID'";
  $result = $con->query($sql);
  $row = mysqli_fetch_array($result);
  $sql = "DELETE FROM receipt WHERE Receipt_ID ='$Receipt_ID'";
  $result = $con->query($sql);
  if (!$result) {
    echo "<script>alert('ไม่สามารถลบข้อมูลได้')</script>";
  } else {
    echo "<script>window.location.href='Receipt.php'</script>";
  }
?>