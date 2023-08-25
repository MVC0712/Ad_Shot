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
$anod_machine_id = $_POST['anod_machine_id'];
$targetId = $_POST['targetId'];

try {
    $sql = "UPDATE t_solution SET 
    acid_cleaning_h2so4_75= '$acid_cleaning_h2so4_75',
    acid_cleaning_naoh_2n= '$acid_cleaning_naoh_2n',
    acid_cleaning_tt_h2so4= '$acid_cleaning_tt_h2so4',
    anodizing1_al= '$anodizing1_al',
    anodizing1_free_acid= '$anodizing1_free_acid',
    anodizing1_h2so4= '$anodizing1_h2so4',
    anodizing1_naoh_2n_1= '$anodizing1_naoh_2n_1',
    anodizing1_naoh_2n_2= '$anodizing1_naoh_2n_2',
    anodizing1_tt_acid= '$anodizing1_tt_acid',
    anodizing2_al= '$anodizing2_al',
    anodizing2_free_acid= '$anodizing2_free_acid',
    anodizing2_h2so4= '$anodizing2_h2so4',
    anodizing2_naoh_2n_1= '$anodizing2_naoh_2n_1',
    anodizing2_naoh_2n_2= '$anodizing2_naoh_2n_2',
    anodizing2_tt_acid= '$anodizing2_tt_acid',
    anodizing3_al= '$anodizing3_al',
    anodizing3_free_acid= '$anodizing3_free_acid',
    anodizing3_h2so4= '$anodizing3_h2so4',
    anodizing3_naoh_2n_1= '$anodizing3_naoh_2n_1',
    anodizing3_naoh_2n_2= '$anodizing3_naoh_2n_2',
    anodizing3_tt_acid= '$anodizing3_tt_acid',
    anodizing4_al= '$anodizing4_al',
    anodizing4_free_acid= '$anodizing4_free_acid',
    anodizing4_h2so4= '$anodizing4_h2so4',
    anodizing4_naoh_2n_1= '$anodizing4_naoh_2n_1',
    anodizing4_naoh_2n_2= '$anodizing4_naoh_2n_2',
    anodizing4_tt_acid= '$anodizing4_tt_acid',
    chemical_polishing_density= '$chemical_polishing_density',
    chemical_polishing_edta= '$chemical_polishing_edta',
    chemical_polishing_fenh4_1= '$chemical_polishing_fenh4_1',
    chemical_polishing_fenh4_2= '$chemical_polishing_fenh4_2',
    chemical_polishing_hno3_62= '$chemical_polishing_hno3_62',
    chemical_polishing_naoh_1n= '$chemical_polishing_naoh_1n',
    chemical_polishing_sl= '$chemical_polishing_sl',
    chemical_polishing_tt_alpo4= '$chemical_polishing_tt_alpo4',
    chemical_polishing_tt_h3po4= '$chemical_polishing_tt_h3po4',
    chemical_polishing_tt_hno3= '$chemical_polishing_tt_hno3',
    date= '$date',
    degreasing_naoh_1n= '$degreasing_naoh_1n',
    degreasing_h2so4_75= '$degreasing_h2so4_75',
    degreasing_so4= '$degreasing_so4',
    degreasing_tt_h2so4= '$degreasing_tt_h2so4',
    etching_al= '$etching_al',
    etching_free_naoh= '$etching_free_naoh',
    etching_hcl_1n1= '$etching_hcl_1n1',
    etching_hcl_1n2= '$etching_hcl_1n2',
    etching_naoh_25= '$etching_naoh_25',
    etching_sl= '$etching_sl',
    etching_tt_naoh= '$etching_tt_naoh',
    hole_sealing_hno3_62= '$hole_sealing_hno3_62',
    hole_sealing_mf115= '$hole_sealing_mf115',
    hole_sealing_naoh_25= '$hole_sealing_naoh_25',
    hole_sealing_ph= '$hole_sealing_ph',
    shift_id= '$shift_id',
    smut_h2so4_75= '$smut_h2so4_75',
    smut_naoh_2n= '$smut_naoh_2n',
    smut_tt_h2so4= '$smut_tt_h2so4',
    staff_id= '$staff_id',
    anod_machine_id= '$anod_machine_id',
    time= '$time' WHERE id = '$targetId'";
    $stmt = $dbh->getInstance()->prepare($sql);
    $stmt->execute();
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} 
catch(PDOException $e) {
    echo $e;
}
?>