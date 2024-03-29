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
          $sql_paramater[] = "(3, '{$targetId}', '{$val[1]}', '{$val[2]}')";
        }
        $sql = "INSERT INTO t_machine_runtime(line_id, record_id, start_time, end_time) VALUES ".join(",", $sql_paramater);
        $stmt = $dbh->getInstance()->prepare($sql);
        $stmt->execute();
      }
      echo json_encode("INSERTED");
} 
catch(PDOException $e) {
    echo $e;
}
?>
