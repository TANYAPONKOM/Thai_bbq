<?php
    require_once '../connect.php';
    if(isset($_POST['Addsubmit'])){
        $Buy_ID=$_POST['Buy_ID'];
        $Buy_Date=$_POST['Buy_Date'];
        $Buy_TotalPrice=$_POST['Buy_TotalPrice'];
        $Emp_Name=$_POST['Emp_Name'];
        $sql="SELECT Buy_ID  FROM buy WHERE Buy_ID='$Buy_ID'";
        $result=$con->query($sql);
        $num=mysqli_num_rows($result);
        if($num==1){
            echo "<script>alert('มีรหัสการซื้อนี้มีอยู่แล้ว')</script>";
            echo "<script>window.location.href='Buy.php'</script>";
        }
        else{
            
                    $sql="INSERT  INTO buy (Buy_ID,Buy_Date,Buy_TotalPrice,Emp_ID) VALUES('$Buy_ID','$Buy_Date','$Buy_TotalPrice','$Emp_Name')";
                    $result=$con->query($sql);
                    if(!$result){
                        echo "<script>alert('ไม่สามารถเพิ่มข้อมูลได้')</script>";
                        }
                        else{
                        echo "<script>window.location.href='Buy.php'</script>";
                        }  
                
        }
    }
?>