<section class="page cf">

	<div class="inner">
	
		<main class="typography">

			<h1>$Title</h1>
			$Content
			$Form

			<section class="table">

				<div class="row heading">
					<div class="col">
						<p>Yeah</p>
					</div>
					<div class="col">
						<p>Nah</p>
					</div>
					<div class="col">
						<p>Maybe?</p>
					</div>
					<div class="col">
						<p>Not in a million years</p>
					</div>
				</div>

				<div class="row">
					<div class="col">
						<p>Minim veniam quis nostrud</p>
					</div>
					<div class="col">
						<p>Nonummy nibh euismod tincidunt ut laoreet</p>
					</div>
					<div class="col">
						<p>Ex ea commodo consequat</p>
					</div>
					<div class="col">
						<p>Consectetuer adipiscing elit</p>
					</div>
				</div>

				<div class="row">
					<div class="col">
						<p>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
					</div>
					<div class="col">
						<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Nisl ut aliquip ex ea commodo consequat.</p>
					</div>
					<div class="col">
						<p>Lorem ipsum dolor sit amet, consectetuer. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
					</div>
					<div class="col">
						<p>Consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam.</p>
					</div>
				</div>

			</section>

			<section class="grid">

				<div class="item left">
					<h3>Grid item 1</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vel congue ipsum. Mauris eget lectus erat. Aliquam ac efficitur turpis.</p>
				</div>

				<div class="item left">
					<h3>Grid item 2</h3>
					<p>Nunc enim nunc, consectetur et efficitur eget, consectetur eget purus. Cras et ex ut orci congue tincidunt. In hac habitasse platea dictumst. Integer sollicitudin ultricies auctor.</p>
				</div>

				<div class="item left">
					<h3>Grid item 3</h3>
					<p>Nulla ante ligula, pellentesque egestas libero non, efficitur consectetur nibh. Nam a viverra arcu, a blandit eros.</p>
				</div>

				<div class="item left">
					<h3>Grid item 4</h3>
					<p>Duis vulputate scelerisque tempus. Fusce at ornare lorem. Ut sit amet urna turpis. Maecenas consequat nunc justo, quis varius odio viverra vel.</p>
				</div>

				<div class="item left">
					<h3>Grid item 5</h3>
					<p>Morbi maximus elit nec diam lobortis convallis. Etiam odio turpis, fermentum sit amet ex non, facilisis lobortis libero.</p>
				</div>

			</section>

		</main>

		<aside class="typography">

			<h2>Side bar</h2>

			<nav>
				<% loop Menu(1) %>
					<a href="{$Link}">{$MenuTitle.XML}</a>
				<% end_loop %>
			</nav>

		</aside>

	</div>

</section>