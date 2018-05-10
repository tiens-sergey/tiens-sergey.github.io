<?php
 session_start();
?>

<style>

   #button {
     font-family:"Times New Roman", "serif";
     color:#408080;
     font-size:9pt;
     background-color:#C0C0C0;
     font-weight:600;
     text-align:center;
     width:120px;
      }
</style>

<?
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
if(!isset($_GET['id_comm']) || !isset($_GET['id']) || !isset($_GET['op']))
  {
    echo "<meta http-equiv=refresh content='0; url=admin3.php?sel3=selected'>";
    exit();
  }

if(!file_exists("db/$_GET[id]/$_GET[id_comm]"))
  {
    echo "<meta http-equiv=refresh content='0; url=admin3.php?sel3=selected'>";
    exit();
  }

if(isset($_GET['page_ret']))  $page_ret=$_GET['page_ret'];
else $page_ret=1;

if(isset($_GET['ind_ret']))  $ind_ret=$_GET['ind_ret'];
else $ind_ret=1;

if(isset($_GET['page']))  $page=$_GET['page'];
else $page=1;

if(isset($_GET['ind']))  $ind=$_GET['ind'];
else $ind=1;

if(isset($_POST['save']))
  {
    $_POST['res']=trim($_POST['res']);
    $_POST['res']=str_replace("\r\n","<br>",$_POST['res']);
    if($_POST['res']!="")
      {
        $comm=file("db/$_GET[id]/$_GET[id_comm]");
        $f=fopen("db/$_GET[id]/$_GET[id_comm]","w");
        fwrite($f,$comm[0].$_POST['res']);
        fclose($f);
        echo "<meta http-equiv=refresh content='0; url=red.php?id=$_GET[id]&ind_ret=$ind_ret&page_ret=$page_ret&ind=$ind&page=$page'>";
        exit();
      }
  }

if($_GET['op']==1)
  {     $comm=file("db/$_GET[id]/$_GET[id_comm]");
     $comm[1]=str_replace("<br>","\r\n",$comm[1]);
    echo"<title>Редактирование</title><table  width=80%  border=0>
  <tr>
    <td align=center  valign=center>

    <h2><font color=#727272>Редактирование</font></h2>
      <table>
       <tr><td>
    <form  action=op.php?op=1&id=$_GET[id]&id_comm=$_GET[id_comm]&ind_ret=$ind_ret&page_ret=$page_ret&ind=$ind&page=$page method=post>
      <textarea name=res rows=30 cols=100 >$comm[1]</textarea><br />
      <input type=submit value=Сохранить name=save id=button>
    </form>
    </td></tr></table>";
  }

if($_GET['op']==2)
  {  	 unlink("db/$_GET[id]/$_GET[id_comm]");
  	 //из последних сообщений
  	$last=array();
    $last=file("db/blok.txt");
    $f=fopen("db/blok.txt","w");
    foreach($last as $line)
     {       $line=trim($line);
       $expl=explode("*",$line);
       if($expl[1]==$_GET['id_comm'])continue;
       fwrite($f,$line."\r\n");
     }
    fclose($f);

     echo "<meta http-equiv=refresh content='0; url=red.php?id=$_GET[id]&ind_ret=$ind_ret&page_ret=$page_ret&ind=$ind&page=$page'>";
     exit();
  }

if($_GET['op']==3)
  {
     $comm=file("db/$_GET[id]/$_GET[id_comm]");
     $expl=explode("*",$comm[0]);
     $expl[2]=trim($expl[2]);

     $d=opendir("db/bl");
      while(($e=readdir($d))!=false)
         {
           if($e =="." || $e ==".." || $e==".htaccess") continue;
           if($e==$expl[2])
             {
          	   echo "<meta http-equiv=refresh content='0; url=red.php?id=$_GET[id]&ind_ret=$ind_ret&page_ret=$page_ret&ind=$ind&page=$page'>";
               exit();
             }
         }
     closedir($d);


     $f=fopen("db/bl/$expl[2]","w+");
     fwrite($f,$expl[0]."*".$expl[1]."*$_GET[id]*$_GET[id_comm]\r\n".$comm[1]);
     fclose($f);
     echo "<meta http-equiv=refresh content='0; url=red.php?id=$_GET[id]&ind_ret=$ind_ret&page_ret=$page_ret&ind=$ind&page=$page'>";
     exit();
  }
?>

