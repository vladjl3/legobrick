<?php
$dbn = mysql_connect('localhost:3306', 'h-476_legouser', 'bFp5!b06');
mysql_select_db('h-47678_lego', $dbn);
mysql_query('SET NAMES utf8');

  //  require_once "start.php";
	require_once "get_contents.php";

function clean($value = "") {
    $value = trim($value);//для удаления пробелов из начала и конца строки.
    $value = stripslashes($value);// удаляет экранирование символов ("Ваc зовут O\'reilly?" => "Вас зовут O'reilly?").
    $value = strip_tags($value);//нужна для удаления HTML и PHP тегов
    $value = htmlspecialchars($value);//преобразует специальные символы в HTML-сущности ('&' преобразуется в '&amp;' и т.д.)

    return $value;
}

/*function check_length($value = "", $min, $max) {
    $result = (mb_strlen($value) < $min || mb_strlen($value) > $max);
    return !$result;
}*/

$name = $_POST['u_name'];
$telephone = $_POST['t_phone'];
$name = clean($name);
$telephone = clean($telephone);

$botToken = "211887779:AAEvs7OhNAHxXKadeSHxZp-Wpy9mSta_3TY";
$website = "https://api.telegram.org/bot".$botToken;
$update = get_contents($website."/getUpdates");
$updateArray = json_decode($update,TRUE);
$title_msg1 = "Здравствуйте! Меня зовут";
$title_msg2 = "Позвоните мне по телефону";
$name_msg = "Телефон=";
$chatID = $updateArray["result"][0]["message"]["chat"]["id"];

if (!empty($name) && !empty($telephone)) {
$sql_insert = "INSERT INTO `tlgrm`(`name`, `telephone`) VALUES ('".$name."','".$telephone."')";
mysql_query($sql_insert);
	//	get_contents($website."/sendmessage?chat_id=139847549&text=".$title_msg1." ".$name."."." ".$title_msg2." ".$telephone);
		get_contents($website."/sendmessage?chat_id=93249961&text=".$title_msg1." ".$name."."." ".$title_msg2." ".$telephone);
	//	get_contents($website."/sendmessage?chat_id=151159879&text=".$title_msg1." ".$name."."." ".$title_msg2." ".$telephone);

echo "<script>alert('Ваша заявка принята. Наш оператор вам обязательно позвонит');</script>";
die("<script>setTimeout(function(){window.location='index.php#map';},0);</script>");
}
else echo "<script>alert('Форма пуста!');</script>";

die("<script>setTimeout(function(){window.location='index.php';}, 0);</script>");
?>


