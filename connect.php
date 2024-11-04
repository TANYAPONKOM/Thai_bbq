<?php
    $host="localhost";
    $user="root";
    $password="";
    $dbname="minipro_thaibbq";
    
    $con=mysqli_connect($host,$user,$password,$dbname) or die ('ไม่สมารถเชื่อมต่อกับ database ได้');
    $con->query("SET NAMES UTF8");
    ?>