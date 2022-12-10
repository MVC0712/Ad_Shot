<?php
require_once('../../connection.php');
$dbh = new DBHandler();
if ($dbh->getInstance() === null) {
    die("No database connection");
}
$id = $_POST['targetId'];
$end_date = $_POST['end_date'];
$note = $_POST['note'];
$order_code = $_POST['order_code'];
$order_date = $_POST['order_date'];
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];
$datetime = date("Y-m-d H:i:s");
try {
    $sql = "UPDATE t_order_sheet SET 
    end_date = '$end_date' ,
    note = '$note' ,
    order_code = '$order_code' ,
    order_date = '$order_date' ,
    product_id = '$product_id' ,
    quantity = '$quantity',
    updated_at = '$datetime'
    WHERE id= '$id'";
    $stmt = $dbh->getInstance()->prepare($sql);
    $stmt->execute();
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} 
catch(PDOException $e) {
    echo $e;
}
?>