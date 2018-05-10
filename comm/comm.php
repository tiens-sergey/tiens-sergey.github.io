<?php
$catalog='comm';
if(!isset($_GET['id']))exit();
if(!file_exists("admin/db/$_GET[id]/index.txt")) exit();



$conf=file("admin/conf/mes.txt");
for($i=0; $i<count($conf); $i++)
  {
  	$conf[$i]=trim($conf[$i]);
  	$expl=explode("*",$conf[$i]);
    $conf[$i]=$expl[1];
  }




$content=file("admin/db/$_GET[id]/index.txt");
$content[0]=trim($content[0]);


if(isset($_GET['page']))  $page=$_GET['page'];
else $page=1;
if(isset($_GET['ind']))  $ind=$_GET['ind'];
else $ind=1;

$file=array();
$d=opendir("admin/db/$_GET[id]");
            while(($e=readdir($d))!=false)
           {
             if($e =="." || $e ==".." || $e==".htaccess" || $e=="index.txt") continue;
             $file[]=$e;
           }
closedir($d);
rsort($file);


//Постраничная навигация
 $topic_count_page=$conf[57];
 if(!isset($_GET['page']) || !is_numeric(@$_GET['page']) || @$_GET['page']<1 )$page=1;
 else $page=$_GET['page'];
 if($page > ceil(count($file)/ $topic_count_page))$page=1;
 $start=$page * $topic_count_page-$topic_count_page;
 $pages=ceil(count($file)/ $topic_count_page);
 if(empty($_GET['ind']) || !is_numeric(@$_GET['ind']) || @$_GET['ind']>ceil($pages/$topic_count_page)  || @$_GET['ind']<1)$index=1;
 else $index= $_GET['ind'];

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


?>

<html>

<head>
  <title><?echo $content[0]?></title>
  <style>
  .navig_activ
         {
          font-family:<? echo $conf[45]?>;
          font-size:<?echo $conf[43]?>pt;
          font-style:<? echo $conf[44]?>;
          border-style:solid;
          border-width: <? echo $conf[47]?>px;
          border-color:<? echo $conf[46]?>;
          background-color:<?echo $conf[40]?>;
          padding:5px;
          text-align:center;
          color:<?echo $conf[42]?>;
          width:<?echo $conf[41]?>;
         }

 .navig_passiv
        {

          font-family:<? echo $conf[53]?>;
          font-size:<?echo $conf[51]?>pt;
          font-style:<? echo $conf[52]?>;
          border-style:solid;
          border-width: <? echo $conf[55]?>px;
          border-color:<? echo $conf[54]?>;
          background-color:<?echo $conf[48]?>;
          padding:5px;
          text-align:center;
          color:<?echo $conf[50]?>;
          width:<?echo $conf[49]?>;
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
            border-left-width: <?echo $conf[25]?>px;
            border-right-width: <?echo $conf[25]?>px;
            border-top-width: <?echo $conf[25]?>px;
            border-bottom-width: <?echo $conf[28]?>px;

            border-left-color: <?echo $conf[24]?>;
            border-right-color: <?echo $conf[24]?>;
            border-top-color: <?echo $conf[24]?>;
            border-bottom-color: <?echo $conf[27]?>;

            border-left-style: <?echo $conf[26]?>;
            border-right-style: <?echo $conf[26]?>;
            border-top-style: <?echo $conf[26]?>;
            border-bottom-style: <?echo $conf[29]?>;

            background-color:<? echo $conf[22]?>;
            padding:10px;

            font-family:<? echo $conf[39]?>;
            color:<? echo $conf[35]?>;
            font-size:<? echo $conf[36]?>pt;
            font-style:<? echo $conf[37]?>;
            font-weight:<? echo $conf[38]?>;
         }
      #blok a
       {
       	  font-family:<? echo $conf[39]?>;
          color:<? echo $conf[35]?>;
          font-size:<? echo $conf[36]?>pt;
          font-style:<? echo $conf[37]?>;
          font-weight:<? echo $conf[38]?>;
       }


     #date
      {
      	font-family:<? echo $conf[34]?>;
        color:<?echo $conf[30]?>;
        font-size:<?echo $conf[31]?>pt;
        font-style:<? echo $conf[32]?>;
        font-weight:<? echo $conf[33]?>;
      }
     #name
      {
      	font-family:<? echo $conf[34]?>;
        color:<?echo $conf[30]?>;
        font-size:<?echo $conf[31]?>pt;
        font-style:<? echo $conf[32]?>;
        font-weight:<? echo $conf[33]?>;
      }

      #head
      {
      	font-family:<? echo $conf[5]?>;
        color:<?echo $conf[1]?>;
        font-size:<?echo $conf[2]?>pt;
        font-style:<? echo $conf[3]?>;
        font-weight:<? echo $conf[4]?>;
      }



     #cit
         {
          font-family:<? echo $conf[66]?>;
          font-size:<? echo $conf[63]?>pt;
          border-style:<? echo $conf[69]?>;
          border-width: <? echo $conf[68]?>px;
          border-color:<? echo $conf[67]?>;
          background-color:<? echo $conf[85]?>;
          padding:10px;
          text-align:left;
          color:<? echo $conf[62]?>;
          font-weight:<? echo $conf[65]?>;
          font-style:<? echo $conf[64]?>;


         }

     #cit_date
      {
    	 font-family:<? echo $conf[79]?>;
         font-size:<? echo $conf[76]?>pt;
         color:<? echo $conf[75]?>;
         font-weight:<? echo $conf[78]?>;
         font-style:<? echo $conf[77]?>;
      }
      #otv a
      {
    	 font-family:<? echo $conf[74]?>;
         font-size:<? echo $conf[71]?>pt;
         color:<? echo $conf[70]?>;
         font-weight:<? echo $conf[73]?>;
         font-style:<? echo $conf[72]?>;
      }

     .send
      {
    	 font-family:<? echo $conf[84]?>;
         font-size:<? echo $conf[81]?>pt;
         color:<? echo $conf[80]?>;
         font-weight:<? echo $conf[83]?>;
         font-style:<? echo $conf[82]?>;
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
<tr><td><? if($conf[6]==1) echo "<div id=head>$content[0]</div>"; ?>
<?echo "<a class=send href=form.php?id=$_GET[id]>Оставить комментарий</a>"  ?>


<?php
if(count($file)> $topic_count_page)
    {
      //Постраничная навигаця
      echo "<table width=80%><tr><td>";

       if($index>1)echo "
       <a class='navig_passiv' href=comm.php?id=$_GET[id]&page=".(($index-1)*10)."&ind=".($index-1)." title=назад><<</a>";

       for($i=$index*10-9,$p=1; $i < $pages+1; $i++,$p++)
          {

            if($p>10 )
          	  {
          	  	echo "<a class='navig_passiv'  href=comm.php?id=$_GET[id]&page=".($i)."&ind=".($index+1)." title=далее>>></a>";
          	  	break;
          	  }
          	if($page==$i)
            echo "<a class='navig_activ' href=comm.php?id=$_GET[id]&page=$i&ind=$index>$i</a>";
            else
            echo "<a class='navig_passiv'href=comm.php?id=$_GET[id]&page=$i&ind=$index>$i</a>";
          }

     echo "</td></tr></table><br />";
    }

 for($x=$start,$y=0; $x<count($file); $x++,$y++)
         {
           if($y==$topic_count_page)break;
           $comm=file("admin/db/$_GET[id]/$file[$x]");

           $expl=explode("*",$comm[0]);



           $comm[1]=str_replace("[date]","<div id= cit_date>",$comm[1]);
           $comm[1]=str_replace("[/date]","</div>",$comm[1]);

           $comm[1]=str_replace("[cit]","<div id=cit>",$comm[1]);
           $comm[1]=str_replace("[/cit]","</div>",$comm[1]);
           $comm[1]=str_replace("[b]","<b>",$comm[1]);
           $comm[1]=str_replace("[/b]","</b>",$comm[1]);

           echo"<table width=$conf[23]px  id=blok CELLPADDING=5>
                    <tr><td align=$conf[56]>
                       <span id=date>$expl[0]</span>&nbsp;&nbsp;<span id=name>$expl[1]</span>&nbsp;&nbsp;
                       <span id=otv><a href=form.php?id=$_GET[id]&s=$file[$x]>ответить</a></span>

                     </td></tr>
               <tr><td>
                   $comm[1]
               </td></tr>
               </table><br />";
         }

if(count($file)> $topic_count_page)
    {
      //Постраничная навигаця
      echo "<table width=80%><tr><td>";

       if($index>1)echo "
       <a class='navig_passiv' href=comm.php?id=$_GET[id]&page=".(($index-1)*10)."&ind=".($index-1)." title=назад><<</a>";

       for($i=$index*10-9,$p=1; $i < $pages+1; $i++,$p++)
          {

            if($p>10 )
          	  {
          	  	echo "<a class='navig_passiv'  href=comm.php?id=$_GET[id]&page=".($i)."&ind=".($index+1)." title=далее>>></a>";
          	  	break;
          	  }
          	if($page==$i)
            echo "<a class='navig_activ' href=comm.php?id=$_GET[id]&page=$i&ind=$index>$i</a>";
            else
            echo "<a class='navig_passiv'href=comm.php?id=$_GET[id]&page=$i&ind=$index>$i</a>";
          }

     echo "</td></tr></table>";
    }
?>

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