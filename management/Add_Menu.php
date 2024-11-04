<?php 
    require_once '../connect.php';
    if(isset($_POST['Addsubmit'])){
        $Menu_ID=$_POST['Menu_ID'];
        $Menu_Name=$_POST['Menu_Name'];
        $TypeMenu_ID=$_POST['TypeMenu_Name'];
        $Menu_Unit=$_POST['Menu_Unit'];
        $Menu_Price=$_POST['Menu_Price'];
        $Menu_Amount=$_POST['Menu_Amount'];
        $Supplier_ID=$_POST['Supplier_Name']; 

        $sql="SELECT Menu_ID  FROM menu WHERE Menu_ID='$Menu_ID'";
        $result=$con->query($sql);
        $num=mysqli_num_rows($result);
        if($num==1){
            echo "<script>alert('มีรหัสเมนูนี้มีอยู่แล้ว')</script>";
            echo "<script>window.location.href='Menu.php'</script>";
        }
        else{
            $sql="INSERT  INTO menu (Menu_ID ,Menu_Name,TypeMenu_ID,Menu_Unit,Menu_Price,Menu_Amount,Sup_ID) VALUES('$Menu_ID','$Menu_Name','$TypeMenu_ID','$Menu_Unit','$Menu_Price','$Menu_Amount','$Supplier_ID')";
            $result=$con->query($sql);
            if(!$result){
                echo "<script>alert('ไม่สามารถเพิ่มข้อมูลได้')</script>";
            }else{
                echo "<script>window.location.href='Menu.php'</script>";
            }  
        }
    }
?>