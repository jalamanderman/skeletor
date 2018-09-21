<% include Head %>

	<span class="hamburglar">
		<span></span>
		<span></span>
		<span></span>
	</span>

	<header class="page-header">
		<div class="inner">

			<a href="{$BaseURL}">
				<img src="/site/images/logo.png" alt="{$SiteConfig.Title} logo" />
			</a>

			<% include Menu %>

		</div>
	</header>

	$Layout

<% include Foot %>
