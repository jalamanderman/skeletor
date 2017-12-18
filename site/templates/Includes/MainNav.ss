<nav class="mainnav cf">
	<ul class="menu">
		<% loop Menu(1) %>
			<li class="menu-item level-1 pos-$Pos $FirstLast<% if Children %> togglable<% end_if %>">
				<a class="$LinkingMode<% if Children %> toggle-button<% end_if %>" href="$Link" accesskey="$Pos">
					$MenuTitle.XML
					<% if Children %><span class="fa fa-caret-down"></span><% end_if %>
				</a>
				<% if Children %>
	 				<ul class="menu level-2 togglable-content">
						<% loop Children %>	
							<li class="pos-$Pos pos-$Pos cf $FirstLast">
								<a class="$LinkingMode $FirstLast cf" href="$Link">$MenuTitle.XML</a>
							</li>
						<% end_loop %>	
					</ul>
				<% end_if %>
			</li>
		<% end_loop %>
	</ul>
</nav>