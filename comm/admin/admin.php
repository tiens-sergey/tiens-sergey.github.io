<?php
session_start();
$_POST['login']=trim($_POST['login']);
$_POST['pasw']=trim($_POST['pasw']);

if(@$_POST['login']=="" || @$_POST['pasw']=="")
 {
  echo "<meta http-equiv=refresh content='0; url=index.php'>";
  exit();
 }


$content=file("conf/conf.txt");
$content[0]=trim($content[0]);
$content[1]=trim($content[1]);


if(($content[0]!=md5($_POST['login'])) || ($content[1]!=md5($_POST['pasw'])))
 {
  echo "<meta http-equiv=refresh content='0; url=index.php'>";
  exit();
 }


//Сохраняем сессию в настройках

//Обработка
  $f=fopen("conf/conf.txt","w");
  fwrite($f,$content[0]."\r\n");
  fwrite($f,$content[1]."\r\n");
  fwrite($f,session_id());
  fclose($f);

echo "<meta http-equiv=refresh content='0; url=admin1.php'>";
exit();

?>