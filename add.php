<?php
    #Массив с параметрами, которые нужно передать методом POST к API системы
    $user=array(
        'USER_LOGIN'=>'estarodubov@team.amocrm.com', #Ваш логин (электронная почта)
        'USER_HASH'=>'41d055471fe453fdf6d0732bee5d265b' #Хэш для доступа к API (смотрите в профиле пользователя)
    );

    $subdomain='coospir'; #Наш аккаунт - поддомен

    #Формируем ссылку для запроса
    $link='https://'.$subdomain.'.amocrm.ru/private/api/auth.php?type=json';

    $curl=curl_init(); #Сохраняем дескриптор сеанса cURL
    #Устанавливаем необходимые опции для сеанса cURL
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-API-client/1.0');
    curl_setopt($curl,CURLOPT_URL,$link);
    curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
    curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($user));
    curl_setopt($curl,CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
    curl_setopt($curl,CURLOPT_HEADER,false);
    curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__).'/cookie.txt');
    curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__).'/cookie.txt');
    curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
    curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);

    $out=curl_exec($curl); #Инициируем запрос к API и сохраняем ответ в переменную
    $code=curl_getinfo($curl,CURLINFO_HTTP_CODE); #Получим HTTP-код ответа сервера

    curl_close($curl); #Завершаем сеанс cURL

    $code=(int)$code;
    $errors=array(
        301=>'Moved permanently',
        400=>'Bad request',
        401=>'Unauthorized',
        403=>'Forbidden',
        404=>'Not found',
        500=>'Internal server error',
        502=>'Bad gateway',
        503=>'Service unavailable'
    );

    try
    {
        #Если код ответа не равен 200 или 204 - возвращаем сообщение об ошибке
        if($code!=200 && $code!=204) {
            throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undescribed error',$code);
        }
    }
    catch(Exception $E)
    {
        die('Ошибка: '.$E->getMessage().PHP_EOL.'Код ошибки: '.$E->getCode());
    }

    $Response=json_decode($out,true);
    $Response=$Response['response'];
    if(isset($Response['auth'])) {
        #Флаг авторизации доступен в свойстве "auth"
        echo 'Авторизация прошла успешно' . "<br>";

        if ($code == 200) {
            echo "Все окей: " . $code . "<br>";
        }

        if ($code == 204) {
            echo "Нет содержимого: " . $code . "<br>";
        }
        echo "<hr>";

        /* Function "Add New Entity" */


        function run_query($link, $what, $data)
        {
            $curl = curl_init(); #Сохраняем дескриптор сеанса cURL
            #Устанавливаем необходимые опции для сеанса cURL
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-API-client/1.0');
            curl_setopt($curl, CURLOPT_URL, $link);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_COOKIEFILE, dirname(__FILE__) . '/cookie.txt');
            curl_setopt($curl, CURLOPT_COOKIEJAR, dirname(__FILE__) . '/cookie.txt');
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);

            $out = curl_exec($curl); #Инициируем запрос к API и сохраняем ответ в переменную
            $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            $code = (int)$code;
            $errors = array(
                301 => 'Moved permanently',
                400 => 'Bad request',
                401 => 'Unauthorized',
                403 => 'Forbidden',
                404 => 'Not found',
                500 => 'Internal server error',
                502 => 'Bad gateway',
                503 => 'Service unavailable'
            );




            $Response = json_decode($out, true);
            $Response = $Response['response'][$what]['add'];

            return $Response;
            curl_close($curl);
        }


            /*$temp=[];
            for ($i=0;$i<5;$i++) {
                $temp[]=[
                    "name"=>"Тестовая сделка",
                    "price"=>5000,
                    "responsible_user_id"=>1665151,
                    "status_id" => 15977434,
                    'custom_fields'=>[
                        [
                            'id'=>119737, // id поля "стоимость"
                            "values"=> [
                                [
                                    "value"=>55000,
                                ]
                            ]
                        ]
                    ],
                    'notes' => array(
                        array(
                            'text' => 'Note',
                            'note_type' => 4,
                            'element_type' => 2,
                        ),
                    )
                ];
            }
            $leads['request']['leads']['add']=$temp;*/

            /*$leads['request']['leads']['update']=array(
            array(
                'name'=>'Заявка (Сбор контактов)',
                'status_id'=>15977425,
                'price'=> 0,
                'responsible_user_id'=>1665151,
                'pipeline_id' => 727321,
                'tags' => 'Заявка с сайта', #Теги
                'last_modified' => time(),
                'custom_fields'=>array(
                    array(
                        'id'=>100507, # Телефон
                        'values'=>array(
                            array(
                              'value'=> 'Test1'
                            )
                        )
                    )
                )
            )
        );*/

            /*$catalogs['request']['catalogs']['add'] = array(
                array(
                    'name'=>'Tariffs',
                ),
                array(
                    'name'=>'Products',
                )
            );*/


            /*$catalog_elements['request']['catalog_elements']['add']= array(
                array(
                    'catalog_id'=>1565,
                    'name'=>'Black iPhone',
                )
            );*/


           /* $element['request']['catalog_elements']['update']=array(
                array(
                    'id'=> 172735,
                    'catalog_id'=> 1565,
                    'name'=>'Test',
                    'custom_fields'=>[
                        [
                            'id'=> 119735,
                            'name'=>'Количество',
                            'code'=>'QUANTITY',
                            'values'=>[
                                [
                                    'value'=>'250'
                                ]
                            ]
                        ]
                    ]
                )
            );*/



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

            /*$fields = [
                'request' => [
                    'tasks' => [
                        'add' => [
                            [
                                'element_id' => 2349035,
                                'element_type' => 2,
                                'task_type' => 2,
                                //'task_type' => "CALL",
                                'text' => 'Описание задачи ' . date('d-m-Y H:i:s'),
                                'complete_till' => 1443248842
                            ]
                        ]
                    ]
                ]
            ];*/
            $notes['request']['notes']['add']=array(
                array(
                    'element_id'=>2258435,
                    'element_type'=>25,
                    'note_type'=>4,
                    'text'=>'Test',
                    'responsible_user_id'=>1665151,
                ),
            );
            $link='https://'.$subdomain.'.amocrm.ru/private/api/v2/json/notes/set';
            $result = run_query($link, "notes", $notes);
            $output = "ID добавленных сделок: " . PHP_EOL;
            echo $output;
             foreach ($result as $v)
                if (is_array($v))
                    $output .= $v['id'] . PHP_EOL;

            /*$fields['request']['fields']['add'] = array(
                array(
                    'name' => 'MultiListTest', #Имя контакта
                    'type' => 5,
                    'element_type' => 2,
                    'enums' => ['Test1', 'Test2', 'Test3', 'Test4', 'Test5', 'Test6', 'Test7', 'Test8', 'Test9', 'Test0'],
                    'origin' => '528d0285c1f9180911159a9dc6f759b3_zendesk_widget',
                ),
            );

            $link = 'https://' . $subdomain . '.amocrm.ru/private/api/v2/json/fields/set';
            $result = run_query($link, "fields", $fields);
            $output = 'ID добавленных полей:' . PHP_EOL;

            foreach ($result as $v)
                if (is_array($v))
                    $output .= $v['id'] . PHP_EOL;

            echo $output;*/
           



    }


?>




