<?php
require_once('../../connection.php');
$dbh = new DBHandler();
if ($dbh->getInstance() === null) {
    die("No database connection");
}

$arr = array();

// $start_s = "2023/09/13";
// $end_s = "2023/09/15";
$start_s = $_POST['start_s'];
$end_s = $_POST['end_s'];

$begin = new DateTime($start_s);
$end = new DateTime($end_s);
$end = $end->modify( '+1 day' );
$interval = DateInterval::createFromDateString('1 day');
$period = new DatePeriod($begin, $interval, $end);

foreach ($period as $key => $dt) {
    $din = $dt->format("Ymd");
    $arr[] = $din;
}

$sql1 = "SELECT 
    product_name, 
    'A1' AS 不良,
";

foreach ($period as $dt) {
    $di = $dt->format("Y-m-d");
    $din = $dt->format("Ymd");
    $sql1 = $sql1 ." MAX(CASE WHEN ttt.product_date = '" . $di . "' THEN ttt.ngq ELSE 0 END) AS '_" . $din ."',";
}
$sql1 = substr(trim($sql1), 0, -1);
$sql1 = $sql1." FROM
(SELECT 
    '合計' AS product_name,
    product_date,
    code,
    SUM(ng_quantity) AS ngq
FROM
    (SELECT 
        t_record_inspect.id,
            product_date,
            product_name,
            code,
            SUM(IFNULL(t_record_inspect_error.ng_quantity, 0)) AS ng_quantity
    FROM
        t_record_inspect
    LEFT JOIN t_record_inspect_error ON t_record_inspect.id = t_record_inspect_error.record_inspect_id
    LEFT JOIN m_product ON m_product.id = t_record_inspect.product_id
    LEFT JOIN m_anod_error ON m_anod_error.id = t_record_inspect_error.inspect_error_id
    where code ='A1'
    GROUP BY t_record_inspect.id) tt
GROUP BY tt.product_date)ttt ";

$sql2 = " UNION SELECT 
    product_name, 
    'A2' AS 不良,
";

foreach ($period as $dt) {
    $di = $dt->format("Y-m-d");
    $din = $dt->format("Ymd");
    $sql2 = $sql2 ." MAX(CASE WHEN ttt.product_date = '" . $di . "' THEN ttt.ngq ELSE 0 END) AS '_" . $din ."',";
}
$sql2 = substr(trim($sql2), 0, -1);
$sql2 = $sql2." FROM
(SELECT 
    '合計' AS product_name,
    product_date,
    code,
    SUM(ng_quantity) AS ngq
FROM
    (SELECT 
        t_record_inspect.id,
            product_date,
            product_name,
            code,
            SUM(IFNULL(t_record_inspect_error.ng_quantity, 0)) AS ng_quantity
    FROM
        t_record_inspect
    LEFT JOIN t_record_inspect_error ON t_record_inspect.id = t_record_inspect_error.record_inspect_id
    LEFT JOIN m_product ON m_product.id = t_record_inspect.product_id
    LEFT JOIN m_anod_error ON m_anod_error.id = t_record_inspect_error.inspect_error_id
    where code ='A2'
    GROUP BY t_record_inspect.id) tt
GROUP BY tt.product_date)ttt ";

$sql3 = " UNION SELECT 
    product_name, 
    'A3' AS 不良,
";

foreach ($period as $dt) {
    $di = $dt->format("Y-m-d");
    $din = $dt->format("Ymd");
    $sql3 = $sql3 ." MAX(CASE WHEN ttt.product_date = '" . $di . "' THEN ttt.ngq ELSE 0 END) AS '_" . $din ."',";
}
$sql3 = substr(trim($sql3), 0, -1);
$sql3 = $sql3." FROM
(SELECT 
    '合計' AS product_name,
    product_date,
    code,
    SUM(ng_quantity) AS ngq
FROM
    (SELECT 
        t_record_inspect.id,
            product_date,
            product_name,
            code,
            SUM(IFNULL(t_record_inspect_error.ng_quantity, 0)) AS ng_quantity
    FROM
        t_record_inspect
    LEFT JOIN t_record_inspect_error ON t_record_inspect.id = t_record_inspect_error.record_inspect_id
    LEFT JOIN m_product ON m_product.id = t_record_inspect.product_id
    LEFT JOIN m_anod_error ON m_anod_error.id = t_record_inspect_error.inspect_error_id
    where code ='A3'
    GROUP BY t_record_inspect.id) tt
GROUP BY tt.product_date)ttt ";

$sql4 = " UNION SELECT 
    product_name, 
    'A4' AS 不良,
";

foreach ($period as $dt) {
    $di = $dt->format("Y-m-d");
    $din = $dt->format("Ymd");
    $sql4 = $sql4 ." MAX(CASE WHEN ttt.product_date = '" . $di . "' THEN ttt.ngq ELSE 0 END) AS '_" . $din ."',";
}
$sql4 = substr(trim($sql4), 0, -1);
$sql4 = $sql4." FROM
(SELECT 
    '合計' AS product_name,
    product_date,
    code,
    SUM(ng_quantity) AS ngq
FROM
    (SELECT 
        t_record_inspect.id,
            product_date,
            product_name,
            code,
            SUM(IFNULL(t_record_inspect_error.ng_quantity, 0)) AS ng_quantity
    FROM
        t_record_inspect
    LEFT JOIN t_record_inspect_error ON t_record_inspect.id = t_record_inspect_error.record_inspect_id
    LEFT JOIN m_product ON m_product.id = t_record_inspect.product_id
    LEFT JOIN m_anod_error ON m_anod_error.id = t_record_inspect_error.inspect_error_id
    where code ='A4'
    GROUP BY t_record_inspect.id) tt
GROUP BY tt.product_date)ttt ";

$sql5 = " UNION SELECT 
    product_name, 
    'A5' AS 不良,
";

foreach ($period as $dt) {
    $di = $dt->format("Y-m-d");
    $din = $dt->format("Ymd");
    $sql5 = $sql5 ." MAX(CASE WHEN ttt.product_date = '" . $di . "' THEN ttt.ngq ELSE 0 END) AS '_" . $din ."',";
}
$sql5 = substr(trim($sql5), 0, -1);
$sql5 = $sql5." FROM
(SELECT 
    '合計' AS product_name,
    product_date,
    code,
    SUM(ng_quantity) AS ngq
FROM
    (SELECT 
        t_record_inspect.id,
            product_date,
            product_name,
            code,
            SUM(IFNULL(t_record_inspect_error.ng_quantity, 0)) AS ng_quantity
    FROM
        t_record_inspect
    LEFT JOIN t_record_inspect_error ON t_record_inspect.id = t_record_inspect_error.record_inspect_id
    LEFT JOIN m_product ON m_product.id = t_record_inspect.product_id
    LEFT JOIN m_anod_error ON m_anod_error.id = t_record_inspect_error.inspect_error_id
    where code ='A5'
    GROUP BY t_record_inspect.id) tt
GROUP BY tt.product_date)ttt ";

$sql6 = " UNION SELECT 
    product_name, 
    'A6' AS 不良,
";

foreach ($period as $dt) {
    $di = $dt->format("Y-m-d");
    $din = $dt->format("Ymd");
    $sql6 = $sql6 ." MAX(CASE WHEN ttt.product_date = '" . $di . "' THEN ttt.ngq ELSE 0 END) AS '_" . $din ."',";
}
$sql6 = substr(trim($sql6), 0, -1);
$sql6 = $sql6." FROM
(SELECT 
    '合計' AS product_name,
    product_date,
    code,
    SUM(ng_quantity) AS ngq
FROM
    (SELECT 
        t_record_inspect.id,
            product_date,
            product_name,
            code,
            SUM(IFNULL(t_record_inspect_error.ng_quantity, 0)) AS ng_quantity
    FROM
        t_record_inspect
    LEFT JOIN t_record_inspect_error ON t_record_inspect.id = t_record_inspect_error.record_inspect_id
    LEFT JOIN m_product ON m_product.id = t_record_inspect.product_id
    LEFT JOIN m_anod_error ON m_anod_error.id = t_record_inspect_error.inspect_error_id
    where code ='A6'
    GROUP BY t_record_inspect.id) tt
GROUP BY tt.product_date)ttt ";

$sql7 = " UNION SELECT 
    product_name, 
    'A7' AS 不良,
";

foreach ($period as $dt) {
    $di = $dt->format("Y-m-d");
    $din = $dt->format("Ymd");
    $sql7 = $sql7 ." MAX(CASE WHEN ttt.product_date = '" . $di . "' THEN ttt.ngq ELSE 0 END) AS '_" . $din ."',";
}
$sql7 = substr(trim($sql7), 0, -1);
$sql7 = $sql7." FROM
(SELECT 
    '合計' AS product_name,
    product_date,
    code,
    SUM(ng_quantity) AS ngq
FROM
    (SELECT 
        t_record_inspect.id,
            product_date,
            product_name,
            code,
            SUM(IFNULL(t_record_inspect_error.ng_quantity, 0)) AS ng_quantity
    FROM
        t_record_inspect
    LEFT JOIN t_record_inspect_error ON t_record_inspect.id = t_record_inspect_error.record_inspect_id
    LEFT JOIN m_product ON m_product.id = t_record_inspect.product_id
    LEFT JOIN m_anod_error ON m_anod_error.id = t_record_inspect_error.inspect_error_id
    where code ='A7'
    GROUP BY t_record_inspect.id) tt
GROUP BY tt.product_date)ttt ";

$sql8 = " UNION SELECT 
    product_name, 
    'A8' AS 不良,
";

foreach ($period as $dt) {
    $di = $dt->format("Y-m-d");
    $din = $dt->format("Ymd");
    $sql8 = $sql8 ." MAX(CASE WHEN ttt.product_date = '" . $di . "' THEN ttt.ngq ELSE 0 END) AS '_" . $din ."',";
}
$sql8 = substr(trim($sql8), 0, -1);
$sql8 = $sql8." FROM
(SELECT 
    '合計' AS product_name,
    product_date,
    code,
    SUM(ng_quantity) AS ngq
FROM
    (SELECT 
        t_record_inspect.id,
            product_date,
            product_name,
            code,
            SUM(IFNULL(t_record_inspect_error.ng_quantity, 0)) AS ng_quantity
    FROM
        t_record_inspect
    LEFT JOIN t_record_inspect_error ON t_record_inspect.id = t_record_inspect_error.record_inspect_id
    LEFT JOIN m_product ON m_product.id = t_record_inspect.product_id
    LEFT JOIN m_anod_error ON m_anod_error.id = t_record_inspect_error.inspect_error_id
    where code ='A8'
    GROUP BY t_record_inspect.id) tt
GROUP BY tt.product_date)ttt ";

$sql9 = " UNION SELECT 
    '合計' AS product_name,
    'A9' AS 不良,
";

foreach ($period as $dt) {
    $di = $dt->format("Y-m-d");
    $din = $dt->format("Ymd");
    $sql9 = $sql9 ." MAX(CASE WHEN ttt.product_date = '" . $di . "' THEN ttt.ngq ELSE 0 END) AS '_" . $din ."',";
}
$sql9 = substr(trim($sql9), 0, -1);
$sql9 = $sql9." FROM
(SELECT 
    '合計' AS product_name,
    product_date,
    code,
    SUM(ng_quantity) AS ngq
FROM
    (SELECT 
        t_record_inspect.id,
            product_date,
            product_name,
            code,
            SUM(IFNULL(t_record_inspect_error.ng_quantity, 0)) AS ng_quantity
    FROM
        t_record_inspect
    LEFT JOIN t_record_inspect_error ON t_record_inspect.id = t_record_inspect_error.record_inspect_id
    LEFT JOIN m_product ON m_product.id = t_record_inspect.product_id
    LEFT JOIN m_anod_error ON m_anod_error.id = t_record_inspect_error.inspect_error_id
    where code ='A9'
    GROUP BY t_record_inspect.id) tt
GROUP BY tt.product_date)ttt ";

$sql11 = " UNION SELECT 
    product_name, 
    'A1' AS 不良,
";

foreach ($period as $dt) {
    $di = $dt->format("Y-m-d");
    $din = $dt->format("Ymd");
    $sql11 = $sql11 ." MAX(CASE WHEN ttt.product_date = '" . $di . "' THEN ttt.ngq ELSE 0 END) AS '_" . $din ."',";
}
$sql11 = substr(trim($sql11), 0, -1);
$sql11 = $sql11." FROM
        (SELECT 
            tt.ttid AS tttid,
                tt.product_date AS product_date,
                tt.product_name AS product_name,
                tt.code AS code,
                SUM(tt.ngq) AS ngq
        FROM
            (SELECT 
            t_record_inspect.id AS ttid,
                product_date,
                product_name,
                code,
                SUM(IFNULL(t_record_inspect_error.ng_quantity, 0)) AS ngq
        FROM
            t_record_inspect
        LEFT JOIN t_record_inspect_error ON t_record_inspect.id = t_record_inspect_error.record_inspect_id
        LEFT JOIN m_product ON m_product.id = t_record_inspect.product_id
        LEFT JOIN m_anod_error ON m_anod_error.id = t_record_inspect_error.inspect_error_id
        WHERE
            code = 'A1'
        GROUP BY t_record_inspect.id) tt
        GROUP BY tt.product_name , tt.product_date) ttt
        GROUP BY ttt.product_name ";


$sql22 = " UNION SELECT 
product_name, 
'A2' AS 不良,
";

foreach ($period as $dt) {
    $di = $dt->format("Y-m-d");
    $din = $dt->format("Ymd");
    $sql22 = $sql22 ." MAX(CASE WHEN ttt.product_date = '" . $di . "' THEN ttt.ngq ELSE 0 END) AS '_" . $din ."',";
}
$sql22 = substr(trim($sql22), 0, -1);
$sql22 = $sql22." FROM
        (SELECT 
            tt.ttid AS tttid,
                tt.product_date AS product_date,
                tt.product_name AS product_name,
                tt.code AS code,
                SUM(tt.ngq) AS ngq
        FROM
            (SELECT 
            t_record_inspect.id AS ttid,
                product_date,
                product_name,
                code,
                SUM(IFNULL(t_record_inspect_error.ng_quantity, 0)) AS ngq
        FROM
            t_record_inspect
        LEFT JOIN t_record_inspect_error ON t_record_inspect.id = t_record_inspect_error.record_inspect_id
        LEFT JOIN m_product ON m_product.id = t_record_inspect.product_id
        LEFT JOIN m_anod_error ON m_anod_error.id = t_record_inspect_error.inspect_error_id
        WHERE
            code = 'A2'
        GROUP BY t_record_inspect.id) tt
        GROUP BY tt.product_name , tt.product_date) ttt
        GROUP BY ttt.product_name ";

$sql33 = " UNION SELECT 
product_name, 
'A3' AS 不良,
";

foreach ($period as $dt) {
    $di = $dt->format("Y-m-d");
    $din = $dt->format("Ymd");
    $sql33 = $sql33 ." MAX(CASE WHEN ttt.product_date = '" . $di . "' THEN ttt.ngq ELSE 0 END) AS '_" . $din ."',";
}
$sql33 = substr(trim($sql33), 0, -1);
$sql33 = $sql33." FROM
(SELECT 
    tt.ttid AS tttid,
        tt.product_date AS product_date,
        tt.product_name AS product_name,
        tt.code AS code,
        SUM(tt.ngq) AS ngq
FROM
    (SELECT 
    t_record_inspect.id AS ttid,
        product_date,
        product_name,
        code,
        SUM(IFNULL(t_record_inspect_error.ng_quantity, 0)) AS ngq
FROM
    t_record_inspect
LEFT JOIN t_record_inspect_error ON t_record_inspect.id = t_record_inspect_error.record_inspect_id
LEFT JOIN m_product ON m_product.id = t_record_inspect.product_id
LEFT JOIN m_anod_error ON m_anod_error.id = t_record_inspect_error.inspect_error_id
WHERE
    code = 'A3'
GROUP BY t_record_inspect.id) tt
GROUP BY tt.product_name , tt.product_date) ttt
GROUP BY ttt.product_name ";

$sql44 = " UNION SELECT 
product_name, 
'A4' AS 不良,
";

foreach ($period as $dt) {
    $di = $dt->format("Y-m-d");
    $din = $dt->format("Ymd");
    $sql44 = $sql44 ." MAX(CASE WHEN ttt.product_date = '" . $di . "' THEN ttt.ngq ELSE 0 END) AS '_" . $din ."',";
}
$sql44 = substr(trim($sql44), 0, -1);
$sql44 = $sql44." FROM
(SELECT 
    tt.ttid AS tttid,
        tt.product_date AS product_date,
        tt.product_name AS product_name,
        tt.code AS code,
        SUM(tt.ngq) AS ngq
FROM
    (SELECT 
    t_record_inspect.id AS ttid,
        product_date,
        product_name,
        code,
        SUM(IFNULL(t_record_inspect_error.ng_quantity, 0)) AS ngq
FROM
    t_record_inspect
LEFT JOIN t_record_inspect_error ON t_record_inspect.id = t_record_inspect_error.record_inspect_id
LEFT JOIN m_product ON m_product.id = t_record_inspect.product_id
LEFT JOIN m_anod_error ON m_anod_error.id = t_record_inspect_error.inspect_error_id
WHERE
    code = 'A4'
GROUP BY t_record_inspect.id) tt
GROUP BY tt.product_name , tt.product_date) ttt
GROUP BY ttt.product_name ";

$sql55 = " UNION SELECT 
product_name, 
'A5' AS 不良,
";

foreach ($period as $dt) {
    $di = $dt->format("Y-m-d");
    $din = $dt->format("Ymd");
    $sql55 = $sql55 ." MAX(CASE WHEN ttt.product_date = '" . $di . "' THEN ttt.ngq ELSE 0 END) AS '_" . $din ."',";
}
$sql55 = substr(trim($sql55), 0, -1);
$sql55 = $sql55." FROM
(SELECT 
    tt.ttid AS tttid,
        tt.product_date AS product_date,
        tt.product_name AS product_name,
        tt.code AS code,
        SUM(tt.ngq) AS ngq
FROM
    (SELECT 
    t_record_inspect.id AS ttid,
        product_date,
        product_name,
        code,
        SUM(IFNULL(t_record_inspect_error.ng_quantity, 0)) AS ngq
FROM
    t_record_inspect
LEFT JOIN t_record_inspect_error ON t_record_inspect.id = t_record_inspect_error.record_inspect_id
LEFT JOIN m_product ON m_product.id = t_record_inspect.product_id
LEFT JOIN m_anod_error ON m_anod_error.id = t_record_inspect_error.inspect_error_id
WHERE
    code = 'A5'
GROUP BY t_record_inspect.id) tt
GROUP BY tt.product_name , tt.product_date) ttt
GROUP BY ttt.product_name ";

$sql66 = " UNION SELECT 
product_name, 
'A6' AS 不良,
";

foreach ($period as $dt) {
    $di = $dt->format("Y-m-d");
    $din = $dt->format("Ymd");
    $sql66 = $sql66 ." MAX(CASE WHEN ttt.product_date = '" . $di . "' THEN ttt.ngq ELSE 0 END) AS '_" . $din ."',";
}
$sql66 = substr(trim($sql66), 0, -1);
$sql66 = $sql66." FROM
(SELECT 
    tt.ttid AS tttid,
        tt.product_date AS product_date,
        tt.product_name AS product_name,
        tt.code AS code,
        SUM(tt.ngq) AS ngq
FROM
    (SELECT 
    t_record_inspect.id AS ttid,
        product_date,
        product_name,
        code,
        SUM(IFNULL(t_record_inspect_error.ng_quantity, 0)) AS ngq
FROM
    t_record_inspect
LEFT JOIN t_record_inspect_error ON t_record_inspect.id = t_record_inspect_error.record_inspect_id
LEFT JOIN m_product ON m_product.id = t_record_inspect.product_id
LEFT JOIN m_anod_error ON m_anod_error.id = t_record_inspect_error.inspect_error_id
WHERE
    code = 'A6'
GROUP BY t_record_inspect.id) tt
GROUP BY tt.product_name , tt.product_date) ttt
GROUP BY ttt.product_name ";

$sql77 = " UNION SELECT 
product_name, 
'A7' AS 不良,
";

foreach ($period as $dt) {
    $di = $dt->format("Y-m-d");
    $din = $dt->format("Ymd");
    $sql77 = $sql77 ." MAX(CASE WHEN ttt.product_date = '" . $di . "' THEN ttt.ngq ELSE 0 END) AS '_" . $din ."',";
}
$sql77 = substr(trim($sql77), 0, -1);
$sql77 = $sql77." FROM
(SELECT 
    tt.ttid AS tttid,
        tt.product_date AS product_date,
        tt.product_name AS product_name,
        tt.code AS code,
        SUM(tt.ngq) AS ngq
FROM
    (SELECT 
    t_record_inspect.id AS ttid,
        product_date,
        product_name,
        code,
        SUM(IFNULL(t_record_inspect_error.ng_quantity, 0)) AS ngq
FROM
    t_record_inspect
LEFT JOIN t_record_inspect_error ON t_record_inspect.id = t_record_inspect_error.record_inspect_id
LEFT JOIN m_product ON m_product.id = t_record_inspect.product_id
LEFT JOIN m_anod_error ON m_anod_error.id = t_record_inspect_error.inspect_error_id
WHERE
    code = 'A7'
GROUP BY t_record_inspect.id) tt
GROUP BY tt.product_name , tt.product_date) ttt
GROUP BY ttt.product_name ";

$sql88 = " UNION SELECT 
product_name, 
'A8' AS 不良,
";

foreach ($period as $dt) {
    $di = $dt->format("Y-m-d");
    $din = $dt->format("Ymd");
    $sql88 = $sql88 ." MAX(CASE WHEN ttt.product_date = '" . $di . "' THEN ttt.ngq ELSE 0 END) AS '_" . $din ."',";
}
$sql88 = substr(trim($sql88), 0, -1);
$sql88 = $sql88." FROM
(SELECT 
    tt.ttid AS tttid,
        tt.product_date AS product_date,
        tt.product_name AS product_name,
        tt.code AS code,
        SUM(tt.ngq) AS ngq
FROM
    (SELECT 
    t_record_inspect.id AS ttid,
        product_date,
        product_name,
        code,
        SUM(IFNULL(t_record_inspect_error.ng_quantity, 0)) AS ngq
FROM
    t_record_inspect
LEFT JOIN t_record_inspect_error ON t_record_inspect.id = t_record_inspect_error.record_inspect_id
LEFT JOIN m_product ON m_product.id = t_record_inspect.product_id
LEFT JOIN m_anod_error ON m_anod_error.id = t_record_inspect_error.inspect_error_id
WHERE
    code = 'A8'
GROUP BY t_record_inspect.id) tt
GROUP BY tt.product_name , tt.product_date) ttt
GROUP BY ttt.product_name ";

$sql99 = " UNION SELECT 
product_name, 
'A9' AS 不良,
";

foreach ($period as $dt) {
    $di = $dt->format("Y-m-d");
    $din = $dt->format("Ymd");
    $sql99 = $sql99 ." MAX(CASE WHEN ttt.product_date = '" . $di . "' THEN ttt.ngq ELSE 0 END) AS '_" . $din ."',";
}
$sql99 = substr(trim($sql99), 0, -1);
$sql99 = $sql99." FROM
(SELECT 
    tt.ttid AS tttid,
        tt.product_date AS product_date,
        tt.product_name AS product_name,
        tt.code AS code,
        SUM(tt.ngq) AS ngq
FROM
    (SELECT 
    t_record_inspect.id AS ttid,
        product_date,
        product_name,
        code,
        SUM(IFNULL(t_record_inspect_error.ng_quantity, 0)) AS ngq
FROM
    t_record_inspect
LEFT JOIN t_record_inspect_error ON t_record_inspect.id = t_record_inspect_error.record_inspect_id
LEFT JOIN m_product ON m_product.id = t_record_inspect.product_id
LEFT JOIN m_anod_error ON m_anod_error.id = t_record_inspect_error.inspect_error_id
WHERE
    code = 'A9'
GROUP BY t_record_inspect.id) tt
GROUP BY tt.product_name , tt.product_date) ttt
GROUP BY ttt.product_name ";





$sql = "SELECT * FROM (".$sql1.$sql2.$sql3.$sql4.$sql5.$sql6.$sql7.$sql8.$sql9.$sql11.$sql22.$sql33.$sql44.$sql55.$sql66.$sql77.$sql88.$sql99.") tttttt 
    ORDER BY 
    tttttt.product_name DESC,
    tttttt.不良 ASC ";

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