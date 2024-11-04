<?php
    require_once '../connect.php';
    $Emp_ID=$_POST['Editsubmit'];
    $Emp_Name=$_POST['Emp_Name'];
    $Username=$_POST['Username'];
    $Password=$_POST['Password'];
    $Position_Name=$_POST['Position_Name'];
    $sql="SELECT * FROM employee WHERE Emp_ID='$Emp_ID'";
    $result=$con->query($sql);
    $row=mysqli_fetch_array($result);

    if(isset($_POST['Editsubmit'])){
        $Emp_ID=$_POST['Editsubmit'];
        $Emp_Name=$_POST['Emp_Name'];
        $Username=$_POST['Username'];
        $Password=$_POST['Password'];
        $sql="UPDATE employee SET Emp_Name='$Emp_Name',Username='$Username',Password='$Password',Position_ID='$Position_Name'  WHERE Emp_ID='$Emp_ID'";
           
        $result=$con->query($sql);
        if(!$result){
            echo"<script>alert('ไม่สามารถบันทึกข้อมูลได้')</script>";
            header('location:Employee.php');
        }
        else{
            header('location:Employee.php');
        }
    }
?>