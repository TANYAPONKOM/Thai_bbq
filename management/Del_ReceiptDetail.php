<?php
  require_once 'ReceiptDetail.php';
  require_once '../connect.php';
  $Receipt_ID = $_GET['Receipt_ID'];
  $Menu_ID = $_GET['Menu_ID'];
  echo $Receipt_ID;
  $sql = "SELECT * FROM receiptdetail WHERE Receipt_ID ='$Receipt_ID' AND Menu_ID = '$Menu_ID'";
  $result = $con->query($sql);
  $row = mysqli_fetch_array($result);
  $sql = "DELETE FROM receiptdetail WHERE Receipt_ID ='$Receipt_ID' AND Menu_ID='$Menu_ID'";
  $result = $con->query($sql);
  if (!$result) {
    echo "<script>alert('ไม่สามารถลบข้อมูลได้')</script>";
  } else {
    echo "<script>window.location.href='ReceiptDetail.php'</script>";
  }
?>