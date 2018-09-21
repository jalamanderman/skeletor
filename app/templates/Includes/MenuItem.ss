<li class="menu-item $LinkingMode $FirstLast<% if Children %> has-children <% if $LinkingMode == 'section' || $LinkingMode == 'current' %>expanded<% end_if %><% end_if %>">

	<a class="menu-item-link" href="$Link" accesskey="$Pos">
		$MenuTitle.XML
	</a>

	<% if Children %>

		<i class="fa fa-caret-right menu-submenu-toggle"></i>

		<ul class="menu-item-submenu menu-submenu">
			<% loop Children %>
				<% include MenuItem %>
			<% end_loop %>
		</ul>

	<% end_if %>

</li>
