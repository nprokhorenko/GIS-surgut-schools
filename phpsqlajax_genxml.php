<?php
require("config.php");

function parseToXML($htmlStr)
{
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&#39;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);
return $xmlStr;
}

/*
// Открываем соединение с MySQL-сервером
$connection=mysql_connect (localhost, $username, $password);
if (!$connection) {
die('Нет соединения : ' . mysql_error());
}

// Устанавливаем соединение с БД
$db_selected = mysql_select_db($database, $connection);
if (!$db_selected) {
die ('Невозможно использовать БД : ' . mysql_error());
}
*/
// Выборка всех записей из таблицы markers
$query = "SELECT * FROM schools WHERE 1";
$result = mysql_query($query);
if (!$result) {
die('Неверный запрос: ' . mysql_error());
}

header("Content-type: text/xml");

// Создание XML-кода, вывод родительского элемента
echo '<markers>';


while ($row = @mysql_fetch_assoc($result)){
// Вывод нового узла XML
echo '<marker ';
echo 'id="' . parseToXML($row['id']) . '" ';
echo 'name="' . parseToXML($row['name']) . '" ';
echo 'address="' . parseToXML($row['address']) . '" ';
echo 'phone="' . parseToXML($row['phone']) . '" ';
echo 'photo="' . parseToXML($row['photo']) . '" ';
echo 'email="' . parseToXML($row['email']) . '" ';
echo 'strength="' . parseToXML($row['strength']) . '" ';
echo 'time_start="' . parseToXML($row['time_start']) . '" ';
echo 'time_end="' . parseToXML($row['time_end']) . '" ';
echo 'lat="' . parseToXML($row['lat']) . '" ';
echo 'lng="' . parseToXML($row['lng']) . '" ';
echo 'type="' . parseToXML($row['type']) . '" ';
echo '/>';
}

// Конец XML-файла
echo '</markers>';

?>