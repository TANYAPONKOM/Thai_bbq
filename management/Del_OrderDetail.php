<?php
  require_once 'OrderDetail.php';
  require_once '../connect.php';
  $Order_ID = $_GET['Order_ID'];
  $Menu_ID = $_GET['Menu_ID'];
  echo $Order_ID;
  $sql = "SELECT * FROM orderdetail WHERE Order_ID ='$Order_ID' AND Menu_ID = '$Menu_ID'";
  $result = $con->query($sql);
  $row = mysqli_fetch_array($result);
  $sql = "DELETE FROM orderdetail WHERE Order_ID ='$Order_ID' AND Menu_ID='$Menu_ID'";
  $result = $con->query($sql);
  if (!$result) {
    echo "<script>alert('ไม่สามารถลบข้อมูลได้')</script>";
  } else {
    echo "<script>window.location.href='OrderDetail.php'</script>";
  }
?>