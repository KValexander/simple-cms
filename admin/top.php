<head><meta name="viewport" content="width=device-width, initial-scale=1.0"></head>
<style>
/* Body  */
body {
	margin-top: 20px;
}
/* Console */
div.console {
	box-sizing: border-box;
	font-family: Arial;
	width: 100%;
	position: fixed;
	background-color: black;
	height: 20px;
	top: 0;
	left: 0;
	display: flex;
	align-items: center;
	color: white;
	z-index: 999;
}

div.console * {
	box-sizing: border-box;
}

div.console > div.content {
	width: 100%;
	margin: 0 auto;
	padding: 0 20px;
	max-width: 1200px;
	display: flex;
	font-size: 9pt;
	justify-content: space-between;
	align-items: center;
}

div.console > div.content > * {
	width: 100%;
}
div.console > div.content a {
	transition: .2s;
	color: #f3f3f3;
	text-decoration: none;
	cursor: pointer;
}

div.console > div.content a:hover {
	text-decoration: underline;
}

div.console > div.content p {
	margin: 0;
	padding: 0;
}
</style>
<div class="console">
	<div class="content">
		<p>
			<a href="/admin">Консоль</a> |
			<a href="/">Главная страница</a> |
			<a href="/admin/controllers/logout.php">Выйти</a>
		</p>
	</div>
</div>