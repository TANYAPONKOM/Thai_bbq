<?php
    require_once '../connect.php';
    $Receipt_ID=$_POST['Editsubmit'];
    $sql="SELECT * FROM receipt WHERE Receipt_ID='$Receipt_ID'";
    $result=$con->query($sql);
    $row=mysqli_fetch_array($result);

    if(isset($_POST['Editsubmit'])){
        $Receipt_ID=$_POST['Editsubmit'];
        $Table_ID=$_POST['Table_ID'];
        $Re_TotalPrice=$_POST['Re_TotalPrice'];
        $Re_Receive=$_POST['Re_Receive'];
        $Re_Change=$_POST['Re_Change'];
        $Receipt_Date=$_POST['Receipt_Date'];
        $Emp_Name=$_POST['Emp_Name'];
        
        $sql="UPDATE receipt SET Table_ID='$Table_ID',Re_TotalPrice='$Re_TotalPrice',Re_Receive='$Re_Receive',Re_Change='$Re_Change',Receipt_Date='$Receipt_Date',Emp_ID='$Emp_Name' WHERE Receipt_ID='$Receipt_ID'";
           
        $result=$con->query($sql);
        if(!$result){
            echo"<script>alert('ไม่สามารถบันทึกข้อมูลได้')</script>";
            header('location:Receipt.php');
        }
        else{
            header('location:Receipt.php');
        }
    }
?>