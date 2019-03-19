<!doctype html>
<html lang="en">
<head>

	<% base_tag %>

	<meta charset="utf-8">
	<title>$MenuTitle.XML | $SiteConfig.Title</title>

	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />

	<meta property="og:type" content="website">
	<meta property="og:url" content="{$BaseHref}{$Link}?1" />
	<meta property="og:title" content="$Title" />

	<% if MetaDescription %>
		<meta property="og:description" content="$MetaDescription" />
	<% end_if %>

	<% if OgImage %>
		<meta property="og:image" content="{$absoluteBaseHref}$OgImage.AbsoluteURL" />
	<% end_if %>

	<link rel="shortcut icon" type="image/ico" href="/favicon.ico" />
	<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
	<link rel="shortcut-icon" href="/favicon.ico" />

	<% include GoogleAnalytics %>

</head>
<body class="<% if URLSegment == 'Security' %>Security<% else %>$ClassName<% end_if %>">
