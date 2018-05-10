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

if(!isset($_GET['id']))
  {
    echo "<meta http-equiv=refresh content='0; url=admin3.php?sel3=selected'>";
    exit();
  }

if(!file_exists("db/$_GET[id]/index.txt"))
  {
    echo "<meta http-equiv=refresh content='0; url=admin3.php?sel3=selected'>";
    exit();
  }

if(isset($_GET['page']))  $page=$_GET['page'];
else $page=1;

if(isset($_GET['ind']))  $ind=$_GET['ind'];
else $ind=1;

$d=opendir("db/$_GET[id]");
      while(($e=readdir($d))!=false)
         {
           if($e =="." || $e =="..") continue;
           unlink("db/$_GET[id]/$e");
         }
closedir($d);
rmdir("db/$_GET[id]");

 $last=file("db/blok.txt");
    $f=fopen("db/blok.txt","w");
    foreach($last as $line)
     {
       $line=trim($line);
       $expl=explode("*",$line);
       if($expl[0]==$_GET['id'])continue;
       fwrite($f,$line."\r\n");
     }
    fclose($f);

echo "<meta http-equiv=refresh content='0; url=admin3.php?sel3=selected&ind=$ind&page=$page'>";
exit();

?>