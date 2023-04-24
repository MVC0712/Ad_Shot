SELECT 
    '合計' AS product_name,
    '' AS a,
    '' AS b,
    '' AS c,
    '計画' AS d,
    MAX(CASE WHEN t_shot_plan.product_date = '2023-04-01' THEN t103.ttq ELSE '' END) AS '_20230401',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-02' THEN t103.ttq
        ELSE ''
    END) AS '_20230402',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-03' THEN t103.ttq
        ELSE ''
    END) AS '_20230403',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-04' THEN t103.ttq
        ELSE ''
    END) AS '_20230404',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-05' THEN t103.ttq
        ELSE ''
    END) AS '_20230405',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-06' THEN t103.ttq
        ELSE ''
    END) AS '_20230406',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-07' THEN t103.ttq
        ELSE ''
    END) AS '_20230407',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-08' THEN t103.ttq
        ELSE ''
    END) AS '_20230408',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-09' THEN t103.ttq
        ELSE ''
    END) AS '_20230409',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-10' THEN t103.ttq
        ELSE ''
    END) AS '_20230410',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-11' THEN t103.ttq
        ELSE ''
    END) AS '_20230411',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-12' THEN t103.ttq
        ELSE ''
    END) AS '_20230412',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-13' THEN t103.ttq
        ELSE ''
    END) AS '_20230413',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-14' THEN t103.ttq
        ELSE ''
    END) AS '_20230414',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-15' THEN t103.ttq
        ELSE ''
    END) AS '_20230415',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-16' THEN t103.ttq
        ELSE ''
    END) AS '_20230416',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-17' THEN t103.ttq
        ELSE ''
    END) AS '_20230417',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-18' THEN t103.ttq
        ELSE ''
    END) AS '_20230418',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-19' THEN t103.ttq
        ELSE ''
    END) AS '_20230419',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-20' THEN t103.ttq
        ELSE ''
    END) AS '_20230420',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-21' THEN t103.ttq
        ELSE ''
    END) AS '_20230421',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-22' THEN t103.ttq
        ELSE ''
    END) AS '_20230422',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-23' THEN t103.ttq
        ELSE ''
    END) AS '_20230423',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-24' THEN t103.ttq
        ELSE ''
    END) AS '_20230424',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-25' THEN t103.ttq
        ELSE ''
    END) AS '_20230425',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-26' THEN t103.ttq
        ELSE ''
    END) AS '_20230426',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-27' THEN t103.ttq
        ELSE ''
    END) AS '_20230427',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-28' THEN t103.ttq
        ELSE ''
    END) AS '_20230428',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-29' THEN t103.ttq
        ELSE ''
    END) AS '_20230429',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-30' THEN t103.ttq
        ELSE ''
    END) AS '_20230430'
FROM
    t_shot_plan
        LEFT JOIN
    m_product ON m_product.id = t_shot_plan.production_id
        LEFT JOIN
    (SELECT 
        '4' AS o,
            m_product.id AS iddd,
            product_date,
            m_product.product_name,
            SUM(quantity) AS ttq
    FROM
        t_shot_plan
    LEFT JOIN m_product ON m_product.id = t_shot_plan.production_id
    GROUP BY product_date) t103 ON t103.iddd = t_shot_plan.production_id
        AND t103.product_date = t_shot_plan.product_date

UNION SELECT 
    '合計' AS product_name,
    '' AS a,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407 + t1003._20230408 + t1003._20230409 + t1003._20230410 + t1003._20230411 + t1003._20230412 + t1003._20230413 + t1003._20230414 + t1003._20230415 + t1003._20230416 + t1003._20230417 + t1003._20230418 + t1003._20230419 + t1003._20230420 + t1003._20230421 + t1003._20230422 + t1003._20230423 + t1003._20230424 + t1003._20230425 + t1003._20230426 + t1003._20230427 + t1003._20230428 + t1003._20230429 + t1003._20230430) AS b,
    '' AS c,
    '累計計画' AS d,
    (t1003._20230401) AS _20230401,
    (t1003._20230401 + t1003._20230402) AS _20230402,
    (t1003._20230401 + t1003._20230402 + t1003._20230403) AS _20230403,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404) AS _20230404,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405) AS _20230405,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406) AS _20230406,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407) AS _20230407,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407 + t1003._20230408) AS _20230408,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407 + t1003._20230408 + t1003._20230409) AS _20230409,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407 + t1003._20230408 + t1003._20230409 + t1003._20230410) AS _20230410,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407 + t1003._20230408 + t1003._20230409 + t1003._20230410 + t1003._20230411) AS _20230411,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407 + t1003._20230408 + t1003._20230409 + t1003._20230410 + t1003._20230411 + t1003._20230412) AS _20230412,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407 + t1003._20230408 + t1003._20230409 + t1003._20230410 + t1003._20230411 + t1003._20230412 + t1003._20230413) AS _20230413,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407 + t1003._20230408 + t1003._20230409 + t1003._20230410 + t1003._20230411 + t1003._20230412 + t1003._20230413 + t1003._20230414) AS _20230414,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407 + t1003._20230408 + t1003._20230409 + t1003._20230410 + t1003._20230411 + t1003._20230412 + t1003._20230413 + t1003._20230414 + t1003._20230415) AS _20230415,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407 + t1003._20230408 + t1003._20230409 + t1003._20230410 + t1003._20230411 + t1003._20230412 + t1003._20230413 + t1003._20230414 + t1003._20230415 + t1003._20230416) AS _20230416,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407 + t1003._20230408 + t1003._20230409 + t1003._20230410 + t1003._20230411 + t1003._20230412 + t1003._20230413 + t1003._20230414 + t1003._20230415 + t1003._20230416 + t1003._20230417) AS _20230417,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407 + t1003._20230408 + t1003._20230409 + t1003._20230410 + t1003._20230411 + t1003._20230412 + t1003._20230413 + t1003._20230414 + t1003._20230415 + t1003._20230416 + t1003._20230417 + t1003._20230418) AS _20230418,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407 + t1003._20230408 + t1003._20230409 + t1003._20230410 + t1003._20230411 + t1003._20230412 + t1003._20230413 + t1003._20230414 + t1003._20230415 + t1003._20230416 + t1003._20230417 + t1003._20230418 + t1003._20230419) AS _20230419,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407 + t1003._20230408 + t1003._20230409 + t1003._20230410 + t1003._20230411 + t1003._20230412 + t1003._20230413 + t1003._20230414 + t1003._20230415 + t1003._20230416 + t1003._20230417 + t1003._20230418 + t1003._20230419 + t1003._20230420) AS _20230420,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407 + t1003._20230408 + t1003._20230409 + t1003._20230410 + t1003._20230411 + t1003._20230412 + t1003._20230413 + t1003._20230414 + t1003._20230415 + t1003._20230416 + t1003._20230417 + t1003._20230418 + t1003._20230419 + t1003._20230420 + t1003._20230421) AS _20230421,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407 + t1003._20230408 + t1003._20230409 + t1003._20230410 + t1003._20230411 + t1003._20230412 + t1003._20230413 + t1003._20230414 + t1003._20230415 + t1003._20230416 + t1003._20230417 + t1003._20230418 + t1003._20230419 + t1003._20230420 + t1003._20230421 + t1003._20230422) AS _20230422,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407 + t1003._20230408 + t1003._20230409 + t1003._20230410 + t1003._20230411 + t1003._20230412 + t1003._20230413 + t1003._20230414 + t1003._20230415 + t1003._20230416 + t1003._20230417 + t1003._20230418 + t1003._20230419 + t1003._20230420 + t1003._20230421 + t1003._20230422 + t1003._20230423) AS _20230423,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407 + t1003._20230408 + t1003._20230409 + t1003._20230410 + t1003._20230411 + t1003._20230412 + t1003._20230413 + t1003._20230414 + t1003._20230415 + t1003._20230416 + t1003._20230417 + t1003._20230418 + t1003._20230419 + t1003._20230420 + t1003._20230421 + t1003._20230422 + t1003._20230423 + t1003._20230424) AS _20230424,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407 + t1003._20230408 + t1003._20230409 + t1003._20230410 + t1003._20230411 + t1003._20230412 + t1003._20230413 + t1003._20230414 + t1003._20230415 + t1003._20230416 + t1003._20230417 + t1003._20230418 + t1003._20230419 + t1003._20230420 + t1003._20230421 + t1003._20230422 + t1003._20230423 + t1003._20230424 + t1003._20230425) AS _20230425,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407 + t1003._20230408 + t1003._20230409 + t1003._20230410 + t1003._20230411 + t1003._20230412 + t1003._20230413 + t1003._20230414 + t1003._20230415 + t1003._20230416 + t1003._20230417 + t1003._20230418 + t1003._20230419 + t1003._20230420 + t1003._20230421 + t1003._20230422 + t1003._20230423 + t1003._20230424 + t1003._20230425 + t1003._20230426) AS _20230426,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407 + t1003._20230408 + t1003._20230409 + t1003._20230410 + t1003._20230411 + t1003._20230412 + t1003._20230413 + t1003._20230414 + t1003._20230415 + t1003._20230416 + t1003._20230417 + t1003._20230418 + t1003._20230419 + t1003._20230420 + t1003._20230421 + t1003._20230422 + t1003._20230423 + t1003._20230424 + t1003._20230425 + t1003._20230426 + t1003._20230427) AS _20230427,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407 + t1003._20230408 + t1003._20230409 + t1003._20230410 + t1003._20230411 + t1003._20230412 + t1003._20230413 + t1003._20230414 + t1003._20230415 + t1003._20230416 + t1003._20230417 + t1003._20230418 + t1003._20230419 + t1003._20230420 + t1003._20230421 + t1003._20230422 + t1003._20230423 + t1003._20230424 + t1003._20230425 + t1003._20230426 + t1003._20230427 + t1003._20230428) AS _20230428,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407 + t1003._20230408 + t1003._20230409 + t1003._20230410 + t1003._20230411 + t1003._20230412 + t1003._20230413 + t1003._20230414 + t1003._20230415 + t1003._20230416 + t1003._20230417 + t1003._20230418 + t1003._20230419 + t1003._20230420 + t1003._20230421 + t1003._20230422 + t1003._20230423 + t1003._20230424 + t1003._20230425 + t1003._20230426 + t1003._20230427 + t1003._20230428 + t1003._20230429) AS _20230429,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407 + t1003._20230408 + t1003._20230409 + t1003._20230410 + t1003._20230411 + t1003._20230412 + t1003._20230413 + t1003._20230414 + t1003._20230415 + t1003._20230416 + t1003._20230417 + t1003._20230418 + t1003._20230419 + t1003._20230420 + t1003._20230421 + t1003._20230422 + t1003._20230423 + t1003._20230424 + t1003._20230425 + t1003._20230426 + t1003._20230427 + t1003._20230428 + t1003._20230429 + t1003._20230430) AS _20230430
FROM
    (SELECT 
            m_product.id AS idd,
            m_product.product_name,
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-01' THEN t103.ttq
                ELSE ''
            END) AS '_20230401',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-02' THEN t103.ttq
                ELSE ''
            END) AS '_20230402',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-03' THEN t103.ttq
                ELSE ''
            END) AS '_20230403',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-04' THEN t103.ttq
                ELSE ''
            END) AS '_20230404',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-05' THEN t103.ttq
                ELSE ''
            END) AS '_20230405',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-06' THEN t103.ttq
                ELSE ''
            END) AS '_20230406',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-07' THEN t103.ttq
                ELSE ''
            END) AS '_20230407',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-08' THEN t103.ttq
                ELSE ''
            END) AS '_20230408',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-09' THEN t103.ttq
                ELSE ''
            END) AS '_20230409',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-10' THEN t103.ttq
                ELSE ''
            END) AS '_20230410',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-11' THEN t103.ttq
                ELSE ''
            END) AS '_20230411',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-12' THEN t103.ttq
                ELSE ''
            END) AS '_20230412',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-13' THEN t103.ttq
                ELSE ''
            END) AS '_20230413',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-14' THEN t103.ttq
                ELSE ''
            END) AS '_20230414',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-15' THEN t103.ttq
                ELSE ''
            END) AS '_20230415',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-16' THEN t103.ttq
                ELSE ''
            END) AS '_20230416',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-17' THEN t103.ttq
                ELSE ''
            END) AS '_20230417',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-18' THEN t103.ttq
                ELSE ''
            END) AS '_20230418',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-19' THEN t103.ttq
                ELSE ''
            END) AS '_20230419',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-20' THEN t103.ttq
                ELSE ''
            END) AS '_20230420',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-21' THEN t103.ttq
                ELSE ''
            END) AS '_20230421',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-22' THEN t103.ttq
                ELSE ''
            END) AS '_20230422',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-23' THEN t103.ttq
                ELSE ''
            END) AS '_20230423',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-24' THEN t103.ttq
                ELSE ''
            END) AS '_20230424',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-25' THEN t103.ttq
                ELSE ''
            END) AS '_20230425',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-26' THEN t103.ttq
                ELSE ''
            END) AS '_20230426',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-27' THEN t103.ttq
                ELSE ''
            END) AS '_20230427',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-28' THEN t103.ttq
                ELSE ''
            END) AS '_20230428',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-29' THEN t103.ttq
                ELSE ''
            END) AS '_20230429',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-30' THEN t103.ttq
                ELSE ''
            END) AS '_20230430'
    FROM
        t_shot_plan
    LEFT JOIN m_product ON m_product.id = t_shot_plan.production_id
    LEFT JOIN (SELECT 
            m_product.id AS iddd,
            product_date,
            m_product.product_name,
            SUM(quantity) AS ttq
    FROM
        t_shot_plan
    LEFT JOIN m_product ON m_product.id = t_shot_plan.production_id
    GROUP BY product_date) t103 ON t103.iddd = t_shot_plan.production_id
        AND t103.product_date = t_shot_plan.product_date) t1003

UNION SELECT 
    '合計' AS product_name,
    '' AS a,
    '' AS b,
    '' AS c,
    '実績' AS d,
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-01' THEN t104.ttqq
        ELSE ''
    END) AS '_20230401',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-02' THEN t104.ttqq
        ELSE ''
    END) AS '_20230402',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-03' THEN t104.ttqq
        ELSE ''
    END) AS '_20230403',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-04' THEN t104.ttqq
        ELSE ''
    END) AS '_20230404',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-05' THEN t104.ttqq
        ELSE ''
    END) AS '_20230405',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-06' THEN t104.ttqq
        ELSE ''
    END) AS '_20230406',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-07' THEN t104.ttqq
        ELSE ''
    END) AS '_20230407',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-08' THEN t104.ttqq
        ELSE ''
    END) AS '_20230408',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-09' THEN t104.ttqq
        ELSE ''
    END) AS '_20230409',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-10' THEN t104.ttqq
        ELSE ''
    END) AS '_20230410',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-11' THEN t104.ttqq
        ELSE ''
    END) AS '_20230411',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-12' THEN t104.ttqq
        ELSE ''
    END) AS '_20230412',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-13' THEN t104.ttqq
        ELSE ''
    END) AS '_20230413',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-14' THEN t104.ttqq
        ELSE ''
    END) AS '_20230414',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-15' THEN t104.ttqq
        ELSE ''
    END) AS '_20230415',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-16' THEN t104.ttqq
        ELSE ''
    END) AS '_20230416',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-17' THEN t104.ttqq
        ELSE ''
    END) AS '_20230417',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-18' THEN t104.ttqq
        ELSE ''
    END) AS '_20230418',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-19' THEN t104.ttqq
        ELSE ''
    END) AS '_20230419',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-20' THEN t104.ttqq
        ELSE ''
    END) AS '_20230420',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-21' THEN t104.ttqq
        ELSE ''
    END) AS '_20230421',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-22' THEN t104.ttqq
        ELSE ''
    END) AS '_20230422',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-23' THEN t104.ttqq
        ELSE ''
    END) AS '_20230423',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-24' THEN t104.ttqq
        ELSE ''
    END) AS '_20230424',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-25' THEN t104.ttqq
        ELSE ''
    END) AS '_20230425',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-26' THEN t104.ttqq
        ELSE ''
    END) AS '_20230426',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-27' THEN t104.ttqq
        ELSE ''
    END) AS '_20230427',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-28' THEN t104.ttqq
        ELSE ''
    END) AS '_20230428',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-29' THEN t104.ttqq
        ELSE ''
    END) AS '_20230429',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-30' THEN t104.ttqq
        ELSE ''
    END) AS '_20230430'
FROM
    t_record_shot
        LEFT JOIN
    m_product ON m_product.id = t_record_shot.product_id
        LEFT JOIN
    (SELECT 
        '3' AS o,
            m_product.id AS idddd,
            product_date,
            m_product.product_name,
            SUM(input_quantity) - SUM(ng_quantity) AS ttqq
    FROM
        t_record_shot
    LEFT JOIN m_product ON m_product.id = t_record_shot.product_id
    GROUP BY product_date) t104 ON t104.idddd = t_record_shot.product_id
        AND t104.product_date = t_record_shot.product_date

UNION SELECT 
    '合計' AS product_name,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407 + t1004._20230408 + t1004._20230409 + t1004._20230410 + t1004._20230411 + t1004._20230412 + t1004._20230413 + t1004._20230414 + t1004._20230415 + t1004._20230416 + t1004._20230417 + t1004._20230418 + t1004._20230419 + t1004._20230420 + t1004._20230421 + t1004._20230422 + t1004._20230423 + t1004._20230424 + t1004._20230425 + t1004._20230426 + t1004._20230427 + t1004._20230428 + t1004._20230429 + t1004._20230430) AS a,
    '' AS b,
    '' AS c,
    '累計実績' AS d,
    (t1004._20230401) AS _20230401,
    (t1004._20230401 + t1004._20230402) AS _20230402,
    (t1004._20230401 + t1004._20230402 + t1004._20230403) AS _20230403,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404) AS _20230404,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405) AS _20230405,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406) AS _20230406,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407) AS _20230407,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407 + t1004._20230408) AS _20230408,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407 + t1004._20230408 + t1004._20230409) AS _20230409,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407 + t1004._20230408 + t1004._20230409 + t1004._20230410) AS _20230410,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407 + t1004._20230408 + t1004._20230409 + t1004._20230410 + t1004._20230411) AS _20230411,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407 + t1004._20230408 + t1004._20230409 + t1004._20230410 + t1004._20230411 + t1004._20230412) AS _20230412,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407 + t1004._20230408 + t1004._20230409 + t1004._20230410 + t1004._20230411 + t1004._20230412 + t1004._20230413) AS _20230413,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407 + t1004._20230408 + t1004._20230409 + t1004._20230410 + t1004._20230411 + t1004._20230412 + t1004._20230413 + t1004._20230414) AS _20230414,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407 + t1004._20230408 + t1004._20230409 + t1004._20230410 + t1004._20230411 + t1004._20230412 + t1004._20230413 + t1004._20230414 + t1004._20230415) AS _20230415,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407 + t1004._20230408 + t1004._20230409 + t1004._20230410 + t1004._20230411 + t1004._20230412 + t1004._20230413 + t1004._20230414 + t1004._20230415 + t1004._20230416) AS _20230416,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407 + t1004._20230408 + t1004._20230409 + t1004._20230410 + t1004._20230411 + t1004._20230412 + t1004._20230413 + t1004._20230414 + t1004._20230415 + t1004._20230416 + t1004._20230417) AS _20230417,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407 + t1004._20230408 + t1004._20230409 + t1004._20230410 + t1004._20230411 + t1004._20230412 + t1004._20230413 + t1004._20230414 + t1004._20230415 + t1004._20230416 + t1004._20230417 + t1004._20230418) AS _20230418,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407 + t1004._20230408 + t1004._20230409 + t1004._20230410 + t1004._20230411 + t1004._20230412 + t1004._20230413 + t1004._20230414 + t1004._20230415 + t1004._20230416 + t1004._20230417 + t1004._20230418 + t1004._20230419) AS _20230419,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407 + t1004._20230408 + t1004._20230409 + t1004._20230410 + t1004._20230411 + t1004._20230412 + t1004._20230413 + t1004._20230414 + t1004._20230415 + t1004._20230416 + t1004._20230417 + t1004._20230418 + t1004._20230419 + t1004._20230420) AS _20230420,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407 + t1004._20230408 + t1004._20230409 + t1004._20230410 + t1004._20230411 + t1004._20230412 + t1004._20230413 + t1004._20230414 + t1004._20230415 + t1004._20230416 + t1004._20230417 + t1004._20230418 + t1004._20230419 + t1004._20230420 + t1004._20230421) AS _20230421,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407 + t1004._20230408 + t1004._20230409 + t1004._20230410 + t1004._20230411 + t1004._20230412 + t1004._20230413 + t1004._20230414 + t1004._20230415 + t1004._20230416 + t1004._20230417 + t1004._20230418 + t1004._20230419 + t1004._20230420 + t1004._20230421 + t1004._20230422) AS _20230422,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407 + t1004._20230408 + t1004._20230409 + t1004._20230410 + t1004._20230411 + t1004._20230412 + t1004._20230413 + t1004._20230414 + t1004._20230415 + t1004._20230416 + t1004._20230417 + t1004._20230418 + t1004._20230419 + t1004._20230420 + t1004._20230421 + t1004._20230422 + t1004._20230423) AS _20230423,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407 + t1004._20230408 + t1004._20230409 + t1004._20230410 + t1004._20230411 + t1004._20230412 + t1004._20230413 + t1004._20230414 + t1004._20230415 + t1004._20230416 + t1004._20230417 + t1004._20230418 + t1004._20230419 + t1004._20230420 + t1004._20230421 + t1004._20230422 + t1004._20230423 + t1004._20230424) AS _20230424,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407 + t1004._20230408 + t1004._20230409 + t1004._20230410 + t1004._20230411 + t1004._20230412 + t1004._20230413 + t1004._20230414 + t1004._20230415 + t1004._20230416 + t1004._20230417 + t1004._20230418 + t1004._20230419 + t1004._20230420 + t1004._20230421 + t1004._20230422 + t1004._20230423 + t1004._20230424 + t1004._20230425) AS _20230425,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407 + t1004._20230408 + t1004._20230409 + t1004._20230410 + t1004._20230411 + t1004._20230412 + t1004._20230413 + t1004._20230414 + t1004._20230415 + t1004._20230416 + t1004._20230417 + t1004._20230418 + t1004._20230419 + t1004._20230420 + t1004._20230421 + t1004._20230422 + t1004._20230423 + t1004._20230424 + t1004._20230425 + t1004._20230426) AS _20230426,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407 + t1004._20230408 + t1004._20230409 + t1004._20230410 + t1004._20230411 + t1004._20230412 + t1004._20230413 + t1004._20230414 + t1004._20230415 + t1004._20230416 + t1004._20230417 + t1004._20230418 + t1004._20230419 + t1004._20230420 + t1004._20230421 + t1004._20230422 + t1004._20230423 + t1004._20230424 + t1004._20230425 + t1004._20230426 + t1004._20230427) AS _20230427,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407 + t1004._20230408 + t1004._20230409 + t1004._20230410 + t1004._20230411 + t1004._20230412 + t1004._20230413 + t1004._20230414 + t1004._20230415 + t1004._20230416 + t1004._20230417 + t1004._20230418 + t1004._20230419 + t1004._20230420 + t1004._20230421 + t1004._20230422 + t1004._20230423 + t1004._20230424 + t1004._20230425 + t1004._20230426 + t1004._20230427 + t1004._20230428) AS _20230428,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407 + t1004._20230408 + t1004._20230409 + t1004._20230410 + t1004._20230411 + t1004._20230412 + t1004._20230413 + t1004._20230414 + t1004._20230415 + t1004._20230416 + t1004._20230417 + t1004._20230418 + t1004._20230419 + t1004._20230420 + t1004._20230421 + t1004._20230422 + t1004._20230423 + t1004._20230424 + t1004._20230425 + t1004._20230426 + t1004._20230427 + t1004._20230428 + t1004._20230429) AS _20230429,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407 + t1004._20230408 + t1004._20230409 + t1004._20230410 + t1004._20230411 + t1004._20230412 + t1004._20230413 + t1004._20230414 + t1004._20230415 + t1004._20230416 + t1004._20230417 + t1004._20230418 + t1004._20230419 + t1004._20230420 + t1004._20230421 + t1004._20230422 + t1004._20230423 + t1004._20230424 + t1004._20230425 + t1004._20230426 + t1004._20230427 + t1004._20230428 + t1004._20230429 + t1004._20230430) AS _20230430
FROM
    (SELECT 
            m_product.id AS idd,
            m_product.product_name,
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-01' THEN t104.ttqq
                ELSE ''
            END) AS '_20230401',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-02' THEN t104.ttqq
                ELSE ''
            END) AS '_20230402',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-03' THEN t104.ttqq
                ELSE ''
            END) AS '_20230403',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-04' THEN t104.ttqq
                ELSE ''
            END) AS '_20230404',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-05' THEN t104.ttqq
                ELSE ''
            END) AS '_20230405',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-06' THEN t104.ttqq
                ELSE ''
            END) AS '_20230406',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-07' THEN t104.ttqq
                ELSE ''
            END) AS '_20230407',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-08' THEN t104.ttqq
                ELSE ''
            END) AS '_20230408',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-09' THEN t104.ttqq
                ELSE ''
            END) AS '_20230409',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-10' THEN t104.ttqq
                ELSE ''
            END) AS '_20230410',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-11' THEN t104.ttqq
                ELSE ''
            END) AS '_20230411',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-12' THEN t104.ttqq
                ELSE ''
            END) AS '_20230412',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-13' THEN t104.ttqq
                ELSE ''
            END) AS '_20230413',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-14' THEN t104.ttqq
                ELSE ''
            END) AS '_20230414',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-15' THEN t104.ttqq
                ELSE ''
            END) AS '_20230415',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-16' THEN t104.ttqq
                ELSE ''
            END) AS '_20230416',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-17' THEN t104.ttqq
                ELSE ''
            END) AS '_20230417',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-18' THEN t104.ttqq
                ELSE ''
            END) AS '_20230418',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-19' THEN t104.ttqq
                ELSE ''
            END) AS '_20230419',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-20' THEN t104.ttqq
                ELSE ''
            END) AS '_20230420',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-21' THEN t104.ttqq
                ELSE ''
            END) AS '_20230421',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-22' THEN t104.ttqq
                ELSE ''
            END) AS '_20230422',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-23' THEN t104.ttqq
                ELSE ''
            END) AS '_20230423',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-24' THEN t104.ttqq
                ELSE ''
            END) AS '_20230424',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-25' THEN t104.ttqq
                ELSE ''
            END) AS '_20230425',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-26' THEN t104.ttqq
                ELSE ''
            END) AS '_20230426',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-27' THEN t104.ttqq
                ELSE ''
            END) AS '_20230427',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-28' THEN t104.ttqq
                ELSE ''
            END) AS '_20230428',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-29' THEN t104.ttqq
                ELSE ''
            END) AS '_20230429',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-30' THEN t104.ttqq
                ELSE ''
            END) AS '_20230430'
    FROM
        t_record_shot
    LEFT JOIN m_product ON m_product.id = t_record_shot.product_id
    LEFT JOIN (SELECT 
            m_product.id AS idddd,
            product_date,
            m_product.product_name,
            SUM(input_quantity) - SUM(ng_quantity) AS ttqq
    FROM
        t_record_shot
    LEFT JOIN m_product ON m_product.id = t_record_shot.product_id
    GROUP BY product_date) t104 ON t104.idddd = t_record_shot.product_id
        AND t104.product_date = t_record_shot.product_date) t1004

UNION SELECT 
   m_product.product_name AS product_name,
    '' AS a,
    '' AS b,
    '' AS c,
    '計画' AS d,
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-01' THEN t10.ttq
        ELSE ''
    END) AS '_20230401',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-02' THEN t10.ttq
        ELSE ''
    END) AS '_20230402',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-03' THEN t10.ttq
        ELSE ''
    END) AS '_20230403',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-04' THEN t10.ttq
        ELSE ''
    END) AS '_20230404',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-05' THEN t10.ttq
        ELSE ''
    END) AS '_20230405',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-06' THEN t10.ttq
        ELSE ''
    END) AS '_20230406',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-07' THEN t10.ttq
        ELSE ''
    END) AS '_20230407',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-08' THEN t10.ttq
        ELSE ''
    END) AS '_20230408',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-09' THEN t10.ttq
        ELSE ''
    END) AS '_20230409',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-10' THEN t10.ttq
        ELSE ''
    END) AS '_20230410',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-11' THEN t10.ttq
        ELSE ''
    END) AS '_20230411',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-12' THEN t10.ttq
        ELSE ''
    END) AS '_20230412',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-13' THEN t10.ttq
        ELSE ''
    END) AS '_20230413',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-14' THEN t10.ttq
        ELSE ''
    END) AS '_20230414',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-15' THEN t10.ttq
        ELSE ''
    END) AS '_20230415',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-16' THEN t10.ttq
        ELSE ''
    END) AS '_20230416',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-17' THEN t10.ttq
        ELSE ''
    END) AS '_20230417',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-18' THEN t10.ttq
        ELSE ''
    END) AS '_20230418',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-19' THEN t10.ttq
        ELSE ''
    END) AS '_20230419',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-20' THEN t10.ttq
        ELSE ''
    END) AS '_20230420',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-21' THEN t10.ttq
        ELSE ''
    END) AS '_20230421',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-22' THEN t10.ttq
        ELSE ''
    END) AS '_20230422',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-23' THEN t10.ttq
        ELSE ''
    END) AS '_20230423',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-24' THEN t10.ttq
        ELSE ''
    END) AS '_20230424',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-25' THEN t10.ttq
        ELSE ''
    END) AS '_20230425',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-26' THEN t10.ttq
        ELSE ''
    END) AS '_20230426',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-27' THEN t10.ttq
        ELSE ''
    END) AS '_20230427',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-28' THEN t10.ttq
        ELSE ''
    END) AS '_20230428',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-29' THEN t10.ttq
        ELSE ''
    END) AS '_20230429',
    MAX(CASE
        WHEN t_shot_plan.product_date = '2023-04-30' THEN t10.ttq
        ELSE ''
    END) AS '_20230430'
FROM
    t_shot_plan
        LEFT JOIN
    m_product ON m_product.id = t_shot_plan.production_id
        LEFT JOIN
    (SELECT 
        m_product.id AS iddd,
            product_date,
            m_product.product_name,
            SUM(quantity) AS ttq
    FROM
        t_shot_plan
    LEFT JOIN m_product ON m_product.id = t_shot_plan.production_id
    GROUP BY product_date , iddd) t10 ON t10.iddd = t_shot_plan.production_id
        AND t10.product_date = t_shot_plan.product_date
GROUP BY product_name

UNION SELECT 
    t1003.product_name AS product_name,
    '' AS a,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407 + t1003._20230408 + t1003._20230409 + t1003._20230410 + t1003._20230411 + t1003._20230412 + t1003._20230413 + t1003._20230414 + t1003._20230415 + t1003._20230416 + t1003._20230417 + t1003._20230418 + t1003._20230419 + t1003._20230420 + t1003._20230421 + t1003._20230422 + t1003._20230423 + t1003._20230424 + t1003._20230425 + t1003._20230426 + t1003._20230427 + t1003._20230428 + t1003._20230429 + t1003._20230430) AS b,
    '' AS c,
    '累計計画' AS d,
    (t1003._20230401) AS _20230401,
    (t1003._20230401 + t1003._20230402) AS _20230402,
    (t1003._20230401 + t1003._20230402 + t1003._20230403) AS _20230403,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404) AS _20230404,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405) AS _20230405,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406) AS _20230406,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407) AS _20230407,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407 + t1003._20230408) AS _20230408,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407 + t1003._20230408 + t1003._20230409) AS _20230409,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407 + t1003._20230408 + t1003._20230409 + t1003._20230410) AS _20230410,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407 + t1003._20230408 + t1003._20230409 + t1003._20230410 + t1003._20230411) AS _20230411,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407 + t1003._20230408 + t1003._20230409 + t1003._20230410 + t1003._20230411 + t1003._20230412) AS _20230412,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407 + t1003._20230408 + t1003._20230409 + t1003._20230410 + t1003._20230411 + t1003._20230412 + t1003._20230413) AS _20230413,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407 + t1003._20230408 + t1003._20230409 + t1003._20230410 + t1003._20230411 + t1003._20230412 + t1003._20230413 + t1003._20230414) AS _20230414,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407 + t1003._20230408 + t1003._20230409 + t1003._20230410 + t1003._20230411 + t1003._20230412 + t1003._20230413 + t1003._20230414 + t1003._20230415) AS _20230415,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407 + t1003._20230408 + t1003._20230409 + t1003._20230410 + t1003._20230411 + t1003._20230412 + t1003._20230413 + t1003._20230414 + t1003._20230415 + t1003._20230416) AS _20230416,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407 + t1003._20230408 + t1003._20230409 + t1003._20230410 + t1003._20230411 + t1003._20230412 + t1003._20230413 + t1003._20230414 + t1003._20230415 + t1003._20230416 + t1003._20230417) AS _20230417,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407 + t1003._20230408 + t1003._20230409 + t1003._20230410 + t1003._20230411 + t1003._20230412 + t1003._20230413 + t1003._20230414 + t1003._20230415 + t1003._20230416 + t1003._20230417 + t1003._20230418) AS _20230418,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407 + t1003._20230408 + t1003._20230409 + t1003._20230410 + t1003._20230411 + t1003._20230412 + t1003._20230413 + t1003._20230414 + t1003._20230415 + t1003._20230416 + t1003._20230417 + t1003._20230418 + t1003._20230419) AS _20230419,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407 + t1003._20230408 + t1003._20230409 + t1003._20230410 + t1003._20230411 + t1003._20230412 + t1003._20230413 + t1003._20230414 + t1003._20230415 + t1003._20230416 + t1003._20230417 + t1003._20230418 + t1003._20230419 + t1003._20230420) AS _20230420,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407 + t1003._20230408 + t1003._20230409 + t1003._20230410 + t1003._20230411 + t1003._20230412 + t1003._20230413 + t1003._20230414 + t1003._20230415 + t1003._20230416 + t1003._20230417 + t1003._20230418 + t1003._20230419 + t1003._20230420 + t1003._20230421) AS _20230421,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407 + t1003._20230408 + t1003._20230409 + t1003._20230410 + t1003._20230411 + t1003._20230412 + t1003._20230413 + t1003._20230414 + t1003._20230415 + t1003._20230416 + t1003._20230417 + t1003._20230418 + t1003._20230419 + t1003._20230420 + t1003._20230421 + t1003._20230422) AS _20230422,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407 + t1003._20230408 + t1003._20230409 + t1003._20230410 + t1003._20230411 + t1003._20230412 + t1003._20230413 + t1003._20230414 + t1003._20230415 + t1003._20230416 + t1003._20230417 + t1003._20230418 + t1003._20230419 + t1003._20230420 + t1003._20230421 + t1003._20230422 + t1003._20230423) AS _20230423,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407 + t1003._20230408 + t1003._20230409 + t1003._20230410 + t1003._20230411 + t1003._20230412 + t1003._20230413 + t1003._20230414 + t1003._20230415 + t1003._20230416 + t1003._20230417 + t1003._20230418 + t1003._20230419 + t1003._20230420 + t1003._20230421 + t1003._20230422 + t1003._20230423 + t1003._20230424) AS _20230424,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407 + t1003._20230408 + t1003._20230409 + t1003._20230410 + t1003._20230411 + t1003._20230412 + t1003._20230413 + t1003._20230414 + t1003._20230415 + t1003._20230416 + t1003._20230417 + t1003._20230418 + t1003._20230419 + t1003._20230420 + t1003._20230421 + t1003._20230422 + t1003._20230423 + t1003._20230424 + t1003._20230425) AS _20230425,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407 + t1003._20230408 + t1003._20230409 + t1003._20230410 + t1003._20230411 + t1003._20230412 + t1003._20230413 + t1003._20230414 + t1003._20230415 + t1003._20230416 + t1003._20230417 + t1003._20230418 + t1003._20230419 + t1003._20230420 + t1003._20230421 + t1003._20230422 + t1003._20230423 + t1003._20230424 + t1003._20230425 + t1003._20230426) AS _20230426,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407 + t1003._20230408 + t1003._20230409 + t1003._20230410 + t1003._20230411 + t1003._20230412 + t1003._20230413 + t1003._20230414 + t1003._20230415 + t1003._20230416 + t1003._20230417 + t1003._20230418 + t1003._20230419 + t1003._20230420 + t1003._20230421 + t1003._20230422 + t1003._20230423 + t1003._20230424 + t1003._20230425 + t1003._20230426 + t1003._20230427) AS _20230427,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407 + t1003._20230408 + t1003._20230409 + t1003._20230410 + t1003._20230411 + t1003._20230412 + t1003._20230413 + t1003._20230414 + t1003._20230415 + t1003._20230416 + t1003._20230417 + t1003._20230418 + t1003._20230419 + t1003._20230420 + t1003._20230421 + t1003._20230422 + t1003._20230423 + t1003._20230424 + t1003._20230425 + t1003._20230426 + t1003._20230427 + t1003._20230428) AS _20230428,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407 + t1003._20230408 + t1003._20230409 + t1003._20230410 + t1003._20230411 + t1003._20230412 + t1003._20230413 + t1003._20230414 + t1003._20230415 + t1003._20230416 + t1003._20230417 + t1003._20230418 + t1003._20230419 + t1003._20230420 + t1003._20230421 + t1003._20230422 + t1003._20230423 + t1003._20230424 + t1003._20230425 + t1003._20230426 + t1003._20230427 + t1003._20230428 + t1003._20230429) AS _20230429,
    (t1003._20230401 + t1003._20230402 + t1003._20230403 + t1003._20230404 + t1003._20230405 + t1003._20230406 + t1003._20230407 + t1003._20230408 + t1003._20230409 + t1003._20230410 + t1003._20230411 + t1003._20230412 + t1003._20230413 + t1003._20230414 + t1003._20230415 + t1003._20230416 + t1003._20230417 + t1003._20230418 + t1003._20230419 + t1003._20230420 + t1003._20230421 + t1003._20230422 + t1003._20230423 + t1003._20230424 + t1003._20230425 + t1003._20230426 + t1003._20230427 + t1003._20230428 + t1003._20230429 + t1003._20230430) AS _20230430
FROM
    (SELECT 
            m_product.id AS idd,
            m_product.product_name,
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-01' THEN t103.ttq
                ELSE ''
            END) AS '_20230401',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-02' THEN t103.ttq
                ELSE ''
            END) AS '_20230402',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-03' THEN t103.ttq
                ELSE ''
            END) AS '_20230403',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-04' THEN t103.ttq
                ELSE ''
            END) AS '_20230404',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-05' THEN t103.ttq
                ELSE ''
            END) AS '_20230405',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-06' THEN t103.ttq
                ELSE ''
            END) AS '_20230406',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-07' THEN t103.ttq
                ELSE ''
            END) AS '_20230407',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-08' THEN t103.ttq
                ELSE ''
            END) AS '_20230408',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-09' THEN t103.ttq
                ELSE ''
            END) AS '_20230409',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-10' THEN t103.ttq
                ELSE ''
            END) AS '_20230410',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-11' THEN t103.ttq
                ELSE ''
            END) AS '_20230411',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-12' THEN t103.ttq
                ELSE ''
            END) AS '_20230412',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-13' THEN t103.ttq
                ELSE ''
            END) AS '_20230413',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-14' THEN t103.ttq
                ELSE ''
            END) AS '_20230414',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-15' THEN t103.ttq
                ELSE ''
            END) AS '_20230415',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-16' THEN t103.ttq
                ELSE ''
            END) AS '_20230416',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-17' THEN t103.ttq
                ELSE ''
            END) AS '_20230417',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-18' THEN t103.ttq
                ELSE ''
            END) AS '_20230418',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-19' THEN t103.ttq
                ELSE ''
            END) AS '_20230419',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-20' THEN t103.ttq
                ELSE ''
            END) AS '_20230420',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-21' THEN t103.ttq
                ELSE ''
            END) AS '_20230421',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-22' THEN t103.ttq
                ELSE ''
            END) AS '_20230422',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-23' THEN t103.ttq
                ELSE ''
            END) AS '_20230423',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-24' THEN t103.ttq
                ELSE ''
            END) AS '_20230424',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-25' THEN t103.ttq
                ELSE ''
            END) AS '_20230425',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-26' THEN t103.ttq
                ELSE ''
            END) AS '_20230426',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-27' THEN t103.ttq
                ELSE ''
            END) AS '_20230427',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-28' THEN t103.ttq
                ELSE ''
            END) AS '_20230428',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-29' THEN t103.ttq
                ELSE ''
            END) AS '_20230429',
            MAX(CASE
                WHEN t_shot_plan.product_date = '2023-04-30' THEN t103.ttq
                ELSE ''
            END) AS '_20230430'
    FROM
        t_shot_plan
    LEFT JOIN m_product ON m_product.id = t_shot_plan.production_id
    LEFT JOIN (SELECT 
            m_product.id AS iddd,
            product_date,
            m_product.product_name,
            SUM(quantity) AS ttq
    FROM
        t_shot_plan
    LEFT JOIN m_product ON m_product.id = t_shot_plan.production_id
    GROUP BY product_date , iddd) t103 ON t103.iddd = t_shot_plan.production_id
        AND t103.product_date = t_shot_plan.product_date
    GROUP BY product_name) t1003 

UNION SELECT 
    m_product.product_name AS product_name,
    '' AS a,
    '' AS b,
    '' AS c,
    '実績' AS d,
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-01' THEN t10.ttq
        ELSE ''
    END) AS '_20230401',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-02' THEN t10.ttq
        ELSE ''
    END) AS '_20230402',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-03' THEN t10.ttq
        ELSE ''
    END) AS '_20230403',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-04' THEN t10.ttq
        ELSE ''
    END) AS '_20230404',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-05' THEN t10.ttq
        ELSE ''
    END) AS '_20230405',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-06' THEN t10.ttq
        ELSE ''
    END) AS '_20230406',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-07' THEN t10.ttq
        ELSE ''
    END) AS '_20230407',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-08' THEN t10.ttq
        ELSE ''
    END) AS '_20230408',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-09' THEN t10.ttq
        ELSE ''
    END) AS '_20230409',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-10' THEN t10.ttq
        ELSE ''
    END) AS '_20230410',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-11' THEN t10.ttq
        ELSE ''
    END) AS '_20230411',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-12' THEN t10.ttq
        ELSE ''
    END) AS '_20230412',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-13' THEN t10.ttq
        ELSE ''
    END) AS '_20230413',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-14' THEN t10.ttq
        ELSE ''
    END) AS '_20230414',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-15' THEN t10.ttq
        ELSE ''
    END) AS '_20230415',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-16' THEN t10.ttq
        ELSE ''
    END) AS '_20230416',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-17' THEN t10.ttq
        ELSE ''
    END) AS '_20230417',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-18' THEN t10.ttq
        ELSE ''
    END) AS '_20230418',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-19' THEN t10.ttq
        ELSE ''
    END) AS '_20230419',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-20' THEN t10.ttq
        ELSE ''
    END) AS '_20230420',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-21' THEN t10.ttq
        ELSE ''
    END) AS '_20230421',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-22' THEN t10.ttq
        ELSE ''
    END) AS '_20230422',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-23' THEN t10.ttq
        ELSE ''
    END) AS '_20230423',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-24' THEN t10.ttq
        ELSE ''
    END) AS '_20230424',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-25' THEN t10.ttq
        ELSE ''
    END) AS '_20230425',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-26' THEN t10.ttq
        ELSE ''
    END) AS '_20230426',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-27' THEN t10.ttq
        ELSE ''
    END) AS '_20230427',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-28' THEN t10.ttq
        ELSE ''
    END) AS '_20230428',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-29' THEN t10.ttq
        ELSE ''
    END) AS '_20230429',
    MAX(CASE
        WHEN t_record_shot.product_date = '2023-04-30' THEN t10.ttq
        ELSE ''
    END) AS '_20230430'
FROM
    t_record_shot
        LEFT JOIN
    m_product ON m_product.id = t_record_shot.product_id
        LEFT JOIN
    (SELECT 
        m_product.id AS iddd,
            product_date,
            m_product.product_name,
            SUM(input_quantity) - SUM(ng_quantity) AS ttq
    FROM
        t_record_shot
    LEFT JOIN m_product ON m_product.id = t_record_shot.product_id
    GROUP BY product_date , iddd) t10 ON t10.iddd = t_record_shot.product_id
        AND t10.product_date = t_record_shot.product_date
GROUP BY product_name

UNION SELECT 
    t1004.product_name AS product_name,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407 + t1004._20230408 + t1004._20230409 + t1004._20230410 + t1004._20230411 + t1004._20230412 + t1004._20230413 + t1004._20230414 + t1004._20230415 + t1004._20230416 + t1004._20230417 + t1004._20230418 + t1004._20230419 + t1004._20230420 + t1004._20230421 + t1004._20230422 + t1004._20230423 + t1004._20230424 + t1004._20230425 + t1004._20230426 + t1004._20230427 + t1004._20230428 + t1004._20230429 + t1004._20230430) AS a,
    '' AS b,
    '' AS c,
    '累計実績' AS d,
    (t1004._20230401) AS _20230401,
    (t1004._20230401 + t1004._20230402) AS _20230402,
    (t1004._20230401 + t1004._20230402 + t1004._20230403) AS _20230403,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404) AS _20230404,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405) AS _20230405,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406) AS _20230406,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407) AS _20230407,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407 + t1004._20230408) AS _20230408,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407 + t1004._20230408 + t1004._20230409) AS _20230409,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407 + t1004._20230408 + t1004._20230409 + t1004._20230410) AS _20230410,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407 + t1004._20230408 + t1004._20230409 + t1004._20230410 + t1004._20230411) AS _20230411,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407 + t1004._20230408 + t1004._20230409 + t1004._20230410 + t1004._20230411 + t1004._20230412) AS _20230412,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407 + t1004._20230408 + t1004._20230409 + t1004._20230410 + t1004._20230411 + t1004._20230412 + t1004._20230413) AS _20230413,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407 + t1004._20230408 + t1004._20230409 + t1004._20230410 + t1004._20230411 + t1004._20230412 + t1004._20230413 + t1004._20230414) AS _20230414,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407 + t1004._20230408 + t1004._20230409 + t1004._20230410 + t1004._20230411 + t1004._20230412 + t1004._20230413 + t1004._20230414 + t1004._20230415) AS _20230415,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407 + t1004._20230408 + t1004._20230409 + t1004._20230410 + t1004._20230411 + t1004._20230412 + t1004._20230413 + t1004._20230414 + t1004._20230415 + t1004._20230416) AS _20230416,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407 + t1004._20230408 + t1004._20230409 + t1004._20230410 + t1004._20230411 + t1004._20230412 + t1004._20230413 + t1004._20230414 + t1004._20230415 + t1004._20230416 + t1004._20230417) AS _20230417,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407 + t1004._20230408 + t1004._20230409 + t1004._20230410 + t1004._20230411 + t1004._20230412 + t1004._20230413 + t1004._20230414 + t1004._20230415 + t1004._20230416 + t1004._20230417 + t1004._20230418) AS _20230418,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407 + t1004._20230408 + t1004._20230409 + t1004._20230410 + t1004._20230411 + t1004._20230412 + t1004._20230413 + t1004._20230414 + t1004._20230415 + t1004._20230416 + t1004._20230417 + t1004._20230418 + t1004._20230419) AS _20230419,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407 + t1004._20230408 + t1004._20230409 + t1004._20230410 + t1004._20230411 + t1004._20230412 + t1004._20230413 + t1004._20230414 + t1004._20230415 + t1004._20230416 + t1004._20230417 + t1004._20230418 + t1004._20230419 + t1004._20230420) AS _20230420,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407 + t1004._20230408 + t1004._20230409 + t1004._20230410 + t1004._20230411 + t1004._20230412 + t1004._20230413 + t1004._20230414 + t1004._20230415 + t1004._20230416 + t1004._20230417 + t1004._20230418 + t1004._20230419 + t1004._20230420 + t1004._20230421) AS _20230421,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407 + t1004._20230408 + t1004._20230409 + t1004._20230410 + t1004._20230411 + t1004._20230412 + t1004._20230413 + t1004._20230414 + t1004._20230415 + t1004._20230416 + t1004._20230417 + t1004._20230418 + t1004._20230419 + t1004._20230420 + t1004._20230421 + t1004._20230422) AS _20230422,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407 + t1004._20230408 + t1004._20230409 + t1004._20230410 + t1004._20230411 + t1004._20230412 + t1004._20230413 + t1004._20230414 + t1004._20230415 + t1004._20230416 + t1004._20230417 + t1004._20230418 + t1004._20230419 + t1004._20230420 + t1004._20230421 + t1004._20230422 + t1004._20230423) AS _20230423,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407 + t1004._20230408 + t1004._20230409 + t1004._20230410 + t1004._20230411 + t1004._20230412 + t1004._20230413 + t1004._20230414 + t1004._20230415 + t1004._20230416 + t1004._20230417 + t1004._20230418 + t1004._20230419 + t1004._20230420 + t1004._20230421 + t1004._20230422 + t1004._20230423 + t1004._20230424) AS _20230424,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407 + t1004._20230408 + t1004._20230409 + t1004._20230410 + t1004._20230411 + t1004._20230412 + t1004._20230413 + t1004._20230414 + t1004._20230415 + t1004._20230416 + t1004._20230417 + t1004._20230418 + t1004._20230419 + t1004._20230420 + t1004._20230421 + t1004._20230422 + t1004._20230423 + t1004._20230424 + t1004._20230425) AS _20230425,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407 + t1004._20230408 + t1004._20230409 + t1004._20230410 + t1004._20230411 + t1004._20230412 + t1004._20230413 + t1004._20230414 + t1004._20230415 + t1004._20230416 + t1004._20230417 + t1004._20230418 + t1004._20230419 + t1004._20230420 + t1004._20230421 + t1004._20230422 + t1004._20230423 + t1004._20230424 + t1004._20230425 + t1004._20230426) AS _20230426,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407 + t1004._20230408 + t1004._20230409 + t1004._20230410 + t1004._20230411 + t1004._20230412 + t1004._20230413 + t1004._20230414 + t1004._20230415 + t1004._20230416 + t1004._20230417 + t1004._20230418 + t1004._20230419 + t1004._20230420 + t1004._20230421 + t1004._20230422 + t1004._20230423 + t1004._20230424 + t1004._20230425 + t1004._20230426 + t1004._20230427) AS _20230427,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407 + t1004._20230408 + t1004._20230409 + t1004._20230410 + t1004._20230411 + t1004._20230412 + t1004._20230413 + t1004._20230414 + t1004._20230415 + t1004._20230416 + t1004._20230417 + t1004._20230418 + t1004._20230419 + t1004._20230420 + t1004._20230421 + t1004._20230422 + t1004._20230423 + t1004._20230424 + t1004._20230425 + t1004._20230426 + t1004._20230427 + t1004._20230428) AS _20230428,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407 + t1004._20230408 + t1004._20230409 + t1004._20230410 + t1004._20230411 + t1004._20230412 + t1004._20230413 + t1004._20230414 + t1004._20230415 + t1004._20230416 + t1004._20230417 + t1004._20230418 + t1004._20230419 + t1004._20230420 + t1004._20230421 + t1004._20230422 + t1004._20230423 + t1004._20230424 + t1004._20230425 + t1004._20230426 + t1004._20230427 + t1004._20230428 + t1004._20230429) AS _20230429,
    (t1004._20230401 + t1004._20230402 + t1004._20230403 + t1004._20230404 + t1004._20230405 + t1004._20230406 + t1004._20230407 + t1004._20230408 + t1004._20230409 + t1004._20230410 + t1004._20230411 + t1004._20230412 + t1004._20230413 + t1004._20230414 + t1004._20230415 + t1004._20230416 + t1004._20230417 + t1004._20230418 + t1004._20230419 + t1004._20230420 + t1004._20230421 + t1004._20230422 + t1004._20230423 + t1004._20230424 + t1004._20230425 + t1004._20230426 + t1004._20230427 + t1004._20230428 + t1004._20230429 + t1004._20230430) AS _20230430
FROM
    (SELECT 
            m_product.id AS idd,
            m_product.product_name,
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-01' THEN t104.ttqq
                ELSE ''
            END) AS '_20230401',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-02' THEN t104.ttqq
                ELSE ''
            END) AS '_20230402',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-03' THEN t104.ttqq
                ELSE ''
            END) AS '_20230403',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-04' THEN t104.ttqq
                ELSE ''
            END) AS '_20230404',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-05' THEN t104.ttqq
                ELSE ''
            END) AS '_20230405',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-06' THEN t104.ttqq
                ELSE ''
            END) AS '_20230406',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-07' THEN t104.ttqq
                ELSE ''
            END) AS '_20230407',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-08' THEN t104.ttqq
                ELSE ''
            END) AS '_20230408',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-09' THEN t104.ttqq
                ELSE ''
            END) AS '_20230409',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-10' THEN t104.ttqq
                ELSE ''
            END) AS '_20230410',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-11' THEN t104.ttqq
                ELSE ''
            END) AS '_20230411',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-12' THEN t104.ttqq
                ELSE ''
            END) AS '_20230412',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-13' THEN t104.ttqq
                ELSE ''
            END) AS '_20230413',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-14' THEN t104.ttqq
                ELSE ''
            END) AS '_20230414',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-15' THEN t104.ttqq
                ELSE ''
            END) AS '_20230415',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-16' THEN t104.ttqq
                ELSE ''
            END) AS '_20230416',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-17' THEN t104.ttqq
                ELSE ''
            END) AS '_20230417',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-18' THEN t104.ttqq
                ELSE ''
            END) AS '_20230418',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-19' THEN t104.ttqq
                ELSE ''
            END) AS '_20230419',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-20' THEN t104.ttqq
                ELSE ''
            END) AS '_20230420',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-21' THEN t104.ttqq
                ELSE ''
            END) AS '_20230421',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-22' THEN t104.ttqq
                ELSE ''
            END) AS '_20230422',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-23' THEN t104.ttqq
                ELSE ''
            END) AS '_20230423',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-24' THEN t104.ttqq
                ELSE ''
            END) AS '_20230424',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-25' THEN t104.ttqq
                ELSE ''
            END) AS '_20230425',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-26' THEN t104.ttqq
                ELSE ''
            END) AS '_20230426',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-27' THEN t104.ttqq
                ELSE ''
            END) AS '_20230427',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-28' THEN t104.ttqq
                ELSE ''
            END) AS '_20230428',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-29' THEN t104.ttqq
                ELSE ''
            END) AS '_20230429',
            MAX(CASE
                WHEN t_record_shot.product_date = '2023-04-30' THEN t104.ttqq
                ELSE ''
            END) AS '_20230430'
    FROM
        t_record_shot
    LEFT JOIN m_product ON m_product.id = t_record_shot.product_id
    LEFT JOIN (SELECT 
            m_product.id AS idddd,
            product_date,
            m_product.product_name,
            SUM(input_quantity) - SUM(ng_quantity) AS ttqq
    FROM
        t_record_shot
    LEFT JOIN m_product ON m_product.id = t_record_shot.product_id
    GROUP BY product_date , idddd) t104 ON t104.idddd = t_record_shot.product_id
        AND t104.product_date = t_record_shot.product_date
    GROUP BY product_name) t1004
ORDER BY product_name DESC , CASE d
    WHEN '計画' THEN 4
    WHEN '累計計画' THEN 3
    WHEN '実績' THEN 2
    WHEN '累計実績' THEN 1
    ELSE 0
END DESC