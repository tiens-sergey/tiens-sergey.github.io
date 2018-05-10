<?php
$catalog='comm';
$file_blok=array();
$file_blok=file("$catalog/admin/db/blok.txt");
$file_blok=array_reverse($file_blok);

$conf=file("$catalog/admin/conf/blok.txt");
for($i=0; $i<count($conf); $i++)
  {
  	$conf[$i]=trim($conf[$i]);
  	$expl=explode("*",$conf[$i]);
    $conf[$i]=$expl[1];
  }
?>

<style>
   #blok_blok
         {
            border-width: <?echo $conf[9]?>px;
            border-color: <?echo $conf[8]?>;
            border-style: <?echo $conf[10]?>;
            background-color:<? echo $conf[7]?>;
            padding:5px;
            width:<? echo $conf[6]?>;

         }
      #blok_head
       {
       	  font-family:<? echo $conf[5]?>;
          color:<? echo $conf[1]?>;
          font-size:<? echo $conf[2]?>pt;
          font-style:<? echo $conf[3]?>;
          font-weight:<? echo $conf[4]?>;
       }
     #blok_date
       {
       	  font-family:<? echo $conf[20]?>;
          color:<? echo $conf[16]?>;
          font-size:<? echo $conf[17]?>pt;
          font-style:<? echo $conf[18]?>;
          font-weight:<? echo $conf[19]?>;
       }
     #blok_name
       {
       	  font-family:<? echo $conf[25]?>;
          color:<? echo $conf[21]?>;
          font-size:<? echo $conf[22]?>pt;
          font-style:<? echo $conf[23]?>;
          font-weight:<? echo $conf[24]?>;
       }
    #blok_comm
       {
       	  font-family:<? echo $conf[30]?>;
          color:<? echo $conf[26]?>;
          font-size:<? echo $conf[27]?>pt;
          font-style:<? echo $conf[28]?>;
          font-weight:<? echo $conf[29]?>;
          text-align:justify;
       }
     #blok_comm a
       {
       	  font-family:<? echo $conf[30]?>;
          color:<? echo $conf[26]?>;
          font-size:<? echo $conf[27]?>pt;
          font-style:<? echo $conf[28]?>;
          font-weight:<? echo $conf[29]?>;
          text-align:justify;
          text-decoration:none;
       }

    #blok_tem
       {
       	  font-family:<? echo $conf[15]?>;
          color:<? echo $conf[11]?>;
          font-size:<? echo $conf[12]?>pt;
          font-style:<? echo $conf[13]?>;
          font-weight:<? echo $conf[14]?>;
       }
    #blok_tem a
       {
       	  font-family:<? echo $conf[15]?>;
          color:<? echo $conf[11]?>;
          font-size:<? echo $conf[12]?>pt;
          font-style:<? echo $conf[13]?>;
          font-weight:<? echo $conf[14]?>;
       }
</style>
<table id=blok_blok>
<?php
if($conf[31]==1)echo "<tr><td id=blok_head>$conf[0]</td></tr>";
 echo "<tr><td>";
 for($n=0;$n<count($file_blok);$n++)
  {    if($n==$conf[35])break;
    $file_blok[$n]=trim($file_blok[$n]);
    $expl=explode("*",$file_blok[$n]);
    if(!file_exists("$catalog/admin/db/$expl[0]/$expl[1]"))continue;
    $file=file("$catalog/admin/db/$expl[0]/$expl[1]");
    $index=file("$catalog/admin/db/$expl[0]/index.txt");
    $index=$index[0];
    $file[0]=trim($file[0]);

    //Вырез цитат
       $pos_cit=strpos($file[1],"[/cit]");
       if($pos_cit!==false)
         {           $pos_cit+=6;
           $file[1]=substr($file[1],$pos_cit);
         }



    $file[1]=substr($file[1],0,$conf[36]);
    $file[1]=str_replace("<br>","",$file[1]);


    $expl1=explode("*",$file[0]);
    echo "<table width=100%>";
    if($conf[32]==1)echo "<tr><td id=blok_tem><a href=http://$_SERVER[SERVER_NAME]/$catalog/comm.php?id=$expl[0]>$index</a></td></tr>";
    if($conf[33]==1 || $conf[34]==1)echo "<tr><td>";
    if($conf[33]==1) echo "<span id=blok_date>$expl1[0]</span>&nbsp;&nbsp;";
    if($conf[34]==1) echo "<span id=blok_name>$expl1[1]</span>";
    if($conf[33]==1 || $conf[34]==1)echo "</td></tr>";

    if($conf[32]==1) echo "<tr><td id=blok_comm>$file[1]...</td></tr>";
    else echo "<tr><td id=blok_comm><a href=http://$_SERVER[SERVER_NAME]/$catalog/comm.php?id=$expl[0]>$file[1]...</a></td></tr>";

    echo "</table>";
  }
?>
</td></tr></table>