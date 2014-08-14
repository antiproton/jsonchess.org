<?php
$page = null;
$sidebarLinks = null;
$path = "." . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

if($path === "./") {
	$path = "./home";
}

if(is_dir($path) && file_exists("$path/main.php")) {
	$page = "$path/main.php";
}

else if(file_exists("$path.php")) {
	$page = "$path.php";
}

if($page) {
	$sidebarFile = pathinfo($page)["dirname"] . "/sidebar_links.php";
	
	if(file_exists($sidebarFile)) {
		$sidebarLinks = $sidebarFile;
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>jsonchess</title>
		<link rel="stylesheet" type="text/css" href="/main.css">
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400,700">
		<link rel="stylesheet" type="text/css" href="/js/highlight/styles/tomorrow.css">
		<script type="text/javascript" src="/js/highlight/highlight.js"></script>
		<script type="text/javascript" src="/js/cleanupCodeTags.js"></script>
		<script>
		window.addEventListener("load", function() {
			cleanupCodeTags();
			hljs.initHighlighting();
		});
		</script>
	</head>
	<body>
		<div class="main">
			<h1>jsonchess.org</h1>
			<div class="nav">
				<a href="/">Home</a>
				&nbsp;&nbsp;
				<a href="/intro">Introduction</a>
				&nbsp;&nbsp;
				<a href="/base">Base</a>
				&nbsp;&nbsp;
				<a href="/optional-modules">Optional modules</a>
			</div>
			<div class="page">
				<? if($sidebarLinks): ?>
					<div class="sidebar">
						<? include $sidebarFile; ?>
					</div>
				<? endif; ?>
				<div class="content">
					<? if($page): ?>
						<? include $page; ?>
					<? else: ?>
						Page not found.
					<? endif; ?>
				</div>
			</div>
		</div>
	</body>
</html>