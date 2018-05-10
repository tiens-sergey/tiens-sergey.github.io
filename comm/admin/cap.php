<?PHP
session_start();
//Получаем сессию
$strpath="conf/conf.txt";
@$content=file($strpath);
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

if (@$_POST['list_navig']=='1')  echo "<meta http-equiv=refresh content='0; url=admin1.php?sel1=selected'>";
if (@$_POST['list_navig']=='3')  echo "<meta http-equiv=refresh content='0; url=admin3.php?sel3=selected'>";
if (@$_POST['list_navig']=='2')  echo "<meta http-equiv=refresh content='0; url=admin2.php?sel2=selected'>";
if (@$_POST['list_navig']=='4')  echo "<meta http-equiv=refresh content='0; url=admin4.php?sel4=selected'>";
if (@$_POST['list_navig']=='5')  echo "<meta http-equiv=refresh content='0; url=admin5.php?sel5=selected'>";
if (@$_POST['list_navig']=='6')  echo "<meta http-equiv=refresh content='0; url=admin6.php?sel6=selected'>";
if (@$_POST['list_navig']=='7')  echo "<meta http-equiv=refresh content='0; url=admin7.php?sel7=selected'>";
if (@$_POST['list_navig']=='8')  echo "<meta http-equiv=refresh content='0; url=admin8.php?sel8=selected'>";

?>
<HTML>
<head>



 <style>
 table {

 	     font-size:10pt;
      }

A:Link,A:Visited,A:Active { Color: ".@$cont[0]."; Text-decoration: none}
A:Hover{ Color: ".@$cont[0]."; Text-decoration: none}

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
</style>

<TITLE>Администрирование</TITLE>
</head>
<BODY BGCOLOR='#E6E6E6'>
 <font color=#808000>Комментарии 1.1</font>
<CENTER><table border=0 CELLPADDING=0 CELLSPACING=0  width=70%><tr><td >

<IMG SRC='img/log.png' ALIGN='center' >&nbsp&nbsp&nbsp&nbsp
<font size=+3 color=#408080 ><b><tt>Администрирование</tt></b></font></td>
<td align=right>

<form  action='cap.php' method='post' name='cap'>
<SELECT NAME="list_navig" onchange="cap.submit();">
<OPTION value="1" <? echo @$_GET['sel1']; ?> >Настройки страницы комментариев</option>
<OPTION value="8" <? echo @$_GET['sel8']; ?> >Настройки блока последних сообщений</option>
<OPTION value="2" <? echo @$_GET['sel2']; ?> >Создание комментариев</option>
<OPTION value="3" <? echo @$_GET['sel3']; ?> >Редактирование комментариев</option>
<OPTION value="5" <? echo @$_GET['sel5']; ?> >Чёрный список</option>
<OPTION value="6" <? echo @$_GET['sel6']; ?> >Запрещённые слова</option>
<OPTION value="7" <? echo @$_GET['sel7']; ?> >Вставка кода</option>
<OPTION value="4" <? echo @$_GET['sel4']; ?>  >Логин и пароль</option>
</SELECT>


</form>

<?php
//Ссылка для возврата

echo "<a href=http://".$_SERVER['SERVER_NAME'].">Выход</a>";

?>
</td></tr>
</table></CENTER><p>



