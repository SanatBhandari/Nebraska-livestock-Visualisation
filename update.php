<html>
<head>
<link rel="stylesheet" href="style.css">
<style>
body {
	padding: 1em;
	height: 95%;
}
</style>
</head>

<body>
<input id="updateButton" type="button" value="Refresh Page" class="btn btn-primary center" onclick="location.reload();" />
<a href="http://cse.unl.edu/~dshchur/" type="button" value="Go to page" class="btn btn-primary center"/>
<div>
<?php
	shell_exec('cd /home/ugrad/dshchur/public_html/');
	$initOut = shell_exec('git init');
	$pullOut = shell_exec('git pull 2>&1');
?>
<h3 id="initOut"><?php echo $initOut; ?></h3><br>
<h3 id="pullOut"><?php echo $pullOut; ?></h3><br>
</div>

</body>
</html>