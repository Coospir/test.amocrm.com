<?php
// ваши данные для авторизации
$api_key = '41d055471fe453fdf6d0732bee5d265b';
$login = 'estarodubov@team.amocrm.com';
$subdomain = 'coospir';

// id полей в вашем аккаунте, если требуется
/*$phone_field_id = 30213;
$phone_type_id = 8;*/

// добавляемые данные
$phone = '8-999-999-99-99';
$lead_name = 'Test lead name';
$source = 'test-website.ru';

////////////////////////////////////////
$data['request']['unsorted'] = array(
    'category' => 'forms',
    'add' => array(
        array(
            'source' => $source,
            'source_uid' => NULL,
            'data' => array(
                'leads' => array(
                    array(
                        'price' => '35223523',
                        'date_create' => 1546544971,
                        'responsible_user_id' => 1665151,
                         'name' => $lead_name,
                        'tags' => "'some-good-tag','some-good-tag2'",
                        'notes' => array(
                            array(
                                'text' => 'Note',
                                'note_type' => 4,
                                'element_type' => 2,
                            ),
                        ),
                    ),
                ),
                'contacts' => array(
                    array(
                        'name' => 'Some name 2',
                        'custom_fields' => array(
                            array(
                                'id' => 30213,
                                'values' => array(
                                    array(
                                        'enum' => 66131,
                                        'value' => $phone,
                                    ),
                                ),
                            ),
                        ),
                        'date_create' => 1446544971,
                        'responsible_user_id' => '102525',
                        'tags' => 'my-super-form',
                        'notes' => array(
                            array(
                                'text' => '',
                                'note_type' => 4,
                                'element_type' => 1,
                            ),
                        ),
                    ),
                ),
            ),
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

        ),
    ),
);

/*$temp=[];
for ($i=0;$i<5;$i++) {
    $temp[]=[
        "name"=>"Test0",
        "price"=>0,
        "responsible_user_id"=>1665151,
        "pipeline_id" => 15977431,
        'custom_fields'=>[
            [
                'id'=>119737, //сюда надо вставить свой айдишник
                "values"=> [
                    [
                        "value"=>55000, //Поле типа текст
                    ]
                ]
            ]
        ],
    ];
}*/
//$leads['request']['leads']['add']=$temp;

/*$data['request']['unsorted'] = [
	'category' => 'forms',
	'add' => [[
		'source' => $source,
		'source_uid' => NULL,
		'data' => [
			'leads' => [[
				'name' => $lead_name,
                'price' => 25000,

			]],
            'data_create' => 1504778990,
            'responsible_user_id' => 1665151,
            'tags' => "'tag', 'tag1'",
            'notes' => [[
                'text' => 'Testing..',
                'note_type' => 4,
                'element_type' => 2,
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
];*/

$link = "https://$subdomain.amocrm.ru/api/api/unsorted/add/?api_key=$api_key&login=$login";

$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-API-client/1.0');
curl_setopt($curl, CURLOPT_HTTPHEADER, ['Accept: application/json']);
curl_setopt($curl, CURLOPT_URL, $link);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($leads));
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);

$out = curl_exec($curl);
$code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);

echo $out;
 // вывод на экран
// file_put_contents('log.txt', $code . "\n" . $out); // запись в файл
