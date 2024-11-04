<?php
    require_once '../connect.php';
    $Receipt_ID = $_POST['Editsubmit'];
    $Menu_ID = $_POST['Menu_ID'];
    $ReceiptDetail_Amount = $_POST['ReceiptDetail_Amount'];
    $sql = "SELECT * FROM receiptdetail WHERE Receipt_ID = '$Receipt_ID' AND Menu_ID = '$Menu_ID'";
    $result = $con->query($sql);
    $row = mysqli_fetch_array($result);

    if(isset($_POST['Editsubmit'])){
        $Receipt_ID = $_POST['Editsubmit'];
        $Menu_ID = $_POST['Menu_ID'];
        $ReceiptDetail_Amount = $_POST['ReceiptDetail_Amount'];
        $sql = "UPDATE receiptdetail SET ReceiptDetail_Amount = '$ReceiptDetail_Amount' WHERE Receipt_ID = '$Receipt_ID' AND Menu_ID = '$Menu_ID'";

        $result = $con->query($sql);
        if(!$result){
            echo "<script>alert('ไม่สามารถบันทึกข้อมูลได้')</script>";
            header('location:ReceiptDetail.php');
        }
        else{
            // คำสั่งสำหรับการอัปเดตราคารวมหลังจากการ UPDATE สำเร็จ
            $updateTotalPriceSql = "
                UPDATE `receipt`
                SET `Re_TotalPrice` = (
                    SELECT SUM(od.ReceiptDetail_Amount * m.Menu_Price)
                    FROM receiptdetail od
                    JOIN menu m ON od.Menu_ID = m.Menu_ID
                    WHERE od.Receipt_ID = '$Receipt_ID'
                )
                WHERE `Receipt_ID` = '$Receipt_ID';
            ";
            $updateResult = $con->query($updateTotalPriceSql);

            if(!$updateResult){
                echo "<script>alert('ไม่สามารถอัพเดตราคารวมได้')</script>";
            }

            header('location:ReceiptDetail.php');
        }
    }
?>