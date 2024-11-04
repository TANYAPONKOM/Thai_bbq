<?php
  require_once 'BuyDetail.php';
  require_once '../connect.php';
  $Buy_ID = $_GET['Buy_ID'];
  $Menu_ID = $_GET['Menu_ID'];
  echo $Buy_ID;
  $sql = "SELECT * FROM buydetail WHERE Buy_ID ='$Buy_ID' AND Menu_ID = '$Menu_ID'";
  $result = $con->query($sql);
  $row = mysqli_fetch_array($result);
  $sql = "DELETE FROM buydetail WHERE Buy_ID ='$Buy_ID' AND Menu_ID='$Menu_ID'";
  $result = $con->query($sql);
  if (!$result) {
    echo "<script>alert('ไม่สามารถลบข้อมูลได้')</script>";
  } else {
    echo "<script>window.location.href='BuyDetail.php'</script>";
  }
?>