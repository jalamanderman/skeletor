
<main class="typography">

	<h1>$Title</h1>
	$Content
	$Form

</main>

<aside class="typography">

	<h2>Side bar</h2>

	<nav>
		<% loop Menu(1) %>
			<a href="{$Link}">{$MenuTitle.XML}</a>
		<% end_loop %>
	</nav>

</aside>