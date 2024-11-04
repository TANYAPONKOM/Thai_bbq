<?php
    require_once '../connect.php';
    $Buy_ID = $_POST['Editsubmit'];
    $Menu_ID = $_POST['Menu_ID'];
    $BuyDetail_Amount = $_POST['BuyDetail_Amount'];
    $sql = "SELECT * FROM buydetail WHERE Buy_ID = '$Buy_ID' AND Menu_ID = '$Menu_ID'";
    $result = $con->query($sql);
    $row = mysqli_fetch_array($result);

    if(isset($_POST['Editsubmit'])){
        $Buy_ID = $_POST['Editsubmit'];
        $Menu_ID = $_POST['Menu_ID'];
        $BuyDetail_Amount = $_POST['BuyDetail_Amount'];
        $sql = "UPDATE buydetail SET BuyDetail_Amount = '$BuyDetail_Amount' WHERE Buy_ID = '$Buy_ID' AND Menu_ID = '$Menu_ID'";

        $result = $con->query($sql);
        if(!$result){
            echo "<script>alert('ไม่สามารถบันทึกข้อมูลได้')</script>";
            header('location:BuyDetail.php');
        }
        else{
            // คำสั่งสำหรับการอัปเดตราคารวมหลังจากการ UPDATE สำเร็จ
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
            }

            header('location:BuyDetail.php');
        }
    }
?>