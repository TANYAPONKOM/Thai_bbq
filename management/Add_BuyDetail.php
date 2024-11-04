<?php
    require_once '../connect.php';
    if(isset($_POST['Addsubmit'])){
        $Buy_ID = $_POST['Buy_ID'];
        $Menu_ID = $_POST['Menu_ID'];
        $BuyDetail_Amount = $_POST['BuyDetail_Amount'];
        $sql = "SELECT Buy_ID, Menu_ID FROM buydetail WHERE Buy_ID='$Buy_ID' AND Menu_ID='$Menu_ID'";
        $result = $con->query($sql);
        $num = mysqli_num_rows($result);
        if($num == 1){
            echo "<script>alert('มีรหัสรายละเอียดการซื้อและเมนูนี้มีอยู่แล้ว')</script>";
            echo "<script>window.location.href='BuyDetail.php'</script>";
        }
        else{
            $sql = "INSERT INTO buydetail (Buy_ID, Menu_ID, BuyDetail_Amount) VALUES('$Buy_ID', '$Menu_ID', '$BuyDetail_Amount')";
            $result = $con->query($sql);
            if(!$result){
                echo "<script>alert('ไม่สามารถเพิ่มข้อมูลได้')</script>";
            }
            else{
                // คำสั่งสำหรับการอัปเดตราคารวมหลังจากการ INSERT สำเร็จ
                $updateTotalPriceSql = "
                UPDATE `buy`
                SET `Buy_TotalPrice` = (
                    SELECT SUM(od.BuyDetail_Amount * m.Menu_Price)
                    FROM buydetail od
                    JOIN menu m ON od.Menu_ID = m.Menu_ID
                    WHERE od.Buy_ID = '$Buy_ID'
                )
                WHERE `Buy_ID` = '$Buy_ID';
            ";
            $updateResult = $con->query($updateTotalPriceSql);

            if(!$updateResult){
                echo "<script>alert('ไม่สามารถอัพเดตราคารวมได้')</script>";
            } else {
                    echo "<script>window.location.href='BuyDetail.php'</script>";
                }
            }
        }
    }
?>