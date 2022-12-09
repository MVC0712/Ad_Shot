<?php
require_once('../../connection.php');
$dbh = new DBHandler();
if ($dbh->getInstance() === null) {
    die("No database connection");
}
$data = file_get_contents('php://input');
$data_json = json_decode($data); 

$targetId = array_pop($data_json);

try {

    if(count($data_json) > 0){
        foreach($data_json as $val){
          $sql_paramater[] = "(2, '{$targetId}', '{$val[1]}', '{$val[2]}', '{$val[3]}')";
        }
        $sql = "INSERT INTO t_record_shot_material(line_id, record_shot_id, shot_material_id, lot, quantity) VALUES ".join(",", $sql_paramater);
        $stmt = $dbh->getInstance()->prepare($sql);
        $stmt->execute();
      }
      echo json_encode("INSERTED");
} 
catch(PDOException $e) {
    echo $e;
}
?>