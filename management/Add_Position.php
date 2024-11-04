<?php
    require_once '../connect.php';
    if(isset($_POST['Addsubmit'])){
        $Position_ID=$_POST['Position_id'];
        $Position_Name=$_POST['Position_name'];

        $sql="SELECT Position_ID  FROM position WHERE Position_ID='$Position_ID'";
        $result=$con->query($sql);
        $num=mysqli_num_rows($result);
        if($num==1){
            echo "<script>alert('มีรหัสตำแหน่งนี้มีอยู่แล้ว')</script>";
            echo "<script>window.location.href='Position.php'</script>";
        }
        else{
            
                    $sql="INSERT  INTO position (Position_ID ,Position_Name) VALUES('$Position_ID','$Position_Name')";
                    $result=$con->query($sql);
                    if(!$result){
                        echo "<script>alert('ไม่สามารถเพิ่มข้อมูลได้')</script>";
                        }
                        else{
                        echo "<script>window.location.href='Position.php'</script>";
                        }  
                
        }
    }
?>