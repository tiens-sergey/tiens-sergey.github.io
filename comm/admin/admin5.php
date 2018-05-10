<?php
 include("cap.php");


?>

<style>
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
       {
       	  font-family:"Times New Roman", "serif";
          color:#0052A4;
          font-size:10pt;
          font-weight:300;
       }
</style>
<TABLE align=center bgcolor=#EBEBEB width=60% CELLPADDING=5 CELLSPACING=0 border=0>

<tr >
   <td><FONT COLOR="#408080" size=+1>Чёрный список</FONT><br />
   Вы можете удалить из чёрного списка пользователя. Тогда он вновь сможет оставлять комментарии.<br />
   Восстановить-значит удалить из чёрного списка, а заодно вернуть комментарий на место.<br />
    </td>
</tr>

<tr><td>

<?php
$bl=array();
$d=opendir("db/bl");
while(($e=readdir($d))!=false)
     {
          if($e =="." || $e ==".." || $e==".htaccess") continue;
           $bl[]=$e;
     }
closedir($d);


//Постраничная навигация
 $topic_count_page=50;
 if(!isset($_GET['page']) || !is_numeric(@$_GET['page']) || @$_GET['page']<1 )$page=1;
 else $page=$_GET['page'];
 if($page > ceil(count($bl)/ $topic_count_page))$page=1;
 $start=$page * $topic_count_page-$topic_count_page;
 $pages=ceil(count($bl)/ $topic_count_page);
 if(empty($_GET['ind']) || !is_numeric(@$_GET['ind']) || @$_GET['ind']>ceil($pages/$topic_count_page)  || @$_GET['ind']<1)$index=1;
 else $index= $_GET['ind'];


  for($x=$start,$y=0; $x<count($bl); $x++,$y++)
   {
     if($y==$topic_count_page)break;
     $file=file("db/bl/$bl[$x]");   	 $expl=explode("*",$file[0]);

   	  echo"<table width=100%  id=blok><tr><td align=right>
               <font color=#408080><b>$expl[0]</b>&nbsp;&nbsp;&nbsp;<b>$expl[1]</b></font></td></tr>
               <tr><td>$file[1]
                 </td></tr>
                 <tr><td align=right>
                 <a href=bl.php?id=$bl[$x]&ind=$index&page=$page&op=1>Удалить</a>&nbsp;&nbsp;
                  <a href=bl.php?id=$bl[$x]&ind=$index&page=$page&op=2>Восстановить</a>
                 </td></tr>
               </table><br />";
   }


if(count($bl)> $topic_count_page)
    {
      //Постраничная навигаця
      echo "<tr><td colspan=3>";

       if($index>1)echo "
       <a class='navig_passiv' href=admin5.php?sel5=selected&page=".(($index-1)*10)."&ind=".($index-1)." title=назад><<</a>";

       for($i=$index*10-9,$p=1; $i < $pages+1; $i++,$p++)
          {

            if($p>10 )
          	  {
          	  	echo "<a class='navig_passiv'  href=admin5.php?sel5=selected&page=".($i)."&ind=".($index+1)." title=далее>>></a>";
          	  	break;
          	  }
          	if($page==$i)
            echo "<a class='navig_activ' href=admin5.php?sel5=selected&page=$i&ind=$index>$i</a>";
            else
            echo "<a class='navig_passiv'href=admin5.php?sel5=selected&page=$i&ind=$index>$i</a>";
          }

     echo "</td></tr>";
    }
?>

</td></tr>
</table>
</body>

</html>