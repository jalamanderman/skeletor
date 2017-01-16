<nav class="mainnav cf" id="navigation">

	<ul>
		<% loop Menu(1) %>
			
			<li class="$LinkingMode toplvl pos-$Pos">
			
				<a href="$Link" accesskey="$Pos">$MenuTitle.XML</a>
				
				<% if Children %>
					
					<ul class="secondary">
						<% loop Children %>
							
							<li class="$LinkingMode lvl2 pos-$Pos cf">
								<a href="$Link" class="$FirstLast cf">$MenuTitle.XML</a>
							</li>
							
						<% end_loop %>
					</ul>
					
				<% end_if %>
				
			</li>
			
		<% end_loop %>		
	</ul>
	
</nav>	