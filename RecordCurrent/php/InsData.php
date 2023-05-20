<?php
require_once('../../connection.php');
$dbh = new DBHandler();
if ($dbh->getInstance() === null) {
    die("No database connection");
}

$date = $_POST['date'];
$time = $_POST['time'];
$times = $_POST['times'];
$type = $_POST['type'];
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];
$area = $_POST['area'];
$current_density = $_POST['current_density'];
$total_current = $_POST['total_current'];
$total_area = $_POST['total_area'];
$cond_no = $_POST['cond_no'];
$anod_no = $_POST['anod_no'];
$temp = $_POST['temp'];
$start_current = $_POST['start_current'];
$finish_current = $_POST['finish_current'];
$start_volt = $_POST['start_volt'];
$finish_volt = $_POST['finish_volt'];

try {
    $sql = "INSERT INTO t_recod_current ( 
        date, time, times, type, product_id, quantity, area, current_density, 
        total_current, total_area, cond_no, anod_no, temp, start_current, finish_current, start_volt, finish_volt) VALUES (
        '$date', '$time', '$times', '$type', '$product_id', '$quantity', '$area', '$current_density',
        '$total_current', '$total_area', '$cond_no', '$anod_no', '$temp', '$start_current', '$finish_current', '$start_volt', '$finish_volt')";
    $stmt = $dbh->getInstance()->prepare($sql);
    $stmt->execute();
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} 
catch(PDOException $e) {
    echo $e;
}
?>