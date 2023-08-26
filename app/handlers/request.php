<?php
/**
 * Отправляет запрос на сервер (использует CURL)
 * @param mixed $url URL
 * @param mixed $data Передаваемые данные (сериализация происходит перед отправкой)
 * @param mixed $method Метод запроса (по умолчанию: POST)
 * @return bool|string
 */
function SendRequest($url, $data, $method = "POST") {
    $result = false;
    try {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $headers = array(
            "Accept: application/json",
            "Content-Type: application/json; charset=UTF-8"
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        $resp = curl_exec($curl);
        $result = json_decode($resp)[0];
        
    }
    catch(Exception $e){
        echo "Запрос для $data->campaignId не обработан<br>";
    }
    return $result;
}
?>