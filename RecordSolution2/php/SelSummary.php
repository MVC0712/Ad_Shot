<?php
require_once('../../connection.php');
$dbh = new DBHandler();
if ($dbh->getInstance() === null) {
    die("No database connection");
}
$datetime = date("Y-m-d H:i:s");
try {
    $sql = "SELECT t_recod_solution.id, CONCAT(DATE_FORMAT(input_date,'%y-%m-%d'),' ', TIME_FORMAT(input_time, '%H:%i')) AS dt, m_staff.name, oi_h2so4_mll, oi_h2so4_l, oi_so4_l,
            et_naoh_mll, et_naoh_l, et_sk_l, po_hno3_mll, po_hno3_ml, po_sl_l, sm_h2so4_mll, sm_h2so4_l,
            an_h2so4_mll, an_h2so4_ml, fu_mf_gl, fu_mf_l, ac_h2so4_mll, ac_h2so4_ml
    FROM t_recod_solution
        LEFT JOIN
    m_staff ON m_staff.id = t_recod_solution.staff_check
    ORDER BY input_date DESC, input_date DESC;";
    $stmt = $dbh->getInstance()->prepare($sql);
    $stmt->execute();
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} 
catch(PDOException $e) {
    echo $e;
}
?>