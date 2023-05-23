<?php
require_once('../../connection.php');
$dbh = new DBHandler();
if ($dbh->getInstance() === null) {
    die("No database connection");
}

$confirm_id = $_POST['confirm_id'];
$worker_id = $_POST['worker_id'];
$shift_id = $_POST['shift_id'];
$product_id = $_POST['product_id'];
$product_date = $_POST['product_date'];
$order_sheet_id = $_POST['order_sheet_id'];
// $ng_quantity = $_POST['ng_quantity'];
$machine_id = $_POST['machine_id'];
$input_quantity = $_POST['input_quantity'];
$performance = $_POST['performance'];
$file_url = $_POST['file_url'];

try {
    $sql = "INSERT INTO t_record_shot(machine_id, order_sheet_id, shift_id, product_id, 
            product_date, input_quantity, worker_id, confirm_id, performance, file_url) VALUES (
    '$machine_id', '$order_sheet_id', '$shift_id', '$product_id','$product_date', 
    '$input_quantity', '$worker_id', '$confirm_id', '$performance', '$file_url')";
    $stmt = $dbh->getInstance()->prepare($sql);
    $stmt->execute();

    $stmt = $dbh->getInstance()->prepare("SELECT MAX(t_record_shot.id) AS id FROM t_record_shot");
    $stmt->execute();
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} 
catch(PDOException $e) {
    echo $e;
}
?>