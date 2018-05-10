<?php
$catalog='comm';
if(!isset($_GET['id']))exit();
if(!file_exists("admin/db/$_GET[id]/index.txt")) exit();

$comm_user="";
if(isset($_GET['s']))
 {
 	if(!file_exists("admin/db/$_GET[id]/$_GET[s]")) exit();
    $comm_user=file("admin/db/$_GET[id]/$_GET[s]");
    $expl=explode("*",$comm_user[0]);
    $user_date=$expl[0];
    $user_name=$expl[1];
    $comm_user[1]=str_replace("<br>","\r\n",$comm_user[1]);

    //Вырез цитат

       $pos_cit=strpos($comm_user[1],"[/cit]");
       if($pos_cit!==false)
         {
           $pos_cit+=6;
           $comm_user[1]=substr($comm_user[1],$pos_cit);
         }
 }



$info="";
$text_name="";
$text_comm="";

$conf=file("admin/conf/mes.txt");
for($i=0; $i<count($conf); $i++)
  {
  	$conf[$i]=trim($conf[$i]);
  	$expl=explode("*",$conf[$i]);
    $conf[$i]=$expl[1];
  }

$top_code="";
$bot_code="";
if(filesize("admin/conf/code/top.txt")!=0)
  {
    $f=fopen("admin/conf/code/top.txt","r");
    $top_code=fread($f,filesize("admin/conf/code/top.txt"));
    fclose($f);
  }

if(filesize("admin/conf/code/bot.txt")!=0)
  {
    $f=fopen("admin/conf/code/bot.txt","r");
    $bot_code=fread($f,filesize("admin/conf/code/bot.txt"));
    fclose($f);
  }

 $img="img/code/".rand(1,12).".jpg";

$stop=array();
$stop=file("admin/conf/stop.txt");
$content=file("admin/db/$_GET[id]/index.txt");
$content[0]=trim($content[0]);
if(isset($_POST['go']))
   {
     $_POST['name']=trim($_POST['name']);
     $_POST['comm']=trim($_POST['comm']);
     $_POST['name']=htmlspecialchars($_POST['name']);
     $_POST['name']=stripslashes($_POST['name']);
     $_POST['name']=str_replace("*","",$_POST['name']);
     $_POST['comm']=htmlspecialchars($_POST['comm']);
     $_POST['comm']=stripslashes($_POST['comm']);

     $_POST['comm']=str_replace("[cit]","",$_POST['comm']);
     $_POST['comm']=str_replace("[/cit]","",$_POST['comm']);
     $_POST['comm']=str_replace("[date]","",$_POST['comm']);
     $_POST['comm']=str_replace("[/date]","",$_POST['comm']);

     if(isset($_POST['user']))
       {
         $_POST['user']=htmlspecialchars($_POST['user']);
         $_POST['user']=stripslashes($_POST['user']);
         $_POST['user']=str_replace("\r\n","<br>",$_POST['user']);

          $pos_cit=strpos($_POST['user'],"[/cit]");
         if($pos_cit!==false)
         {
           $pos_cit+=6;
           $_POST['user']=substr($_POST['user'],$pos_cit);
         }

         $_POST['user']=str_replace("[cit]","",$_POST['user']);
         $_POST['user']=str_replace("[/cit]","",$_POST['user']);
         $_POST['user']=str_replace("[date]","",$_POST['user']);
         $_POST['user']=str_replace("[/date]","",$_POST['user']);
       }

     $text_name=$_POST['name'];
     $text_comm=$_POST['comm'];

     if($_POST['name']=="" ||  $_POST['comm']=="") $info="Введите имя и комментарий!";

         $num=false;
            switch($_POST['hid'])
             {
               case "img/code/1.jpg": if($_POST['cod']!="5406") $num=true;
                                 break;

              case "img/code/2.jpg": if($_POST['cod']!="0954") $num=true;
                                 break;
              case "img/code/3.jpg": if($_POST['cod']!="9432") $num=true;
                                 break;
              case "img/code/4.jpg": if($_POST['cod']!="5912") $num=true;
                                 break;
              case "img/code/5.jpg": if($_POST['cod']!="3498") $num=true;
                                 break;
              case "img/code/6.jpg": if($_POST['cod']!="7543") $num=true;
                                break;
              case "img/code/7.jpg": if($_POST['cod']!="4591") $num=true;
                                break;
              case "img/code/8.jpg": if($_POST['cod']!="9854") $num=true;
                                break;
              case "img/code/9.jpg": if($_POST['cod']!="7631") $num=true;
                                break;
              case "img/code/10.jpg": if($_POST['cod']!="9654") $num=true;
                                break;
              case "img/code/11.jpg": if($_POST['cod']!="3861") $num=true;
                                break;
              case "img/code/12.jpg": if($_POST['cod']!="7312") $num=true;
              break;
             }

             if($num)$info="Вы неправильно ввели код!";


        //Чёрный список
        $d=opendir("admin/db/bl");
        while(($e=readdir($d))!=false)
         {
            if($e =="." || $e ==".." || $e==".htaccess") continue;
            if($e==$_SERVER['REMOTE_ADDR'])
              {
                $info="Вы не можете оставлять комментарии!";
                break;
              }
         }
        closedir($d);
        //Слова
      if(count($stop))
      {
        $expl=array();
        $expl=explode(",",$stop[0]);
        foreach($expl as $line)
         {
           if($line=="")continue;
           $str="";
           $str= stristr($_POST['name'], $line);
	       $str= stristr($_POST['comm'], $line);
	       if($str!="")
	         {
	           $info="В сообщении обнаружены запрещённые слова. Вы не можете оставлять комментариев!";
               $f=fopen("admin/db/bl/$_SERVER[REMOTE_ADDR]","w+");
               fwrite($f,date("d.m.Y")."*".$_POST['name']."*$_GET[id]*".time()."\r\n".$_POST['comm']);
               fclose($f);
	           break;
	         }
         }
      }
        //Знаков в сообщении
        if(strlen($_POST['comm'])>$conf[58]) $info="Максимальное количество знаков в сообщении $conf[58]";

        if($info=="")
         {
         	//Отправляем сообщение
            if($conf[59]!="")
            {
                 $subject= "Оставлен новый комментарий.";
                 $label_name="Администратор";
                 $message=
"Здравствуйте! В разделе $content[0] оставлен новый комментарий.
$_POST[name]
$_POST[comm]
Просмотреть комментарий можно здесь http://$_SERVER[SERVER_NAME]/$catalog/comm.php?id=$_GET[id]


C уважением. Администратор.";
                 $message=str_replace("\r\n\r\n","\r\n",$message);
                 if($conf[61]=="koi-8")
                  {
                    $message=convert_cyr_string($message,"w","k");
                    $subject=convert_cyr_string($subject,"w","k");
                    $label_name= convert_cyr_string($label_name,"w","k");
                  }
                  $headers="";
                  $headers.= "From: $label_name<admin@site.ru>\r\n";
                   Mail("$conf[59]", $subject, $message,$headers);
            }
           $time=time();




           $_POST['comm']=str_replace("\r\n","<br>",$_POST['comm']);

           if(isset($_POST['user']))
             {
             	if($_POST['user']!="") $_POST['comm']="[cit][date]".$user_date."  ".$user_name."[/date] $_POST[user][/cit]<br>$_POST[comm]";
             }

           $f=fopen("admin/db/$_GET[id]/".$time,"w+");
           fwrite($f,date("d.m.Y H:i")."*".$_POST['name']."*".$_SERVER['REMOTE_ADDR']."\r\n".$_POST['comm']);
           fclose($f);

           //Последние сообщения
           $mes=array();
           $mes=file("admin/db/blok.txt");
           if((count($mes)+1) >30)
             {
               $arr = array_shift($mes);
               array_push($mes,"$_GET[id]*$time\r\n");
               $f=fopen("admin/db/blok.txt","w");
               for($n=0;$n < count($mes);$n++)fwrite($f,$mes[$n]);
             }
           else
             {
               $f=fopen("admin/db/blok.txt","a+");
               fwrite($f,"$_GET[id]*$time\r\n");
             }

           fclose($f);


           echo "<meta http-equiv=refresh content='0; url=comm.php?id=$_GET[id]'>";
         }


   }

?>
<html>

<head>
  <title>Добавить комментарий  <?echo $content[0]?></title>
  <style>

      #button {

       font-family:font-style:<? echo $conf[21]?>;
       color:<?echo $conf[17]?>;
       font-size:<?echo $conf[18]?>pt;
       font-style:<? echo $conf[19]?>;
       background-color:<? echo $conf[13]?>;
      font-weight:font-style:<? echo $conf[20]?>;;
      text-align:center;
      width:<? echo $conf[12]?>px;

       border-style:<?echo $conf[16]?>;
       border-width:<?echo $conf[15]?>px;
       border-color:<?echo $conf[14]?>;
       padding:1px;
      }


      #form
      {
      	font-family:<? echo $conf[11]?>;
        color:<? echo $conf[7]?>;
        font-size:<? echo $conf[8]?>pt;
        font-style:<? echo $conf[9]?>;
        font-weight:<? echo $conf[10]?>;
      }

      #head
      {
      	font-family:<? echo $conf[5]?>;
        color:<?echo $conf[1]?>;
        font-size:<?echo $conf[2]?>pt;
        font-style:<? echo $conf[3]?>;
        font-weight:<? echo $conf[4]?>;
      }
     #info
      {
    	 font-family:"Times New Roman", "serif";
         font-size:10pt;
         color:#FF0000;
         font-weight:600;
         font-style:normal;
      }
      #copy a
      {
    	 font-family:"Times New Roman", "serif";
         font-size:10pt;
         color:#808080;
         font-weight:300;
         font-style:normal;
      }



</style>



</head>

<body bgcolor=<?echo $conf[0]?>>
<table border=0 width=100% >
   <tr><td>
       <?echo $top_code?>

   </td></tr>
 <tr><td>

<table align=center width=70% bgcolor=<?echo $conf[60]?> CELLPADDING=10>
<tr><td>


<table  id=form>
<? if($conf[6]==1) echo "<tr><td><span id=head>$content[0]</span></td></tr>" ?>
<tr><td><?if($info!="")echo "<font id=info>$info</font><br />"?>

<?
 if(isset($_GET['s']))echo "<form  action=form.php?id=$_GET[id]&s=$_GET[s] method=post>";
 else echo "<form  action=form.php?id=$_GET[id] method=post>";
 ?>
Имя<br />
<input name="name" type="text" size=50 value=<?echo $text_name?>><br />


<? if(isset($_GET['s'])) echo "<textarea name=user rows=10 cols=60>$comm_user[1]</textarea><br />" ?>

Комментарий<br />
<textarea name="comm" rows=10 cols=60><?echo $text_comm?></textarea><br />

 <input type=hidden name='hid' value=<? echo $img?>>
 <input type=text name='cod' size=5>
 <IMG SRC=<? echo $img?> ALT='Код'  ><br /><br />

<input type="submit" value="Отправить" name=go id=button>
</form>
</td></tr></table>


</td></tr></table>

</td></tr>

 <tr><td>
   <?echo $bot_code?>
 </td></tr>
 <tr><td align=center id=copy>
 </td></tr>
 </table>
</body>

</html>