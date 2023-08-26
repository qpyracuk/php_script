<?php
/**Файл конфигурации */
require("./configs/base.php");
/**Класс объектов запроса */
require("./components/request-unit.php");
/**Взаимодействие с SQL-server */
require("./handlers/db.php");
/** Запросы к серверу */
require("./handlers/request.php");

$raws = GetRaws();
foreach ($raws as $key => $value) {
    $id = $value["id"];
    $puid = $value["puid"];
    $campaign = $value["campaign"];
    $token = $value["token"];
    $encryptedKey = SendRequest(URL, new Reqest($campaign, $token), METHOD);
    echo ($encryptedKey);
    if (!!$encryptedKey){
        InsertRecord($id, $campaign, $puid, $token, $encryptedKey);
    }
    else{
        echo "Не удалось получить ответ от сервера";
    }
    
}
echo "Процесс завершён";
?>