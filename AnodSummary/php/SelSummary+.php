<?php
require_once('../../connection.php');
$dbh = new DBHandler();
if ($dbh->getInstance() === null) {
    die("No database connection");
}
$arr = array();
$sql ="";
$sql1 = "";
$sql2 = "";
$sql3 = "";
// $start_s = $_POST['start_s'];
// $end_s = $_POST['end_s'];

$start_s = "2022/12/01";
$end_s = "2022/12/05";

$sql = "SELECT 
  '3' AS o,
  t100.idd,
  t100.product_name,";
  $begin = new DateTime($start_s);
  $end = new DateTime($end_s);
  $end = $end->modify( '+1 day' );
  $interval = DateInterval::createFromDateString('1 day');
  $period = new DatePeriod($begin, $interval, $end);
  foreach ($period as $key => $dt) {
    $din = $dt->format("Ymd");
$arr[] = $din;
}
    for ($i = 0; $i <= iterator_count($period)-1; $i++) {
        $sql1 = $sql1."(";
        for ($j = 0; $j <= $i; $j++) {
            $sql1 = $sql1."t100._".$arr[$j]."+";
        }
        // $sql1 = $sql1;
        $sql1 = substr(trim($sql1), 0, -1);
        $sql1 = $sql1.") AS _".$arr[$i];
        $sql1 = $sql1.", ";
    }
$sql1 = substr(trim($sql1), 0, -1);
$sql2 = " FROM
            (SELECT 
                '2' AS o,
                m_product.id AS idd,
                m_product.product_name,";

                foreach ($period as $dtp) {
                    $dp = $dtp->format("Y-m-d");
                    $dpn = $dtp->format("Ymd");
                    $sql3 = $sql3 ." MAX(CASE WHEN t_anod_plan.product_date = '". $dp ."' THEN t10.ttq ELSE '' END) AS '_". $dpn ."',";
                    }
                    $sql3 = substr(trim($sql3), 0, -1);
                    $sql3 = $sql3." FROM t_anod_plan
                    LEFT JOIN
                        m_product ON m_product.id = t_anod_plan.production_id
                    LEFT JOIN
                        (SELECT 
                            '2' AS o,
                            m_product.id AS iddd,
                            product_date,
                            m_product.product_name,
                            SUM(quantity) AS ttq
                        FROM
                            t_anod_plan
                    LEFT JOIN m_product ON m_product.id = t_anod_plan.production_id
                    GROUP BY product_date , iddd) t10 ON t10.iddd = t_anod_plan.production_id
                        AND t10.product_date = t_anod_plan.product_date
                GROUP BY idd) t100";


$sql = $sql.$sql1.$sql2.$sql3;
    print_r($sql);
try {
    // $stmt = $dbh->getInstance()->prepare($sql);
    // $stmt->execute();
    // echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} 
catch(PDOException $e) {
    echo $e;
}
?>