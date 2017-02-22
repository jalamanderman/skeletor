<html>
<body style="background: #EEEEEE;">
	<div style="font-size: 13px; font-family: Arial, Helvetica, sans-serif;">
		<div style="width: 500px; margin: 0 auto; background: #FFFFFF; border-top: 20px solid #EEEEEE; border-bottom: 20px solid #EEEEEE;">
		
			<div style="border-top: 30px solid #FFFFFF; text-align: center;">
				<a href="{$AbsoluteBaseURL}" style="border: 0; text-decoration: none;">
					<img src="{$AbsoluteBaseURL}site/images/email-template-logo.png" title="Logo" />
				</a>
			</div>
			
			<% loop TemplateData %>
				<div style="border: 30px solid #FFFFFF;">
					<div style="font-size: 18px; font-weight: bold; border-bottom: 20px solid #FFFFFF; color: #555555;">$Title</div>
					
					<div style="border-bottom: 20px solid #FFFFFF;">$Description</div>

					<table cellpadding="10" cellspacing="0" border="0" bgcolor="#ffffff" style="font-size: 13px; font-family: Arial, Helvetica, sans-serif;">
						<% loop Fields %>
							<tr>
								<td style="vertical-align: top;"><strong>$Key</strong></td>
								<td>$Value</td>
							</tr>
						<% end_loop %>
					</table>
				</div>
			<% end_loop %>
			
		</div>

		<% loop TemplateData %>
			<div style="width: 500px; margin: 0 auto; color: #999999; border-bottom: 20px solid #EEEEEE; text-align: center;">
				Sent from <% if SourceLink %>$SourceLink<% else %>{$Top.AbsoluteBaseURL}{$Top.Link}<% end_if %>
			</div>
		<% end_loop %>
		
	</div>
</body>
</html>