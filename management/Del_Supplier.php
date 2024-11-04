<?php
  require_once 'Supplier.php';
  require_once '../connect.php';
  $Sup_id = $_GET['Sup_ID'];
  echo $Sup_id;
  $sql = "SELECT * FROM supplier WHERE Sup_ID ='$Sup_id'";
  $result = $con->query($sql);
  $row = mysqli_fetch_array($result);
  $sql = "DELETE FROM supplier WHERE Sup_ID='$Sup_id'";
  $result = $con->query($sql);
  if (!$result) {
    echo "<script>alert('ไม่สามารถลบข้อมูลได้')</script>";
  } else {
    echo "<script>window.location.href='Supplier.php'</script>";
  }
?>