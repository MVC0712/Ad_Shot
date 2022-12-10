<?php
require_once('../../connection.php');
$dbh = new DBHandler();
if ($dbh->getInstance() === null) {
    die("No database connection");
}
$datetime = date("Y-m-d H:i:s");
try {
    $sql = "SELECT t_order_sheet.id, order_code, order_date, end_date, quantity ,product_name ,note , updated_at FROM t_order_sheet
        LEFT JOIN
    m_product ON m_product.id = t_order_sheet.product_id
    ORDER BY order_date DESC;";
    $stmt = $dbh->getInstance()->prepare($sql);
    $stmt->execute();
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} 
catch(PDOException $e) {
    echo $e;
}
?>