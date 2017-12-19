<nav class="mainnav cf">
	<ul class="menu">
		<% loop Menu(1) %>
			<li class="menu-item $LinkingMode level-1 pos-$Pos $FirstLast<% if Children %> togglable<% end_if %>">
				<a class="$LinkingMode" href="$Link" accesskey="$Pos">
					$MenuTitle.XML
				</a>
				<% if Children %>
					<span class="fa fa-caret-down down toggle-button"></span>
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