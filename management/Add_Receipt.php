<?php
    require_once '../connect.php';
    if(isset($_POST['Addsubmit'])){
        $TypeMenu_ID=$_POST['Type_id'];
        $TypeMenu_Name=$_POST['Type_name'];

        $sql="SELECT TypeMenu_ID  FROM typemenu WHERE TypeMenu_ID='$TypeMenu_ID'";
        $result=$con->query($sql);
        $num=mysqli_num_rows($result);
        if($num==1){
            echo "<script>alert('มีรหัสประเภทเมนูนี้มีอยู่แล้ว')</script>";
            echo "<script>window.location.href='TypeMenu.php'</script>";
        }
        else{
            
                    $sql="INSERT  INTO typemenu (TypeMenu_ID ,TypeMenu_Name) VALUES('$TypeMenu_ID','$TypeMenu_Name')";
                    $result=$con->query($sql);
                    if(!$result){
                        echo "<script>alert('ไม่สามารถเพิ่มข้อมูลได้')</script>";
                        }
                        else{
                        echo "<script>window.location.href='TypeMenu.php'</script>";
                        }  
                
        }
    }
?>