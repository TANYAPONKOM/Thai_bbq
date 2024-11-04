<?php
require_once '../connect.php';
$Buy_ID = $_POST['Editsubmit'];
$Menu_ID = $_POST['Menu_ID'];
$BuyDetail_Amount = $_POST['BuyDetail_Amount'];

$sql = "SELECT * FROM buydetail WHERE Buy_ID = '$Buy_ID' AND Menu_ID = '$Menu_ID'";
$result = $con->query($sql);
$row = mysqli_fetch_array($result);

if (isset($_POST['Editsubmit'])) {
    // ดึงค่าปัจจุบันจากฐานข้อมูล
    $currentAmount = $row['BuyDetail_Amount'];

    // อัปเดตจำนวนในตาราง buydetail
    $sql = "UPDATE buydetail SET BuyDetail_Amount = '$BuyDetail_Amount' WHERE Buy_ID = '$Buy_ID' AND Menu_ID = '$Menu_ID'";
    $result = $con->query($sql);
    
    if (!$result) {
        echo "<script>alert('ไม่สามารถบันทึกข้อมูลได้')</script>";
        header('location:BuyDetail.php');
    } else {
        // อัปเดตราคารวมหลังจากอัปเดต
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
        
        // คำนวณความแตกต่างและอัปเดตจำนวนในตาราง menu
        $difference = $BuyDetail_Amount - $currentAmount;

        if ($difference > 0) {
            // ถ้ามีการเพิ่มจำนวน
            $updateCalAmountMenuSql = "
                UPDATE menu
                SET Menu_Amount = Menu_Amount + $difference
                WHERE Menu_ID = '$Menu_ID';
            ";
        } else if ($difference < 0) {
            // ถ้ามีการลดจำนวน
            $updateCalAmountMenuSql = "
                UPDATE menu
                SET Menu_Amount = Menu_Amount + $difference
                WHERE Menu_ID = '$Menu_ID';
            ";
        }

        // ประมวลผลคำสั่งอัปเดตราคารวม
        $updateResult = $con->query($updateTotalPriceSql);
        // ประมวลผลคำสั่งอัปเดตจำนวนใน menu
        $updateResult2 = $con->query($updateCalAmountMenuSql);

        if (!$updateResult) {
            echo "<script>alert('ไม่สามารถอัพเดตราคารวมได้')</script>";
        } else if (!$updateResult2) {
            echo "<script>alert('ไม่สามารถอัพจำนวนได้')</script>";
        }

        header('location:BuyDetail.php');
    }
}
?>