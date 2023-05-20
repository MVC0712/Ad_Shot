<?php
require_once('../../connection.php');
$dbh = new DBHandler();
if ($dbh->getInstance() === null) {
    die("No database connection");
}
$datetime = date("Y-m-d H:i:s");
try {
    $sql = "SELECT t_recod_current.id, date, time, times, type, product_name, quantity, t_recod_current.area, t_recod_current.current_density, 
        total_current, total_area, t_recod_current.cond_no, anod_no, temp, start_current, finish_current, start_volt, finish_volt 
    FROM t_recod_current
    LEFT JOIN m_product ON m_product.id = t_recod_current.product_id
    ORDER BY date DESC, time DESC;";
    $stmt = $dbh->getInstance()->prepare($sql);
    $stmt->execute();
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} 
catch(PDOException $e) {
    echo $e;
}
?>