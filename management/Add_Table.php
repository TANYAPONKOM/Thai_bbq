<?php
    require_once '../connect.php';
    if(isset($_POST['Addsubmit'])){
        $Table_ID=$_POST['Table_id'];
        $Status_ID=$_POST['Status_ID'];

        $sql="SELECT Table_ID  FROM tables WHERE Table_ID='$Table_ID'";
        $result=$con->query($sql);
        $num=mysqli_num_rows($result);
        if($num==1){
            echo "<script>alert('มีรหัสโต๊ะนี้มีอยู่แล้ว')</script>";
            echo "<script>window.location.href='Table.php'</script>";
        }
        else{
            
                    $sql="INSERT  INTO tables (Table_ID ,Status_ID) VALUES('$Table_ID','$Status_ID')";
                    $result=$con->query($sql);
                    if(!$result){
                        echo "<script>alert('ไม่สามารถเพิ่มข้อมูลได้')</script>";
                        }
                        else{
                        echo "<script>window.location.href='Table.php'</script>";
                        }  
                
        }
    }
?>