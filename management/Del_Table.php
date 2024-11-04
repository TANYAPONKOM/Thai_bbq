<?php
  // require_once 'Table.php';
  require_once '../connect.php';
  $Table_id = $_GET['Table_ID'];
  echo $Table_id;
  $sql = "SELECT * FROM tables WHERE Table_ID ='$Table_id'";
  $result = $con->query($sql);
  $row = mysqli_fetch_array($result);
  $sql = "DELETE FROM tables WHERE Table_ID='$Table_id'";
  $result = $con->query($sql);
  if (!$result) {
    echo "<script>alert('ไม่สามารถลบข้อมูลได้')</script>";
  } else {
    echo "<script>window.location.href='Table.php'</script>";
  }
?>