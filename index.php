<?php
require_once "php/markdown/Markdown.inc.php";

use Michelf\Markdown;

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

function markdown($fn) {
	return Markdown::defaultTransform(file_get_contents($fn));
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
		<script>
		hljs.initHighlightingOnLoad();
		</script>
	</head>
	<body>
		<div class="main">
			<h1>jsonchess.org</h1>
			<div class="nav">
				<a href="/">Home</a>
				&nbsp;&nbsp;
				<a href="/core">Core</a>
				&nbsp;&nbsp;
				<a href="/modules">Modules</a>
			</div>
			<div class="page">
				<? if($sidebarLinks): ?>
					<div class="sidebar">
						<?= markdown($sidebarFile) ?>
					</div>
				<? endif; ?>
				<div class="content">
					<? if($page): ?>
						<?= markdown($page) ?>
					<? else: ?>
						Page not found.
					<? endif; ?>
				</div>
			</div>
		</div>
	</body>
</html>