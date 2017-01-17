<nav class="mainnav cf">

	<ul class="menu">
		<% loop Menu(1) %>
			
			<li class="level-1 pos-$Pos $FirstLast">
			
				<a href="$Link" class="$LinkingMode" accesskey="$Pos">$MenuTitle.XML</a>
				
				<% if Children %>
					
					<ul class="menu secondary">
						<% loop Children %>
							
							<li class="level-2 pos-$Pos cf $FirstLast">
								<a href="$Link" class="$LinkingMode $FirstLast cf">$MenuTitle.XML</a>
							</li>
							
						<% end_loop %>
					</ul>
					
				<% end_if %>
				
			</li>
			
		<% end_loop %>		
	</ul>
	
</nav>	