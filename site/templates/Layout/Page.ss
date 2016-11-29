
<main class="typography">

	<h1>$Title</h1>
	$Content
	$Form

	<section class="demo-cols">
		<div class="row">
			<div class="col">Yeah</div>
			<div class="col">Nah</div>
			<div class="col">Yes</div>
			<div class="col">Ok</div>
		</div>
	</section>

</main>

<aside class="typography">

	<h2>Side bar</h2>

	<nav>
		<% loop Menu(2) %>
			<a href="{$Link}">{$MenuTitle.XML}</a>
		<% end_loop %>
	</nav>

</aside>