
<span class="menu-toggle">
	<span></span>
	<span></span>
	<span></span>
</span>

<nav class="menu">
	<ul class="inner">
		<% loop Menu(1) %>
			<% include MenuItem %>
		<% end_loop %>
	</ul>
</nav>
