<?php
    require_once '../connect.php';
    if(isset($_POST['Addsubmit'])){
        $Order_ID=$_POST['Order_ID'];
        $Table_ID=$_POST['Table_ID'];
        $Total_Price=$_POST['Total_Price'];
        $Order_Date=$_POST['Order_Date'];

        $sql="SELECT Order_ID  FROM orders WHERE Order_ID='$Order_ID'";
        $result=$con->query($sql);
        $num=mysqli_num_rows($result);
        if($num==1){
            echo "<script>alert('มีรหัสออเดอร์นี้มีอยู่แล้ว')</script>";
            echo "<script>window.location.href='Order.php'</script>";
        }
        else{
            
                    $sql="INSERT  INTO orders (Order_ID ,Table_ID,Total_Price ,Order_Date) VALUES('$Order_ID','$Table_ID','$Total_Price','$Order_Date')";
                    $result=$con->query($sql);
                    if(!$result){
                        echo "<script>alert('ไม่สามารถเพิ่มข้อมูลได้')</script>";
                        }
                        else{
                        echo "<script>window.location.href='Order.php'</script>";
                        }  
                
        }
    }
?>