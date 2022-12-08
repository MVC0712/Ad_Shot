<?php
require_once('../../connection.php');
$dbh = new DBHandler();
if ($dbh->getInstance() === null) {
    die("No database connection");
}
$datetime = date("Y-m-d H:i:s");
try {
    $sql = "SELECT 
    t_record_anod.id,
    order_code,
    product_date,
    shift,
    machine,
    product_name,
    input_quantity,
    ng_quantity,
    input_quantity - ng_quantity
FROM
    t_record_anod
        LEFT JOIN
    m_machine ON m_machine.id = t_record_anod.machine_id
        LEFT JOIN
    t_order_sheet ON t_order_sheet.id = t_record_anod.order_sheet_id
        LEFT JOIN
    m_product ON m_product.id = t_record_anod.product_id
        LEFT JOIN
    m_shift ON m_shift.id = t_record_anod.shift_id
        LEFT JOIN
    m_staff ON m_staff.id = t_record_anod.worker_id
    ORDER BY product_date DESC;";
    $stmt = $dbh->getInstance()->prepare($sql);
    $stmt->execute();
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} 
catch(PDOException $e) {
    echo $e;
}
?>