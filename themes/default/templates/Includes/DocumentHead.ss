<!doctype html>
<html lang="en" class="<% if URLSegment == 'Security' %>login-page<% end_if %>">
<head>

	<% base_tag %>
	<meta charset="utf-8">
	<title>$MenuTitle.XML - $SiteConfig.Title</title>
	
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scaleable=no" name="viewport" />
	
	<link rel="shortcut icon" type="image/ico" href="/{$ThemeDir}/favicon.ico" />
	<link rel="shortcut icon" type="image/x-icon" href="/{$ThemeDir}/favicon.ico" />
	<link rel="shortcut-icon" href="/{$ThemeDir}/favicon.ico" />
	
	<% include GoogleAnalytics %>
	
</head>
<body class="$ClassName">