<?php
$file="https://dry-sea-41725.herokuapp.com/mon.txt";
$linecount = 0;
$handle = fopen($file, "r");
while(!feof($handle)){
  $line = fgets($handle);
  $linecount++;
}

fclose($handle);

echo $linecount;
?>