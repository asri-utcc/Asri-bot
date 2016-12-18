<?php
$file="https://dry-sea-41725.herokuapp.com/mon.txt";
$zeth = file_get_contents($file);
$linecount = substr_count($zeth,',');
echo $linecount;
?>