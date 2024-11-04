<?php
    require_once '../connect.php';
    $Table_id=$_POST['Editsubmit'];
    $sql="SELECT * FROM tables WHERE Table_ID='$Table_id'";
    $result=$con->query($sql);
    $row=mysqli_fetch_array($result);

    if(isset($_POST['Editsubmit'])){
        $Table_id=$_POST['Editsubmit'];
        $Status_ID=$_POST['Status_ID'];
        $sql="UPDATE tables SET Status_ID='$Status_ID' WHERE Table_ID='$Table_id'";
           
        $result=$con->query($sql);
        if(!$result){
            echo"<script>alert('ไม่สามารถบันทึกข้อมูลได้')</script>";
            header('location:Table.php');
        }
        else{
            header('location:Table.php');
        }
    }
?>