<?php
 session_start();

//Получаем сессию
$strpath="conf/conf.txt";
$content=file($strpath);

$n=0;
//Обработка
foreach($content as $line):
  if ($n==2) $sess=$line;
  $n++;

endforeach;

if (session_id()!=$sess):
  $url=urlencode("Пройдите авторизацию!");
  echo "<meta http-equiv=refresh content='0; url=index.php?acc=$url'>";
  exit();
endif;

if(!isset($_GET['id']) || !isset($_GET['op']))
  {
    echo "<meta http-equiv=refresh content='0; url=admin5.php?sel5=selected'>";
    exit();
  }

if(!file_exists("db/bl/$_GET[id]"))
  {
    echo "<meta http-equiv=refresh content='0; url=admin5.php?sel5=selected'>";
    exit();
  }

if(isset($_GET['page']))  $page=$_GET['page'];
else $page=1;

if(isset($_GET['ind']))  $ind=$_GET['ind'];
else $ind=1;

if($_GET['op']==1) unlink("db/bl/$_GET[id]");

if($_GET['op']==2)
 {    $file=file("db/bl/$_GET[id]");
   	$expl=explode("*",$file[0]);
   	$expl[3]=trim($expl[3]);
   	if(file_exists("db/$expl[2]"))
   	  {        $f=fopen("db/$expl[2]/$expl[3]","w+");
        fwrite($f,"$expl[0]*$expl[1]*$_GET[id]\r\n$file[1]");
        fclose($f);
   	  }
   	unlink("db/bl/$_GET[id]");
 }

echo "<meta http-equiv=refresh content='0; url=admin5.php?sel5=selected&ind=$ind&page=$page'>";
exit();

?>