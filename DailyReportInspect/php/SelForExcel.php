<?php
require_once('../../connection.php');
$dbh = new DBHandler();
if ($dbh->getInstance() === null) {
    die("No database connection");
}
$start = $_POST['start'];
$end = $_POST['end'];
try {
    $sql = "SELECT 
    order_code,
    product_date,
    shift,
    machine,
    product_name,
    input_quantity,
    t1.ng_quantity,
    input_quantity - t1.ng_quantity AS ok,
    t1.a1,
    t1.a2,
    t1.a3,
    t1.a4,
    t1.a5
FROM
    t_record_inspect
        LEFT JOIN
    m_machine ON m_machine.id = t_record_inspect.machine_id
        LEFT JOIN
    t_order_sheet ON t_order_sheet.id = t_record_inspect.order_sheet_id
        LEFT JOIN
    m_product ON m_product.id = t_record_inspect.product_id
        LEFT JOIN
    m_shift ON m_shift.id = t_record_inspect.shift_id
        LEFT JOIN
    m_staff ON m_staff.id = t_record_inspect.worker_id
        LEFT JOIN
    (SELECT 
        record_inspect_id AS idd,
            inspect_error_id,
            SUM(ng_quantity) AS ng_quantity,
            SUM(CASE
                WHEN m_anod_error.code = 'A1' THEN t_record_inspect_error.ng_quantity
                ELSE 0
            END) AS a1,
            SUM(CASE
                WHEN m_anod_error.code = 'A2' THEN t_record_inspect_error.ng_quantity
                ELSE 0
            END) AS a2,
            SUM(CASE
                WHEN m_anod_error.code = 'A3' THEN t_record_inspect_error.ng_quantity
                ELSE 0
            END) AS a3,
            SUM(CASE
                WHEN m_anod_error.code = 'A4' THEN t_record_inspect_error.ng_quantity
                ELSE 0
            END) AS a4,
            SUM(CASE
                WHEN m_anod_error.code = 'A5' THEN t_record_inspect_error.ng_quantity
                ELSE 0
            END) AS a5
    FROM
        t_record_inspect_error
    LEFT JOIN m_anod_error ON m_anod_error.id = t_record_inspect_error.inspect_error_id
    GROUP BY record_inspect_id) t1 ON t1.idd = t_record_inspect.id
WHERE product_date BETWEEN '$start' AND '$end'
ORDER BY product_date DESC
;";
    $stmt = $dbh->getInstance()->prepare($sql);
    $stmt->execute();
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} 
catch(PDOException $e) {
    echo $e;
}
?>