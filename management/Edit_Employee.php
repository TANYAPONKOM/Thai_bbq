<?php
    require_once '../connect.php';
    $Type_id=$_POST['Editsubmit'];
    $sql="SELECT * FROM typemenu WHERE TypeMenu_ID='$Type_id'";
    $result=$con->query($sql);
    $row=mysqli_fetch_array($result);

    if(isset($_POST['Editsubmit'])){
        $Type_id=$_POST['Editsubmit'];
        $Type_name=$_POST['Type_name'];
        $sql="UPDATE typemenu SET TypeMenu_Name='$Type_name' WHERE TypeMenu_ID='$Type_id'";
           
        $result=$con->query($sql);
        if(!$result){
            echo"<script>alert('ไม่สามารถบันทึกข้อมูลได้')</script>";
            header('location:TypeMenu.php');
        }
        else{
            header('location:TypeMenu.php');
        }
    }
?>