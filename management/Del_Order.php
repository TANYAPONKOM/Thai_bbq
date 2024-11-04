<?php
  require_once 'Order.php';
  require_once '../connect.php';
  $Order_ID = $_GET['Order_ID'];
  echo $Type_id;
  $sql = "SELECT * FROM orders WHERE Order_ID ='$Order_ID'";
  $result = $con->query($sql);
  $row = mysqli_fetch_array($result);
  $sql = "DELETE FROM orders WHERE Order_ID='$Order_ID'";
  $result = $con->query($sql);
  if (!$result) {
    echo "<script>alert('ไม่สามารถลบข้อมูลได้')</script>";
  } else {
    echo "<script>window.location.href='Order.php'</script>";
  }
?>