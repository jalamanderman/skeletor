<html>
<body style="background: #EEEEEE;">
	<div style="font-size: 13px; font-family: Arial, Helvetica, sans-serif;">
		<div style="width: 500px; margin: 0 auto; background: #FFFFFF; border-top: 20px solid #EEEEEE; border-bottom: 20px solid #EEEEEE;">
		
			<div style="border-top: 30px solid #FFFFFF; text-align: center;">
				<a href="{$AbsoluteBaseURL}" style="border: 0; text-decoration: none;">
					<img src="{$AbsoluteBaseURL}site/images/email-template-logo.png" title="Logo" />
				</a>
			</div>
			
				<div style="border: 30px solid #FFFFFF;">
					
					<div style="border-bottom: 20px solid #FFFFFF;">$Body</div>

					<% if HideFormData %>
					<% else %>

						<table cellpadding="10" cellspacing="0" border="0" bgcolor="#ffffff" style="font-size: 13px; font-family: Arial, Helvetica, sans-serif;">
							<% loop Fields %>
								<tr>
									<td style="vertical-align: top;"><strong><% if Title %>$Title<% else %>$Name<% end_if %></strong></td>
									<td>$FormattedValue</td>
								</tr>
							<% end_loop %>
						</table>

					<% end_if %>
				</div>
			
		</div>

		<div style="width: 500px; margin: 0 auto; color: #999999; border-bottom: 20px solid #EEEEEE; text-align: center;">
			Sent from {$AbsoluteBaseURL}{$Link}
		</div>
		
	</div>
</body>
</html>
