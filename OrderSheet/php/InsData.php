<?php
require_once('../../connection.php');
$dbh = new DBHandler();
if ($dbh->getInstance() === null) {
    die("No database connection");
}

$end_date = $_POST['end_date'];
$note = $_POST['note'];
$order_code = $_POST['order_code'];
$order_date = $_POST['order_date'];
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];

try {
    $sql = "INSERT INTO t_order_sheet (
        order_code, quantity, product_id, order_date, end_date, note) VALUES (
        '$order_code', '$quantity', '$product_id', '$order_date','$end_date', '$note')";
    $stmt = $dbh->getInstance()->prepare($sql);
    $stmt->execute();

    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} 
catch(PDOException $e) {
    echo $e;
}
?>