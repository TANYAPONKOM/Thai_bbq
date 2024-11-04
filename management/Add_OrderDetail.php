<?php
    require_once '../connect.php';
    if(isset($_POST['Addsubmit'])){
        $Order_ID = $_POST['Order_ID'];
        $Menu_ID = $_POST['Menu_ID'];
        $OrderDetail_Amount = $_POST['OrderDetail_Amount'];

        $sql = "SELECT Order_ID, Menu_ID FROM orderdetail WHERE Order_ID='$Order_ID' AND Menu_ID='$Menu_ID'";
        $result = $con->query($sql);
        $num = mysqli_num_rows($result);
        if($num == 1){
            echo "<script>alert('มีรหัสรายละเอียดออเดอร์และเมนูนี้มีอยู่แล้ว')</script>";
            echo "<script>window.location.href='OrderDetail.php'</script>";
        }
        else{
            $sql = "INSERT INTO orderdetail (Order_ID, Menu_ID, OrderDetail_Amount) VALUES('$Order_ID', '$Menu_ID', '$OrderDetail_Amount')";
            $result = $con->query($sql);
            if(!$result){
                echo "<script>alert('ไม่สามารถเพิ่มข้อมูลได้')</script>";
            }
            else{
                // คำสั่งสำหรับการอัปเดตราคารวมหลังจากการ INSERT สำเร็จ
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
                $updateResult = $con->query($updateTotalPriceSql);
                $updateAmountMenuSql = "
                UPDATE `menu` SET `Menu_Amount`= Menu_Amount - '$OrderDetail_Amount' WHERE `Menu_ID`='$Menu_ID'
                 ";
                if(!$updateResult){
                    echo "<script>alert('ไม่สามารถอัพเดตราคารวมได้')</script>";
                } else {
                    echo "<script>window.location.href='OrderDetail.php'</script>";
                }
            }
        }
    }
?>