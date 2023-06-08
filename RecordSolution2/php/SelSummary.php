<?php
require_once('../../connection.php');
$dbh = new DBHandler();
if ($dbh->getInstance() === null) {
    die("No database connection");
}
$datetime = date("Y-m-d H:i:s");
try {
    $sql = "SELECT t_solution.id, CONCAT(DATE_FORMAT(date,'%y-%m-%d'),' ', TIME_FORMAT(time, '%H:%i')) AS dt, 
    m_staff.name, shift, degreasing_naoh_1n, degreasing_tt_h2so4, degreasing_h2so4_75, degreasing_so4,
    etching_hcl_1n1, etching_hcl_1n2, etching_tt_naoh, etching_free_naoh, etching_al, etching_naoh_25, etching_sl, 
    chemical_polishing_density, chemical_polishing_fenh4_1, chemical_polishing_fenh4_2, chemical_polishing_tt_hno3, chemical_polishing_naoh_1n, chemical_polishing_tt_h3po4, chemical_polishing_edta, chemical_polishing_tt_alpo4, chemical_polishing_hno3_62, chemical_polishing_sl,
    smut_naoh_2n, smut_tt_h2so4, smut_h2so4_75, 
    anodizing1_naoh_2n_1, anodizing1_naoh_2n_2, anodizing1_tt_acid, anodizing1_free_acid, anodizing1_al, anodizing1_h2so4, 
    anodizing2_naoh_2n_1, anodizing2_naoh_2n_2, anodizing2_tt_acid, anodizing2_free_acid, anodizing2_al, anodizing2_h2so4, 
    anodizing3_naoh_2n_1, anodizing3_naoh_2n_2, anodizing3_tt_acid, anodizing3_free_acid, anodizing3_al, anodizing3_h2so4, 
    anodizing4_naoh_2n_1, anodizing4_naoh_2n_2, anodizing4_tt_acid, anodizing4_free_acid, anodizing4_al, anodizing4_h2so4, 
    hole_sealing_ph, hole_sealing_hno3_62, hole_sealing_naoh_25, hole_sealing_mf115,
    acid_cleaning_naoh_2n, acid_cleaning_tt_h2so4, acid_cleaning_h2so4_75    
    FROM t_solution
        LEFT JOIN
    m_staff ON m_staff.id = t_solution.staff_id
    LEFT JOIN
    m_shift ON m_shift.id = t_solution.shift_id
    ORDER BY date DESC, time DESC;";
    $stmt = $dbh->getInstance()->prepare($sql);
    $stmt->execute();
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} 
catch(PDOException $e) {
    echo $e;
}
?>