<?php
    require_once '../connect.php';
    if(isset($_POST['Addsubmit'])){
        $Receipt_ID=$_POST['Receipt_ID'];
        $Table_ID=$_POST['Table_ID'];
        $Re_TotalPrice=$_POST['Re_TotalPrice'];
        $Re_Receive=$_POST['Re_Receive'];
        $Re_Change=$_POST['Re_Change'];
        $Receipt_Date=$_POST['Receipt_Date'];
        $Emp_Name=$_POST['Emp_Name'];
        $sql="SELECT Receipt_ID  FROM receipt WHERE Receipt_ID='$Receipt_ID'";
        $result=$con->query($sql);
        $num=mysqli_num_rows($result);
        if($num==1){
            echo "<script>alert('มีรหัสใบเสร็จนี้มีอยู่แล้ว')</script>";
            echo "<script>window.location.href='Receipt.php'</script>";
        }
        else{
            
                    $sql="INSERT  INTO receipt (Receipt_ID,Table_ID,Re_TotalPrice,Re_Receive,Re_Change,Receipt_Date,Emp_ID) VALUES('$Receipt_ID','$Table_ID','$Re_TotalPrice','$Re_Receive','$Re_Change','$Receipt_Date','$Emp_Name')";
                    $result=$con->query($sql);
                    if(!$result){
                        echo "<script>alert('ไม่สามารถเพิ่มข้อมูลได้')</script>";
                        }
                        else{
                        echo "<script>window.location.href='Receipt.php'</script>";
                        }  
                
        }
    }
?>