<?php
require_once('../../connection.php');
$dbh = new DBHandler();
if ($dbh->getInstance() === null) {
    die("No database connection");
}

$acid_cleaning_h2so4_75 = $_POST['acid_cleaning_h2so4_75'];
$acid_cleaning_naoh_2n = $_POST['acid_cleaning_naoh_2n'];
$acid_cleaning_tt_h2so4 = $_POST['acid_cleaning_tt_h2so4'];
$anodizing1_al = $_POST['anodizing1_al'];
$anodizing1_free_acid = $_POST['anodizing1_free_acid'];
$anodizing1_h2so4 = $_POST['anodizing1_h2so4'];
$anodizing1_naoh_2n_1 = $_POST['anodizing1_naoh_2n_1'];
$anodizing1_naoh_2n_2 = $_POST['anodizing1_naoh_2n_2'];
$anodizing1_tt_acid = $_POST['anodizing1_tt_acid'];
$anodizing2_al = $_POST['anodizing2_al'];
$anodizing2_free_acid = $_POST['anodizing2_free_acid'];
$anodizing2_h2so4 = $_POST['anodizing2_h2so4'];
$anodizing2_naoh_2n_1 = $_POST['anodizing2_naoh_2n_1'];
$anodizing2_naoh_2n_2 = $_POST['anodizing2_naoh_2n_2'];
$anodizing2_tt_acid = $_POST['anodizing2_tt_acid'];
$anodizing3_al = $_POST['anodizing3_al'];
$anodizing3_free_acid = $_POST['anodizing3_free_acid'];
$anodizing3_h2so4 = $_POST['anodizing3_h2so4'];
$anodizing3_naoh_2n_1 = $_POST['anodizing3_naoh_2n_1'];
$anodizing3_naoh_2n_2 = $_POST['anodizing3_naoh_2n_2'];
$anodizing3_tt_acid = $_POST['anodizing3_tt_acid'];
$anodizing4_al = $_POST['anodizing4_al'];
$anodizing4_free_acid = $_POST['anodizing4_free_acid'];
$anodizing4_h2so4 = $_POST['anodizing4_h2so4'];
$anodizing4_naoh_2n_1 = $_POST['anodizing4_naoh_2n_1'];
$anodizing4_naoh_2n_2 = $_POST['anodizing4_naoh_2n_2'];
$anodizing4_tt_acid = $_POST['anodizing4_tt_acid'];
$chemical_polishing_density = $_POST['chemical_polishing_density'];
$chemical_polishing_edta = $_POST['chemical_polishing_edta'];
$chemical_polishing_fenh4_1 = $_POST['chemical_polishing_fenh4_1'];
$chemical_polishing_fenh4_2 = $_POST['chemical_polishing_fenh4_2'];
$chemical_polishing_hno3_62 = $_POST['chemical_polishing_hno3_62'];
$chemical_polishing_naoh_1n = $_POST['chemical_polishing_naoh_1n'];
$chemical_polishing_sl = $_POST['chemical_polishing_sl'];
$chemical_polishing_tt_alpo4 = $_POST['chemical_polishing_tt_alpo4'];
$chemical_polishing_tt_h3po4 = $_POST['chemical_polishing_tt_h3po4'];
$chemical_polishing_tt_hno3 = $_POST['chemical_polishing_tt_hno3'];
$date = $_POST['date'];
$degreasing_naoh_1n = $_POST['degreasing_naoh_1n'];
$degreasing_h2so4_75 = $_POST['degreasing_h2so4_75'];
$degreasing_so4 = $_POST['degreasing_so4'];
$degreasing_tt_h2so4 = $_POST['degreasing_tt_h2so4'];
$etching_al = $_POST['etching_al'];
$etching_free_naoh = $_POST['etching_free_naoh'];
$etching_hcl_1n1 = $_POST['etching_hcl_1n1'];
$etching_hcl_1n2 = $_POST['etching_hcl_1n2'];
$etching_naoh_25 = $_POST['etching_naoh_25'];
$etching_sl = $_POST['etching_sl'];
$etching_tt_naoh = $_POST['etching_tt_naoh'];
$hole_sealing_hno3_62 = $_POST['hole_sealing_hno3_62'];
$hole_sealing_mf115 = $_POST['hole_sealing_mf115'];
$hole_sealing_naoh_25 = $_POST['hole_sealing_naoh_25'];
$hole_sealing_ph = $_POST['hole_sealing_ph'];
$shift_id = $_POST['shift_id'];
$smut_h2so4_75 = $_POST['smut_h2so4_75'];
$smut_naoh_2n = $_POST['smut_naoh_2n'];
$smut_tt_h2so4 = $_POST['smut_tt_h2so4'];
$staff_id = $_POST['staff_id'];
$time = $_POST['time'];

try {
    $sql = "INSERT INTO t_solution(acid_cleaning_h2so4_75, acid_cleaning_naoh_2n, acid_cleaning_tt_h2so4, 
    anodizing1_al, anodizing1_free_acid, anodizing1_h2so4, anodizing1_naoh_2n_1, anodizing1_naoh_2n_2, anodizing1_tt_acid, 
    anodizing2_al, anodizing2_free_acid, anodizing2_h2so4, anodizing2_naoh_2n_1, anodizing2_naoh_2n_2, anodizing2_tt_acid, 
    anodizing3_al, anodizing3_free_acid, anodizing3_h2so4, anodizing3_naoh_2n_1, anodizing3_naoh_2n_2, anodizing3_tt_acid, 
    anodizing4_al, anodizing4_free_acid, anodizing4_h2so4, anodizing4_naoh_2n_1, anodizing4_naoh_2n_2, anodizing4_tt_acid, 
    chemical_polishing_density, chemical_polishing_edta, chemical_polishing_fenh4_1, chemical_polishing_fenh4_2, chemical_polishing_hno3_62, 
    chemical_polishing_naoh_1n, chemical_polishing_sl, chemical_polishing_tt_alpo4, chemical_polishing_tt_h3po4, chemical_polishing_tt_hno3, 
    date, degreasing_naoh_1n, degreasing_h2so4_75, degreasing_so4, degreasing_tt_h2so4, 
    etching_al, etching_free_naoh, etching_hcl_1n1, etching_hcl_1n2, etching_naoh_25, etching_sl, etching_tt_naoh, 
    hole_sealing_hno3_62, hole_sealing_mf115, hole_sealing_naoh_25, hole_sealing_ph, shift_id, 
    smut_h2so4_75, smut_naoh_2n, smut_tt_h2so4, staff_id, time) VALUES 
    ('$acid_cleaning_h2so4_75','$acid_cleaning_naoh_2n','$acid_cleaning_tt_h2so4',
    '$anodizing1_al','$anodizing1_free_acid','$anodizing1_h2so4','$anodizing1_naoh_2n_1','$anodizing1_naoh_2n_2','$anodizing1_tt_acid',
    '$anodizing2_al','$anodizing2_free_acid','$anodizing2_h2so4','$anodizing2_naoh_2n_1','$anodizing2_naoh_2n_2','$anodizing2_tt_acid',
    '$anodizing3_al','$anodizing3_free_acid','$anodizing3_h2so4','$anodizing3_naoh_2n_1','$anodizing3_naoh_2n_2','$anodizing3_tt_acid',
    '$anodizing4_al','$anodizing4_free_acid','$anodizing4_h2so4','$anodizing4_naoh_2n_1','$anodizing4_naoh_2n_2','$anodizing4_tt_acid',
    '$chemical_polishing_density','$chemical_polishing_edta','$chemical_polishing_fenh4_1','$chemical_polishing_fenh4_2','$chemical_polishing_hno3_62',
    '$chemical_polishing_naoh_1n','$chemical_polishing_sl','$chemical_polishing_tt_alpo4','$chemical_polishing_tt_h3po4','$chemical_polishing_tt_hno3',
    '$date','$degreasing_naoh_1n','$degreasing_h2so4_75','$degreasing_so4','$degreasing_tt_h2so4',
    '$etching_al','$etching_free_naoh','$etching_hcl_1n1','$etching_hcl_1n2','$etching_naoh_25','$etching_sl','$etching_tt_naoh',
    '$hole_sealing_hno3_62','$hole_sealing_mf115','$hole_sealing_naoh_25','$hole_sealing_ph','$shift_id',
    '$smut_h2so4_75','$smut_naoh_2n','$smut_tt_h2so4','$staff_id','$time')";
    $stmt = $dbh->getInstance()->prepare($sql);
    $stmt->execute();
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} 
catch(PDOException $e) {
    echo $e;
}
?>