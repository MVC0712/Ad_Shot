<?php
require_once('../../connection.php');
$dbh = new DBHandler();
if ($dbh->getInstance() === null) {
    die("No database connection");
}

$product_name = $_POST['product_name'];

try {
    $sql = "INSERT INTO m_product (product_name) VALUES ('$product_name')";
    $stmt = $dbh->getInstance()->prepare($sql);
    $stmt->execute();

    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} 
catch(PDOException $e) {
    echo $e;
}
?>