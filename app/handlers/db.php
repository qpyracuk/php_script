<?php
/**
 * Производит подключение к базе данных SQL-сервер
 * @return resource
 */
function Connect(){
    //Все конфигурации для подключения к базе данных
    //необходимо указывать в файле /configs/base.php
    try{
        
        $serverName = DB_HOST;
        $connectionOptions = array("Database"=>DB_NAME, "Uid"=>DB_USER, "PWD"=>DB_PASSWORD, "CharacterSet"=>"UTF-8");
        $conn = sqlsrv_connect($serverName, $connectionOptions);
        if ($conn == false){
            die("Ошибка подключения к базе данных<br>");
        }
    }
    catch (Exception $e){
        die("Во время попытки подключения к базе данных произошла неизветная ошибка<br>");
    }
    return $conn;
}

/**
 * Производит выборку из исходной таблицы всех строк со значением unwrap = 0
 * @return array 
 */
function GetRaws(){
    /** @var string запрос к базе данных с условием unwrap = 0*/
    $query = "SELECT id, campaign, puid, token FROM ".SRC_TABLE." WHERE unwrap = 0";
    $result = [];
    try {
        $connect = Connect();
        $response = sqlsrv_query($connect, $query);
        if ($response == false) die("Не удалось выполнить запрос к базе данных<br>");
        $counter = 0;
        while($row = sqlsrv_fetch_array($response, SQLSRV_FETCH_ASSOC)) {
            $result[] = $row;
            $counter++;
        }
        sqlsrv_free_stmt($response);
        sqlsrv_close($connect);
        if ($counter <= 0) die("В таблице отсутствуют строки с unwrap = 0<br>");
    }
    catch(Exception $e){
        die("Произошла ошибка, при попытке получения информации из исходной таблицы<br>");
    }
    return $result;
}

/** Запрос на заполнение таблицы с результатами (значение полей таблицы указано с заглавной буквы, как в ТЗ) */
define("queryRes", "INSERT INTO ".RES_TABLE." (Campaign, Puid, Token, Encryptedkey) VALUES (?, ?, ?, ?)");
/** Запрос на обновление значения unwrap в исходной таблице */
define("querySrc", "UPDATE " . SRC_TABLE . " SET unwrap = 1 WHERE id = ?");

/**
 * Производит заполнение результирующей таблицы и корректировку исходной
 * @param mixed $id идентификатор записи
 * @param mixed $campaign значение campaign из исходной таблицы
 * @param mixed $puid значение puid из исходной таблицы
 * @param mixed $token значение token из исходной таблицы
 * @param mixed $encryptedKey значение encryptedKey, полученое от сервиса
 * @return void
 */
function InsertRecord($id, $campaign, $puid, $token, $encryptedKey) {
    $paramsRes = array($campaign, $puid, $token, $encryptedKey);
    $paramsSrc = array($id);
    try {
        $connect = Connect();
        $answer = sqlsrv_query($connect, queryRes, $paramsRes);
        if (!!$answer) sqlsrv_query($connect, querySrc, $paramsSrc); 
        else echo "Запрос на заполнение таблицы с результатами не выполнен!<br>";
        sqlsrv_close($connect);
    }
    catch(Exception $e) {
        echo "При добавлении записи в таблицу с результатами произошла ошибка!<br>$e";
    }
}
?>