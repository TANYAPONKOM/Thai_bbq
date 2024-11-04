<?php
    require_once '../connect.php';
    $Receipt_ID=$_POST['Editsubmit'];
    $sql="SELECT * FROM buy WHERE Buy_ID='$Buy_ID'";
    $result=$con->query($sql);
    $row=mysqli_fetch_array($result);

    if(isset($_POST['Editsubmit'])){
        $Buy_ID=$_POST['Editsubmit'];
        $Buy_Date=$_POST['Buy_Date'];
        $Buy_TotalPrice=$_POST['Buy_TotalPrice'];
        $Emp_Name=$_POST['Emp_Name'];
        
        $sql="UPDATE buy SET Buy_Date='$Buy_Date',Buy_TotalPrice='$Buy_TotalPrice',Emp_ID='$Emp_Name' WHERE Buy_ID='$Buy_ID'";
           
        $result=$con->query($sql);
        if(!$result){
            echo"<script>alert('ไม่สามารถบันทึกข้อมูลได้')</script>";
            header('location:Buy.php');
        }
        else{
            header('location:Buy.php');
        }
    }
?>