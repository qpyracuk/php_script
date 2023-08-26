<?php
/**Файл конфигурации */
require("./configs/base.php");
/**Класс объектов запроса */
require("./components/request-unit.php");
/**Взаимодействие с SQL-server */
require("./handlers/db.php");
/** Запросы к серверу */
require("./handlers/request.php");

// Получение всех строк из исходной таблицы, где unwrap = 0
$raws = GetRaws();
foreach ($raws as $key => $value) {
    $id = $value["id"];
    $puid = $value["puid"];
    $campaign = $value["campaign"];
    $token = $value["token"];
    $encryptedKey = SendRequest(URL, new Reqest($campaign, $token), METHOD);
    if (!!$encryptedKey) InsertRecord($id, $campaign, $puid, $token, $encryptedKey);  
    else die ("Не удалось получить ответ от сервера<br>");
}
echo "Процесс завершён";
?>