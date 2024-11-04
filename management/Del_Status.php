<?php
  require_once 'Status.php';
  require_once '../connect.php';
  $Status_id = $_GET['Status_ID'];
  echo $Status_id;
  $sql = "SELECT * FROM status WHERE Status_ID ='$Status_id'";
  $result = $con->query($sql);
  $row = mysqli_fetch_array($result);
  $sql = "DELETE FROM status WHERE Status_ID='$Status_id'";
  $result = $con->query($sql);
  if (!$result) {
    echo "<script>alert('ไม่สามารถลบข้อมูลได้')</script>";
  } else {
    echo "<script>window.location.href='Status.php'</script>";
  }
?>