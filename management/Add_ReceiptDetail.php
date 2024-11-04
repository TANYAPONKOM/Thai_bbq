<?php
    require_once '../connect.php';
    if(isset($_POST['Addsubmit'])){
        $Receipt_ID = $_POST['Receipt_ID'];
        $Menu_ID = $_POST['Menu_ID'];
        $ReceiptDetail_Amount = $_POST['ReceiptDetail_Amount'];
        $sql = "SELECT Receipt_ID, Menu_ID FROM receiptdetail WHERE Receipt_ID='$Receipt_ID' AND Menu_ID='$Menu_ID'";
        $result = $con->query($sql);
        $num = mysqli_num_rows($result);
        if($num == 1){
            echo "<script>alert('มีรหัสรายละเอียดใบเสร็จและเมนูนี้มีอยู่แล้ว')</script>";
            echo "<script>window.location.href='ReceiptDetail.php'</script>";
        }
        else{
            $sql = "INSERT INTO receiptdetail (Receipt_ID, Menu_ID, ReceiptDetail_Amount) VALUES('$Receipt_ID', '$Menu_ID', '$ReceiptDetail_Amount')";
            $result = $con->query($sql);
            if(!$result){
                echo "<script>alert('ไม่สามารถเพิ่มข้อมูลได้')</script>";
            }
            else{
                // คำสั่งสำหรับการอัปเดตราคารวมหลังจากการ INSERT สำเร็จ
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
            } else {
                    echo "<script>window.location.href='ReceiptDetail.php'</script>";
                }
            }
        }
    }
?>