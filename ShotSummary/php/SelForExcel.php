<?php
require_once('../../connection.php');
$dbh = new DBHandler();
if ($dbh->getInstance() === null) {
    die("No database connection");
}
$sql ="";
$sql1 = "";
$sql2 = "";
$sql3 = "";
$sql4 = "";
$sql5 = "";
$sql6 = "";
$sql7 = "";
$sql8 = "";
$sql9 = "";
$sql10 = "";
$sql11 = "";
$sql12 = "";
$sql13 = "";
$sql14 = "";
$sql15 = "";

// $start_s = "2022/12/01";
// $end_s = "2022/12/05";
$start_s = $_POST['start_s'];
$end_s = $_POST['end_s'];

$begin = new DateTime($start_s);
$end = new DateTime($end_s);
$end = $end->modify( '+1 day' );
$interval = DateInterval::createFromDateString('1 day');
$period = new DatePeriod($begin, $interval, $end);


foreach ($period as $dt) {
    $di = $dt->format("Y-m-d");
    $din = $dt->format("Ymd");

}





try {
    $stmt = $dbh->getInstance()->prepare($sql);
    $stmt->execute();
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} 
catch(PDOException $e) {
    echo $e;
}
?>