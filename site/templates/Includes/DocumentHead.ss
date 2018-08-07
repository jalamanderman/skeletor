<!doctype html>
<html lang="en" class="<% if URLSegment == 'Security' %>security-page<% end_if %>">
<head>

	<% base_tag %>
	<meta charset="utf-8">
	<title>$MenuTitle.XML | $SiteConfig.Title</title>
	
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scaleable=no" name="viewport" />
	
	<meta property="og:type" content="website">
	<meta property="og:url" content="{$BaseHref}{$Link}?1" />
	<meta property="og:title" content="$Title" />
	<% if MetaDescription %>
	<meta property="og:description" content="$MetaDescription" />
	<% end_if %>
    
	<% if OgImage %>
		<meta property="og:image" content="$OgImage.AbsoluteURL" />
    <% else %>
		<meta property="og:image" content="{$absoluteBaseHref}site/images/logo.png" />
	<% end_if %>
	
	<link rel="shortcut icon" type="image/ico" href="/favicon.ico" />
	<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
	<link rel="shortcut-icon" href="/favicon.ico" />
	
	<% include GoogleAnalytics %>
	
</head>
<body class="$ClassName">

<span class="hamburglar">
	<span></span>
	<span></span>
	<span></span>
</span>
