<?php
require_once('../../connection.php');
$dbh = new DBHandler();
if ($dbh->getInstance() === null) {
    die("No database connection");
}
$id = $_POST['targetId'];
$input_date = $_POST['input_date'];
$input_time = $_POST['input_time'];
$staff_check = $_POST['staff_check'];
$ac_h2so4_ml = $_POST['ac_h2so4_ml'];
$ac_h2so4_mll = $_POST['ac_h2so4_mll'];
$an_h2so4_ml = $_POST['an_h2so4_ml'];
$an_h2so4_mll = $_POST['an_h2so4_mll'];
$et_naoh_l = $_POST['et_naoh_l'];
$et_naoh_mll = $_POST['et_naoh_mll'];
$et_sk_l = $_POST['et_sk_l'];
$fu_mf_gl = $_POST['fu_mf_gl'];
$fu_mf_l = $_POST['fu_mf_l'];
$oi_h2so4_l = $_POST['oi_h2so4_l'];
$oi_h2so4_mll = $_POST['oi_h2so4_mll'];
$oi_so4_l = $_POST['oi_so4_l'];
$po_hno3_ml = $_POST['po_hno3_ml'];
$po_hno3_mll = $_POST['po_hno3_mll'];
$po_sl_l = $_POST['po_sl_l'];
$sm_h2so4_l = $_POST['sm_h2so4_l'];
$sm_h2so4_mll = $_POST['sm_h2so4_mll'];

try {
    $sql = "UPDATE t_recod_solution SET 
    input_date = '$input_date',
    input_time = '$input_time',
    staff_check = '$staff_check',
    ac_h2so4_ml = '$ac_h2so4_ml',
    ac_h2so4_mll = '$ac_h2so4_mll',
    an_h2so4_ml = '$an_h2so4_ml',
    an_h2so4_mll = '$an_h2so4_mll',
    et_naoh_l = '$et_naoh_l',
    et_naoh_mll = '$et_naoh_mll',
    et_sk_l = '$et_sk_l',
    fu_mf_gl = '$fu_mf_gl',
    fu_mf_l = '$fu_mf_l',
    oi_h2so4_l = '$oi_h2so4_l',
    oi_h2so4_mll = '$oi_h2so4_mll',
    oi_so4_l = '$oi_so4_l',
    po_hno3_ml = '$po_hno3_ml',
    po_hno3_mll = '$po_hno3_mll',
    po_sl_l = '$po_sl_l',
    sm_h2so4_l = '$sm_h2so4_l',
    sm_h2so4_mll = '$sm_h2so4_mll'
    WHERE id= '$id'";
    $stmt = $dbh->getInstance()->prepare($sql);
    $stmt->execute();
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} 
catch(PDOException $e) {
    echo $e;
}
?>