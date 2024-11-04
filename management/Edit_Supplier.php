<?php
    require_once '../connect.php';
    $Sup_id=$_POST['Editsubmit'];
    $sql="SELECT * FROM supplier WHERE Sup_ID='$Sup_id'";
    $result=$con->query($sql);
    $row=mysqli_fetch_array($result);

    if(isset($_POST['Editsubmit'])){
        $Sup_id=$_POST['Editsubmit'];
        $Sup_name=$_POST['Sup_name'];
        $Sup_address=$_POST['Sup_address'];
        $Sup_tell=$_POST['Sup_tell'];
        $sql="UPDATE supplier SET Sup_name='$Sup_name',Sup_address='$Sup_address',Sup_tell='$Sup_tell' WHERE Sup_ID='$Sup_id'";
           
        $result=$con->query($sql);
        if(!$result){
            echo"<script>alert('ไม่สามารถบันทึกข้อมูลได้')</script>";
            header('location:Supplier.php');
        }
        else{
            header('location:Supplier.php');
        }
    }
?>