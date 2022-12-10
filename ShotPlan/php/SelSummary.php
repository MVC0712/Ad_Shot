<?php
require_once('../../connection.php');
$dbh = new DBHandler();
if ($dbh->getInstance() === null) {
    die("No database connection");
}
$start = $_POST['start'];
$end = $_POST['end'];
$product_name = $_POST['product_name'];
$datetime = date("Y-m-d H:i:s");
try {
    $sql = "SELECT 
    t_anod_plan.id,
    production_id,
    product_date,
    product_name,
    machine_id,
    quantity,
    note
FROM
    t_anod_plan
        LEFT JOIN
    m_product ON m_product.id = t_anod_plan.production_id
    WHERE
    t_anod_plan.product_date BETWEEN '$start' AND '$end' AND m_product.product_name LIKE '%$product_name%'
    ORDER BY product_date DESC, machine_id ASC;";
    $stmt = $dbh->getInstance()->prepare($sql);
    $stmt->execute();
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} 
catch(PDOException $e) {
    echo $e;
}
?>