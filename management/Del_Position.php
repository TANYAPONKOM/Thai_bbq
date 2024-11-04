<?php
  require_once 'Position.php';
  require_once '../connect.php';
  $Position_id = $_GET['Position_ID'];
  echo $Position_id;
  $sql = "SELECT * FROM position WHERE Position_ID ='$Position_id'";
  $result = $con->query($sql);
  $row = mysqli_fetch_array($result);
  $sql = "DELETE FROM position WHERE Position_ID='$Position_id'";
  $result = $con->query($sql);
  if (!$result) {
    echo "<script>alert('ไม่สามารถลบข้อมูลได้')</script>";
  } else {
    echo "<script>window.location.href='Position.php'</script>";
  }
?>