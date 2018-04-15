<?php

shell_exec('cd /home/ugrad/dshchur/public_html/');
$output = shell_exec('git init');
echo $output;
echo "\r\n";
$output = shell_exec('git pull 2>&1');
echo $output;

?>