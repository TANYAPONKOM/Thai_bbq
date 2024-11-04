<?php
    require_once '../connect.php';
    $Status_id=$_POST['Editsubmit'];
    $sql="SELECT * FROM status WHERE Status_ID='$Status_id'";
    $result=$con->query($sql);
    $row=mysqli_fetch_array($result);

    if(isset($_POST['Editsubmit'])){
        $Status_id=$_POST['Editsubmit'];
        $Status_name=$_POST['Status_name'];
        $sql="UPDATE status SET Status_Name='$Status_name' WHERE Status_ID='$Status_id'";
           
        $result=$con->query($sql);
        if(!$result){
            echo"<script>alert('ไม่สามารถบันทึกข้อมูลได้')</script>";
            header('location:Status.php');
        }
        else{
            header('location:Status.php');
        }
    }
?>