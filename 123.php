<?php
/**
 * Created by PhpStorm.
 * User: COOSPIR-PC
 * Date: 04.09.2017
 * Time: 11:20
 */
$api_key = 'f9caf96f2bb672ecac84793cc3bd15b0';
$login = 'mr.inkognitod@yandex.ru';
$subdomain = 'leden';

$phone_field_id = 198586;
$phone_type_id = 456256;
$phone = $_POST['phone'];
$lead_name = 'Заявка с сайта';
$source = 'sanobrabotka';

// дальше ничего менять не нужно

$data['request']['unsorted'] = [
    'category' => 'forms',
    'add' => [[
        'source' => $source,
        'source_uid' => NULL,
        'data' => [
            'leads' => [[
                'name' => $lead_name,
            ]],
            'contacts' => [[
                'name' => 'Контакт для ' . $lead_name,
                'custom_fields' => [[
                    'id' => $phone_field_id,
                    'values' => [[
                        'enum' => $phone_type_id,
                        'value' => $phone,
                    ]],
                ]],
            ]],
        ],
        'source_data' => [
            'data' => [[
                'type' => 'multitext',
                'id' => $phone_field_id,
                'element_type' => '1',
                'name' => 'Телефон',
                'value' => [$phone]
            ]],
            'form_id' => 1,
            'form_type' => 1,
            'origin' => ['ip' => '0.0.0.0'],
            'date' => time(),
            'from' => $source,
        ],
    ]],
];

$link = "https://$subdomain.amocrm.ru/api/unsorted/add/?api_key=$api_key&login=$login";

$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-API-client/1.0');
curl_setopt($curl, CURLOPT_HTTPHEADER, ['Accept: application/json']);
curl_setopt($curl, CURLOPT_URL, $link);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);

$out = curl_exec($curl);
$code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);


/*формируем отчет об ошибках*/
$set = json_encode($set);
$log = '';
$log .= "set:\n$set_str\n\n";
$log .= "code:\n$code\n\n";
$log .= "out:\n$out\n\n";
file_put_contents('log.txt', $out);
/*****/
// echo $code . "<br>" . $out; // вывод на экран
// file_put_contents('log.txt', $code . "\n" . $out); // запись в файл