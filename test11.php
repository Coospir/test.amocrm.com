<?php
/**
 * Created by PhpStorm.
 * User: COOSPIR-PC
 * Date: 01.09.2017
 * Time: 11:28
 */
$catalogs_element['request']['сatalog_elements']['update']=array(
    array(
        'id'=> 1565,
        'catalog_id'=> 172735,
        'name'=>'Apples',
        'custom_fields'=>[
            'id'=>119735,
            'name'=>'Количество',
            'code'=>'QUANTITY',
            'values'=>[
                ['value'=>10],
            ],
        ],
    )
);


/*$leads['request']['leads']['update']=array(
array(
    'id'=>1767413,
    'name'=> 'Test1',
    'status_id'=>15817579,
    'price'=> 0,
    'last_modified'=>time(),
    'responsible_user_id'=>15977419,
    'custom_fields'=>array(
        array(
            'id'=>100507, # Телефон
            'values'=> [[
                'value'=>'Test1',

            ]]
                )
            )
        )
    );*/
/*$link='https://'.$subdomain.'.amocrm.ru/private/api/v2/json/catalog_elements/set';
$result = run_query($link, "catalog_elements", $catalogs_element);*/
$test = json_encode($catalogs_element);
echo $test;
$output = "ID добавленных сделок: " . PHP_EOL;
foreach ($result as $v)
    if (is_array($v))
        $output .= $v['id'] . PHP_EOL;