<?php
    require_once '../connect.php';
    if(isset($_POST['Addsubmit'])){
        $Sup_ID=$_POST['Sup_id'];
        $Sup_name=$_POST['Sup_name'];
        $Sup_address=$_POST['Sup_address'];
        $Sup_tell=$_POST['Sup_tell'];

        $sql="SELECT Sup_ID  FROM supplier WHERE Sup_ID='$Sup_ID'";
        $result=$con->query($sql);
        $num=mysqli_num_rows($result);
        if($num==1){
            echo "<script>alert('มีรหัส นี้มีอยู่แล้ว')</script>";
            echo "<script>window.location.href='Supplier.php'</script>";
        }
        else{
                    $sql="INSERT  INTO supplier (Sup_ID ,Sup_name,Sup_address,Sup_tell) VALUES('$Sup_ID','$Sup_name','$Sup_address','$Sup_tell')";
                    $result=$con->query($sql);
                    if(!$result){
                        echo "<script>alert('ไม่สามารถเพิ่มข้อมูลได้')</script>";
                        }
                        else{
                        echo "<script>window.location.href='Supplier.php'</script>";
                        }  
                
        }
    }
?>