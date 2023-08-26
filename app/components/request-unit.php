<?php
/**
 *  Класс запроса для десериализации
 */
class Reqest {
    public string $campaignId;
    public Array $tokens;
    /**
     * Конструктор запроса
     * @param mixed $campaignId - значение campaignId из начальной таблица
     * @param mixed $token - значение token из начальной таблицы
     */
    public function __construct($campaignId, $token){
        $this->campaignId = $campaignId;
        $this->tokens = Array($token);
    } 
}
?>