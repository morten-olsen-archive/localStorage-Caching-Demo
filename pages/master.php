<html>
	<head>
		<? $styles->load('default', true); ?>
		<? $scripts->load('jquery', true); ?>
		<? $scripts->load('snowstorm', false); ?>
		<? $scripts->load('cacheloader', false); ?>
	</head>
	<body>
		<div id="wrapper">
			<? $html->load('menu', true); ?>
			<? include('pages/' . $page . '.php'); ?>
		</div>
		<? $scripts->load('cachestore', true); ?>
		<script>loadCache();</script>
	</body>
</html>