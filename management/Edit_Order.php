<?php
    require_once '../connect.php';
    $Order_ID=$_POST['Editsubmit'];
    $sql="SELECT * FROM orders WHERE Order_ID='$Order_ID'";
    $result=$con->query($sql);
    $row=mysqli_fetch_array($result);

    if(isset($_POST['Editsubmit'])){
        $Order_ID=$_POST['Editsubmit'];
        $Table_ID=$_POST['Table_ID'];
        $Total_Price=$_POST['Total_Price'];
        $Order_Date=$_POST['Order_Date'];
        
        $sql="UPDATE orders SET Table_ID='$Table_ID',Total_Price='$Total_Price',Order_Date='$Order_Date' WHERE Order_ID='$Order_ID'";
           
        $result=$con->query($sql);
        if(!$result){
            echo"<script>alert('ไม่สามารถบันทึกข้อมูลได้')</script>";
            header('location:Order.php');
        }
        else{
            header('location:Order.php');
        }
    }
?>