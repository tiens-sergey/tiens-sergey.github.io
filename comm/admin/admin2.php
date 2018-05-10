<?php
 include("cap.php");
 $info="";
 if(isset($_POST['go']))
  {
    $_POST['name']=trim($_POST['name']);
    $_POST['opr']=trim($_POST['opr']);
    $_POST['opr']=str_replace("\r\n","<br>",$_POST['opr']);
    if($_POST['name']!="")
      {         $time=time();
         mkdir("db/$time");
         $f=fopen("db/$time/index.txt","w+");
         fwrite($f,$_POST['name']."\r\n".$_POST['opr']);
         fclose($f);
         $info="Комментарий создан.";

      }
  }

?>
<FORM ACTION="admin2.php?sel2=selected" METHOD="POST" name="form">
<TABLE align=center bgcolor=#EBEBEB width=80% CELLPADDING=20 CELLSPACING=0 border=0>

<tr >
   <td ><FONT COLOR="#408080" size=+1>Создание комментариев</FONT><br />
   Название обязательно для ввода и будет выводится над всеми комментариями по данной теме.<br />
    Пояснение только для вас и фигурировать нигде не будет. Вводить его не обязательно. <br />
    <?echo "<font color=red> $info </font>"; ?>
    </td>
</tr>



<tr bgcolor=#F0F0F0><td>
Название<br />
 <input name="name" type="text" value="" size=70><br /><br />
Пояснение<br />
<textarea name="opr" rows=5 cols=55 ></textarea><br />
<input type="submit" value="Сохранить" name=go>

</td></tr>
</table>
</form>
</body>

</html>