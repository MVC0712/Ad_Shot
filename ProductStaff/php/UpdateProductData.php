<?php
require_once('../../connection.php');
$dbh = new DBHandler();
if ($dbh->getInstance() === null) {
    die("No database connection");
}
$id = $_POST['targetId'];
$product_name = $_POST['product_name'];
$area = $_POST['area'];
$current_density = $_POST['current_density'];
$cond_no = $_POST['cond_no'];
try {
    $sql = "UPDATE m_product SET 
    product_name = '$product_name',
    area = '$area',
    current_density = '$current_density',
    cond_no = '$cond_no'
    WHERE id= '$id'";
    $stmt = $dbh->getInstance()->prepare($sql);
    $stmt->execute();
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} 
catch(PDOException $e) {
    echo $e;
}
?>