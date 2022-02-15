<?php

// включаем вывод ошибок в результат выполнения скрипта
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
ini_set('display_errors', 1);

// делаем вызов к АПИ Битрикс24
// параметры вызова беруться из объекта $_REQUEST
// если мы вызывали этот скрипт с кодировкой параметров application/x-www-form-urlencoded
$api_call_result = json_decode(file_get_contents($_REQUEST["auth"]["client_endpoint"]
    . "crm.deal.get",
    false, stream_context_create(
        array(
            'http' => array(
                'method' => 'POST',
                'content' => json_encode(array(
                    "auth" => $_REQUEST["auth"]["access_token"],
                    "id" => $_REQUEST["deal_id"],
                )),
                'header' => "Content-Type: application/json\r\n" .
                    "Accept: application/json\r\n"
            )
        )
    )
));

// данные ответа хранятся в поле result
$result = $api_call_result->result;

// если скрипт вызван с кодировкой параметров application/json
// то так мы декодируем параметры в переменную
$data = json_decode(file_get_contents("php://input"));

// и тогда вызов АПИ метода будет выглядеть так 
$api_call_result = json_decode(file_get_contents($data->auth->client_endpoint
    . "crm.deal.get",
    false, stream_context_create(
        array(
            'http' => array(
                'method' => 'POST',
                'content' => json_encode(array(
                    "auth" => data->auth->access_token,
                    "id" => data->deal_id,
                )),
                'header' => "Content-Type: application/json\r\n" .
                    "Accept: application/json\r\n"
            )
        )
    )
));

//для вывода данных в результат выполнения скрипта используем echo
echo api_call_result->result->TITLE;
// или так мы можем вывести всю структуру переменной 
var_dump(api_call_result);
// или так
header('Content-Type: application/json');
echo json_encode(api_call_result);