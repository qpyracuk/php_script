<?php
/** ПОДКЛЮЧЕНИЕ К БАЗЕ ДАННЫХ */
/** Адрес хоста + порт (порт не обязательно)*/
define("DB_HOST","mssql,1433");
/** Название базы данных */
define("DB_NAME","master");
/** Пользователь базы данных */
define("DB_USER","SA");
/**  Пароль пользователя базы данных */
define("DB_PASSWORD","Yapillac1");


/** НАЗВАНИЯ ТАБЛИЦ */
/** Исходная таблица */
define("SRC_TABLE","src");
/** Таблица с результатом обработки */
define("RES_TABLE","res");


/** ЗАПРОС К СЕРВЕРУ intercollectcontact.ru*/
/** Метод запроса */
define("METHOD","POST");
/** URL-адрес запроса */
define("URL","https://intercollectcontact.ru/pra/usersByTokens");
?>