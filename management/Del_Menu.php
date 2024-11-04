<?php
  require_once 'Menu.php';
  require_once '../connect.php';
  $Menu_ID = $_GET['Menu_ID'];
  echo $Menu_ID;
  $sql = "SELECT * FROM menu WHERE Menu_ID ='$Menu_ID'";
  $result = $con->query($sql);
  $row = mysqli_fetch_array($result);
  $sql = "DELETE FROM menu WHERE Menu_ID='$Menu_ID'";
  $result = $con->query($sql);
  if (!$result) {
    echo "<script>alert('ไม่สามารถลบข้อมูลได้')</script>";
  } else {
    echo "<script>window.location.href='Menu.php'</script>";
  }
?>