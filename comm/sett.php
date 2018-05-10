<?php
$catalog='comm';
 $file=array();
$d=opendir("$catalog/admin/db");
            while(($e=readdir($d))!=false)
           {
             if($e =="." || $e ==".." || $e==".htaccess" || $e=="bl" || $e=="blok.txt") continue;
             $file[]=$e;
           }
closedir($d);
rsort($file);
$count=array();
for($n=0;$n<count($file);$n++)
  {     $file1=array();
     $d=opendir("$catalog/admin/db/$file[$n]");
     $name=file("$catalog/admin/db/$file[$n]/index.txt");
     $name=trim($name[0]);
     while(($e=readdir($d))!=false)
       {
         if($e =="." || $e ==".." || $e==".htaccess" || $e=="index.txt" ) continue;
         $file1[]=$e;

       }
     closedir($d);
     $count[$name]=count($file1);
  }
?>
