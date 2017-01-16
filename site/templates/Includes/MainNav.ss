<nav class="mainnav cf">

	<ul class="menu">
		<% loop Menu(1) %>
			
			<li class="$LinkingMode level-1 pos-$Pos">
			
				<a href="$Link" accesskey="$Pos">$MenuTitle.XML</a>
				
				<% if Children %>
					
					<ul class="menu secondary">
						<% loop Children %>
							
							<li class="$LinkingMode level-2 pos-$Pos cf">
								<a href="$Link" class="$FirstLast cf">$MenuTitle.XML</a>
							</li>
							
						<% end_loop %>
					</ul>
					
				<% end_if %>
				
			</li>
			
		<% end_loop %>		
	</ul>
	
</nav>	