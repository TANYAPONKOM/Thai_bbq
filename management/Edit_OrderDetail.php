<?php
require_once '../connect.php';

// ตรวจสอบการเชื่อมต่อกับฐานข้อมูล
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $Order_ID = $_POST['Editsubmit'];
        $Menu_ID = $_POST['Menu_ID'];
        $OrderDetail_Amount = $_POST['OrderDetail_Amount'];

        // ตรวจสอบค่าจาก POST และ GET
        // var_dump($_POST);
        // var_dump($_GET);
        // exit; // หยุดการทำงานชั่วคราวเพื่อดูค่าที่ส่งมา
        
        $sql = "SELECT * FROM orderdetail WHERE Order_ID = '$Order_ID' AND Menu_ID = '$Menu_ID'";
        $result = $con->query($sql);

        // ตรวจสอบการ query
        if (!$result) {
            echo "<script>alert('Error in SELECT query: " . $con->error . "');</script>";
            exit;
}

    $row = mysqli_fetch_array($result);

// ตรวจสอบค่าที่ดึงมา
// var_dump($row);
// exit; // หยุดการทำงานเพื่อดูผลลัพธ์ที่ดึงมา

if (isset($_POST['Editsubmit'])) {
    $Order_ID = $_POST['Editsubmit'];
    $Menu_ID = $_POST['Menu_ID'];
    $OrderDetail_Amount = $_POST['OrderDetail_Amount'];
    $currentAmount = $row['OrderDetail_Amount'];

    $sql = "UPDATE orderdetail SET OrderDetail_Amount = '$OrderDetail_Amount' WHERE Order_ID = '$Order_ID' AND Menu_ID = '$Menu_ID'";
    $result = $con->query($sql);

    // ตรวจสอบผลลัพธ์จากการอัปเดต
    if (!$result) {
        echo "<script>alert('Error in UPDATE query: " . $con->error . "');</script>";
        exit;
    } else {
        // คำสั่งสำหรับการอัปเดตราคารวมหลังจากการ UPDATE สำเร็จ
        $updateTotalPriceSql = "
            UPDATE `orders`
            SET `Total_Price` = (
                SELECT SUM(od.OrderDetail_Amount * m.Menu_Price)
                FROM orderdetail od
                JOIN menu m ON od.Menu_ID = m.Menu_ID
                WHERE od.Order_ID = '$Order_ID'
            )
            WHERE `Order_ID` = '$Order_ID';
        ";
        $difference = $OrderDetail_Amount - $currentAmount;
        
        if ($difference > 0) {
            // ถ้ามีการเพิ่มจำนวน (หมายถึงขายออกไปมากกว่า)
            $updateCalAmountMenuSql = "
                UPDATE menu
                SET Menu_Amount = Menu_Amount - $difference
                WHERE Menu_ID = '$Menu_ID';
            ";
        } else if ($difference < 0) {
            // ถ้ามีการลดจำนวน (หมายถึงขายออกไปน้อยกว่า)
            $updateCalAmountMenuSql = "
                UPDATE menu
                SET Menu_Amount = Menu_Amount + " . abs($difference) . "
                WHERE Menu_ID = '$Menu_ID';
            ";
        }
        
        $updateResult = $con->query($updateTotalPriceSql);
        $updateResult2 = $con->query($updateCalAmountMenuSql);

        if (!$updateResult) {
            echo "<script>alert('ไม่สามารถอัพเดตราคารวมได้')</script>";
        } else if (!$updateResult2) {
            echo "<script>alert('ไม่สามารถอัพจำนวนได้')</script>";
        }
        // ตรวจสอบการอัปเดตราคารวม
        // if (!$updateResult) {
        //     echo "<script>alert('Error in updating Total_Price: " . $con->error . "');</script>";
        //     exit;
        // }

        // ถ้าทุกอย่างสำเร็จ ให้รีไดเรกต์
        header('location:OrderDetail.php');
        exit;
    }
}
?>