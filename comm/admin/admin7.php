<?php
 include("cap.php");
 if(isset($_POST['go']))
  {
    $_POST['top']=trim($_POST['top']);
    $_POST['bot']=trim($_POST['bot']);
    $_POST['top']=stripcslashes($_POST['top']);
    $_POST['bot']=stripcslashes($_POST['bot']);
    $f=fopen("conf/code/top.txt","w");
    fwrite($f,$_POST['top']);
    fclose($f);

    $f=fopen("conf/code/bot.txt","w");
    fwrite($f,$_POST['bot']);
    fclose($f);
  }
$top_code=file("conf/code/top.txt");
$bot_code=file("conf/code/bot.txt");
$top="";
$bot="";
if(isset($top_code[0])) $top=$top_code[0];
if(isset($bot_code[0])) $bot=$bot_code[0];

?>
<TABLE align=center bgcolor=#EBEBEB width=80% CELLPADDING=20 CELLSPACING=0 border=0>

<tr >
   <td ><FONT COLOR="#408080" size=+1>Вставка кода</FONT><br />  Этот код будет на странице с комментариями.
    </td>
</tr>

<FORM ACTION="admin7.php?sel7=selected" METHOD="POST" name="form">

<tr bgcolor=#F0F0F0>
<td>Верх<br />
 <textarea name="top" rows=30 cols=100><?echo $top?></textarea><br /><br />
 Низ<br />
  <textarea name="bot" rows=30 cols=100><?echo $bot?></textarea><br />
 <input type="submit" value="Сохранить" name=go>

</td></tr>
</form>
</table>
</body>

</html>