<?php
require_once('../../connection.php');
$dbh = new DBHandler();
if ($dbh->getInstance() === null) {
    die("No database connection");
}
$id = $_POST['targetId'];$confirm_id = $_POST['confirm_id'];
$worker_id = $_POST['worker_id'];
$shift_id = $_POST['shift_id'];
$product_id = $_POST['product_id'];
$product_date = $_POST['product_date'];
$order_sheet_id = $_POST['order_sheet_id'];
$ng_quantity = $_POST['ng_quantity'];
$machine_id = $_POST['machine_id'];
$input_quantity = $_POST['input_quantity'];
$performance = $_POST['performance'];
$file_url = $_POST['file_url'];

try {
    $sql = "UPDATE t_record_anod SET 
    worker_id = '$worker_id' ,
    shift_id = '$shift_id' ,
    product_id = '$product_id' ,
    product_date = '$product_date' ,
    order_sheet_id = '$order_sheet_id' ,
    ng_quantity = '$ng_quantity' ,
    machine_id = '$machine_id' ,
    input_quantity = '$input_quantity' ,
    performance = '$performance' ,
    file_url = '$file_url'
    WHERE id= '$id'";
    $stmt = $dbh->getInstance()->prepare($sql);
    $stmt->execute();
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} 
catch(PDOException $e) {
    echo $e;
}
?>