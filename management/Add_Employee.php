<?php
    require_once '../connect.php';
    if(isset($_POST['Addsubmit'])){
        $Emp_ID=$_POST['Emp_ID'];
        $Emp_Name=$_POST['Emp_Name'];
        $Username=$_POST['Username'];
        $Password=$_POST['Password'];
        $Position_Name=$_POST['Position_Name'];

        

        $sql="SELECT Emp_ID  FROM employee WHERE Emp_ID='$Emp_ID'";
        $result=$con->query($sql);
        $num=mysqli_num_rows($result);
        if($num==1){
            echo "<script>alert('มีรหัสพนักงานนี้มีอยู่แล้ว')</script>";
            echo "<script>window.location.href='Employee.php'</script>";
        }
        else{
            
                    $sql="INSERT  INTO employee (Emp_ID ,Emp_Name,Username,Password,Position_ID) VALUES('$Emp_ID','$Emp_Name','$Username','$Password','$Position_Name')";
                    $result=$con->query($sql);
                    if(!$result){
                        echo "<script>alert('ไม่สามารถเพิ่มข้อมูลได้')</script>";
                        }
                        else{
                        echo "<script>window.location.href='Employee.php'</script>";
                        }  
                
        }
    }
?>