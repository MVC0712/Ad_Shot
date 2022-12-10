<?php
require_once('../../connection.php');
$dbh = new DBHandler();
if ($dbh->getInstance() === null) {
    die("No database connection");
}
$data = $_POST['data'];
$shot_date_at = $_POST['shot_date_at'];
$data_json = json_decode($data);

try {

    if(count($data_json) > 0){
      foreach ($data_json as $val) {
        $sql_paramater[] = "('{$val[0]}', '{$val[2]}', '{$val[3]}', '{$val[4]}', '{$shot_date_at}')";
    };

    $sql = "INSERT INTO t_shot_plan (production_id, machine_id, quantity, note, product_date) VALUES ";
    $sql = $sql.join(",", $sql_paramater);
        $stmt = $dbh->getInstance()->prepare($sql);
        $stmt->execute();
      }
      echo json_encode("INSERTED");
} 
catch(PDOException $e) {
    echo $e;
}
?>
