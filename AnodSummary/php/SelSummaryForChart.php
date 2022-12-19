<?php
require_once('../../connection.php');
$dbh = new DBHandler();
if ($dbh->getInstance() === null) {
    die("No database connection");
}
$sql ="";
$sql1 = "";
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
    $arr1 = array();
    $sql3 = "";
    $sql4 = "";

    $sql3 = " SELECT 
      '4' AS o, ";
      $begin = new DateTime($start_s);
      $end = new DateTime($end_s);
      $end = $end->modify( '+1 day' );
      $interval = DateInterval::createFromDateString('1 day');
      $period = new DatePeriod($begin, $interval, $end);
      foreach ($period as $key => $dt) {
        $din = $dt->format("Ymd");
    $arr1[] = $din;
    }
        for ($i = 0; $i <= iterator_count($period)-1; $i++) {
            $sql4 = $sql4."(";
            for ($j = 0; $j <= $i; $j++) {
                $sql4 = $sql4."t1003._".$arr1[$j]."+";
            }
            $sql4 = substr(trim($sql4), 0, -1);
            $sql4 = $sql4.") AS _".$arr1[$i];
            $sql4 = $sql4." , ";
        }
    $sql4 = substr(trim($sql4), 0, -1);
    $sql5 = " FROM
                (SELECT 
                    '4' AS o,
                    m_product.id AS idd,
                    m_product.product_name,";
    
                    foreach ($period as $dtp) {
                        $dp = $dtp->format("Y-m-d");
                        $dpn = $dtp->format("Ymd");
                        $sql5 = $sql5 ." MAX(CASE WHEN t_anod_plan.product_date = '". $dp ."' THEN t103.ttq ELSE '' END) AS '_". $dpn ."' ,";
                        }
                        $sql5 = substr(trim($sql5), 0, -1);
                        $sql5 = $sql5." FROM t_anod_plan
                        LEFT JOIN
                            m_product ON m_product.id = t_anod_plan.production_id
                        LEFT JOIN
                            (SELECT 
                                '4' AS o,
                                m_product.id AS iddd,
                                product_date,
                                m_product.product_name,
                                SUM(quantity) AS ttq
                            FROM
                                t_anod_plan
                        LEFT JOIN m_product ON m_product.id = t_anod_plan.production_id
                        GROUP BY product_date , iddd) t103 ON t103.iddd = t_anod_plan.production_id
                            AND t103.product_date = t_anod_plan.product_date
                    GROUP BY o) t1003";
    
                    $arr2 = array();
                    $sql6 = "";
                    $sql7 = "";
                
                    $sql6 = " UNION SELECT 
                      '3' AS o, ";
                      $begin = new DateTime($start_s);
                      $end = new DateTime($end_s);
                      $end = $end->modify( '+1 day' );
                      $interval = DateInterval::createFromDateString('1 day');
                      $period = new DatePeriod($begin, $interval, $end);
                      foreach ($period as $key => $dt) {
                        $din = $dt->format("Ymd");
                    $arr2[] = $din;
                    }
                        for ($i = 0; $i <= iterator_count($period)-1; $i++) {
                            $sql7 = $sql7."(";
                            for ($j = 0; $j <= $i; $j++) {
                                $sql7 = $sql7."t1004._".$arr2[$j]."+";
                            }
                            // $sql7 = $sql7;
                            $sql7 = substr(trim($sql7), 0, -1);
                            $sql7 = $sql7.") AS _".$arr2[$i];
                            $sql7 = $sql7." , ";
                        }
                    $sql7 = substr(trim($sql7), 0, -1);
                    $sql8 = " FROM
                                (SELECT 
                                    '3' AS o,
                                    m_product.id AS idd,
                                    m_product.product_name,";
                    
                                    foreach ($period as $dtp) {
                                        $dp = $dtp->format("Y-m-d");
                                        $dpn = $dtp->format("Ymd");
                                        $sql8 = $sql8 ." MAX(CASE WHEN t_record_anod.product_date = '". $dp ."' THEN t104.ttqq ELSE '' END) AS '_". $dpn ."' , ";
                                        }
                                        $sql8 = substr(trim($sql8), 0, -1);
                                        $sql8 = $sql8." FROM t_record_anod
                                        LEFT JOIN
                                            m_product ON m_product.id = t_record_anod.product_id
                                        LEFT JOIN
                                            (SELECT 
                                                '3' AS o,
                                                m_product.id AS idddd,
                                                product_date,
                                                m_product.product_name,
                                                SUM(input_quantity) - SUM(ng_quantity) AS ttqq
                                            FROM
                                                t_record_anod
                                        LEFT JOIN m_product ON m_product.id = t_record_anod.product_id
                                        GROUP BY product_date , idddd) t104 ON t104.idddd = t_record_anod.product_id
                                            AND t104.product_date = t_record_anod.product_date
                                    GROUP BY o) t1004 
                                    ORDER BY o ASC
                                    ";


    $sql = $sql.$sql3.$sql4.$sql5.$sql6.$sql7.$sql8;
    // print_r($sql);

try {
    $stmt = $dbh->getInstance()->prepare($sql);
    $stmt->execute();
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} 
catch(PDOException $e) {
    echo $e;
}
?>