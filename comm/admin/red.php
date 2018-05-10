<?php
 session_start();
?>

<style>
  .navig_activ
         {
          font-family: Arial, sans-serif;
          font-size:10pt;
          border-style:solid;
          border-width: 1px;
          border-color:#D2D2D2;
          background-color:#800040;
          padding:5px;
          text-align:center;
          color:#ffffff;

         }

 .navig_passiv
        {

          fontfont-family: Arial, sans-serif;
          font-size:10pt;
          border-style:solid;
          border-width: 1px;
          border-color:#D2D2D2;
          background-color:#F0F0F0;
          padding:5px;
          text-align:center;
          color:#676767;
       }

   a.navig_activ
     {
      text-decoration:none;
     }
   a.navig_passiv
      {
      text-decoration:none;
      }

     #blok
         {
         	border-style:solid;
            border-width: 1px;
            border-color:#909090;
            background-color:#F9F9F9;
            padding:10px;

            font-family:"Times New Roman", "serif";
            color:#4A4A4A;
            font-size:11pt;
            font-weight:300;
         }
      #blok a
       {       	  font-family:"Times New Roman", "serif";
          color:#0052A4;
          font-size:10pt;
          font-weight:300;
       }

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

<?PHP

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
if(!isset($_GET['id']) || !file_exists("db/$_GET[id]/index.txt"))
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
  {    $_POST['name']=trim($_POST['name']);
    $_POST['res']=trim($_POST['res']);
    $_POST['res']=str_replace("\r\n","<br>",$_POST['res']);
    if($_POST['name']!="")
      {
        $f=fopen("db/$_GET[id]/index.txt","w");
        fwrite($f,$_POST['name']."\r\n".$_POST['res']);
        fclose($f);
      }
  }


if(isset($_POST['exit']))
  {
  	echo "<meta http-equiv=refresh content='0; url=admin3.php?sel3=selected&ind=$ind_ret&page=$page_ret'>";
    exit();
  }


$cont=file("db/$_GET[id]/index.txt");
$opis="";
if(isset($cont[1])) $opis=str_replace("<br>","\r\n",$cont[1]);


$file=array();
$d=opendir("db/$_GET[id]");
            while(($e=readdir($d))!=false)
           {
             if($e =="." || $e ==".." || $e==".htaccess" || $e=="index.txt") continue;
             $file[]=$e;
           }
closedir($d);
rsort($file);

echo"<title>Редактирование</title>
<table  width=80%  border=0>
<tr>
  <td >

    <h2><font color=#727272>Редактирование</font></h2>
      <table>
       <tr><td>
 <form  action=red.php?id=$_GET[id]&ind_ret=$ind_ret&page_ret=$page_ret&ind=$ind&page=$page method=post>

   <input name=name type=text value='$cont[0]' size=70><br />
    <textarea name=res rows=5 cols=55 >$opis</textarea><br />
    <input type=submit value=Сохранить name=save id=button>&nbsp;
    <input type=submit value=Выход name=exit id=button>
 </form>
 </td></tr></table>";

//Постраничная навигация
 $topic_count_page=50;
 if(!isset($_GET['page']) || !is_numeric(@$_GET['page']) || @$_GET['page']<1 )$page=1;
 else $page=$_GET['page'];
 if($page > ceil(count($file)/ $topic_count_page))$page=1;
 $start=$page * $topic_count_page-$topic_count_page;
 $pages=ceil(count($file)/ $topic_count_page);
 if(empty($_GET['ind']) || !is_numeric(@$_GET['ind']) || @$_GET['ind']>ceil($pages/$topic_count_page)  || @$_GET['ind']<1)$index=1;
 else $index= $_GET['ind'];

for($x=$start,$y=0; $x<count($file); $x++,$y++)
         {
           if($y==$topic_count_page)break;
           $comm=file("db/$_GET[id]/$file[$x]");
           $expl=explode("*",$comm[0]);
           echo"<table width=80%  id=blok><tr><td align=right>
               <font color=#408080><b>$expl[0]</b>&nbsp;&nbsp;&nbsp;<b>$expl[1]</b></font></td></tr>
               <tr><td>$comm[1]
                 </td></tr>
                 <tr><td align=right>
                  <a href=op.php?op=1&id=$_GET[id]&id_comm=$file[$x]&ind_ret=$ind_ret&page_ret=$page_ret&ind=$ind&page=$page>Редактировать</a>&nbsp;&nbsp;
                  <a href=op.php?op=2&id=$_GET[id]&id_comm=$file[$x]&ind_ret=$ind_ret&page_ret=$page_ret&ind=$ind&page=$page>Удалить</a>&nbsp;&nbsp;
                  <a href=op.php?op=3&id=$_GET[id]&id_comm=$file[$x]&ind_ret=$ind_ret&page_ret=$page_ret&ind=$ind&page=$page>В чёрный список</a>
                 </td></tr>
               </table><br />";
         }


if(count($file)> $topic_count_page)
    {
      //Постраничная навигаця
      echo "<table width=80%><tr><td>";

       if($index>1)echo "
       <a class='navig_passiv' href=red.php?id=$_GET[id]&ind_ret=$ind_ret&page_ret=$page_ret&page=".(($index-1)*10)."&ind=".($index-1)." title=назад><<</a>&nbsp;";

       for($i=$index*10-9,$p=1; $i < $pages+1; $i++,$p++)
          {

            if($p>10 )
          	  {
          	  	echo "<a class='navig_passiv'  href=red.php?id=$_GET[id]&ind_ret=$ind_ret&page_ret=$page_ret&page=".($i)."&ind=".($index+1)." title=далее>>></a>&nbsp;";
          	  	break;
          	  }
          	if($page==$i)
            echo "<a class='navig_activ' href=red.php?id=$_GET[id]&ind_ret=$ind_ret&page_ret=$page_ret&page=$i&ind=$index>$i</a>&nbsp;";
            else
            echo "<a class='navig_passiv'href=red.php?id=$_GET[id]&ind_ret=$ind_ret&page_ret=$page_ret&page=$i&ind=$index>$i</a>&nbsp;";
          }

     echo "</td></tr></table>";
    }


echo "</td></tr></table>";



?>