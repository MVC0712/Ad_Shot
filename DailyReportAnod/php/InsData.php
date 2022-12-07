<?php
require_once('../../connection.php');
$dbh = new DBHandler();
if ($dbh->getInstance() === null) {
    die("No database connection");
}

$confirm_id = $_POST['confirm_id'];
$worker_id = $_POST['worker_id'];
$shift = $_POST['shift'];
$product_id = $_POST['product_id'];
$product_date = $_POST['product_date'];
$order_sheet_id = $_POST['order_sheet_id'];
$ng_quantity = $_POST['ng_quantity'];
$machine_id = $_POST['machine_id'];
$input_quantity = $_POST['input_quantity'];
$file_url = $_POST['file_url'];

try {
    $sql = "INSERT INTO t_record_anod(machine_id, order_sheet_id, shift_id, product_id, 
            product_date, input_quantity, ng_quantity, worker_id, confirm_id, file_url) VALUES (
    '$machine_id', '$order_sheet_id', '$shift', '$product_id','$product_date', 
    '$input_quantity', '$ng_quantity', '$worker_id', '$confirm_id', '$file_url')";
    $stmt = $dbh->getInstance()->prepare($sql);
    $stmt->execute();


    $stmt = $dbh->getInstance()->prepare("SELECT MAX(t_record_anod.id) AS id FROM t_record_anod");
    $stmt->execute();
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} 
catch(PDOException $e) {
    echo $e;
}
?>