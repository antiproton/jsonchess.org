<?php
$page = null;
$sidebarLinks = null;
$path = "." . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

if($path === "./") {
	$path = "./home";
}

if(is_dir($path) && file_exists("$path/main.md")) {
	$page = "$path/main.md";
}

else if(file_exists("$path.md")) {
	$page = "$path.md";
}

if($page) {
	$sidebarFile = pathinfo($page)["dirname"] . "/sidebar_links.md";
	
	if(file_exists($sidebarFile)) {
		$sidebarLinks = $sidebarFile;
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>jsonchess</title>
		<link rel="stylesheet" type="text/css" href="main.css">
	</head>
	<body>
		<div class="main">
			<h1>jsonchess</h1>
			<div class="nav">
				<a href="/">Home</a>
				<a href="/core">Core</a>
				<a href="/modules">Modules</a>
			</div>
			<div class="page">
				<? if($sidebarLinks): ?>
					<div class="sidebar">
						<? include "$sidebarFile"; ?>
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