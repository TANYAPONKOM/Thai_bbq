<?php
    require_once '../connect.php';
    if(isset($_POST['Addsubmit'])){
        $Status_ID=$_POST['Status_id'];
        $Status_Name=$_POST['Status_name'];

        $sql="SELECT Status_ID  FROM status WHERE Status_ID='$Status_ID'";
        $result=$con->query($sql);
        $num=mysqli_num_rows($result);
        if($num==1){
            echo "<script>alert('มีรหัสสถานะนี้มีอยู่แล้ว')</script>";
            echo "<script>window.location.href='Status.php'</script>";
        }
        else{
            
                    $sql="INSERT  INTO status (Status_ID ,Status_Name) VALUES('$Status_ID','$Status_Name')";
                    $result=$con->query($sql);
                    if(!$result){
                        echo "<script>alert('ไม่สามารถเพิ่มข้อมูลได้')</script>";
                        }
                        else{
                        echo "<script>window.location.href='Status.php'</script>";
                        }  
                 
        }
    }
?>