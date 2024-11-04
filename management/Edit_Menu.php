<?php
    require_once '../connect.php';
    $Menu_ID=$_POST['Editsubmit'];
    $sql="SELECT * FROM menu WHERE Menu_ID='$Menu_ID'";
    $result=$con->query($sql);
    $row=mysqli_fetch_array($result);

    if(isset($_POST['Editsubmit'])){
        $Menu_ID=$_POST['Editsubmit'];
        $Menu_Name=$_POST['Menu_Name'];
        $TypeMenu_ID=$_POST['TypeMenu_Name'];
        $Menu_Unit=$_POST['Menu_Unit'];
        $Menu_Price=$_POST['Menu_Price'];
        $Menu_Amount=$_POST['Menu_Amount'];
        $Supplier_ID=$_POST['Supplier_Name'];
        $sql="UPDATE menu SET Menu_Name='$Menu_Name',TypeMenu_ID='$TypeMenu_ID',Menu_Unit='$Menu_Unit',Menu_Price='$Menu_Price',Menu_Amount='$Menu_Amount',Sup_ID='$Supplier_ID' WHERE Menu_ID='$Menu_ID'";
           
        $result=$con->query($sql);
        if(!$result){
            echo"<script>alert('ไม่สามารถบันทึกข้อมูลได้')</script>";
            header('location:Menu.php');
        }
        else{
            header('location:Menu.php');
        }
    }
?>