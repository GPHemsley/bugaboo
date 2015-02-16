<?php
# vim: set ts=4 sw=4 sts=4 noet

$wgExtensionCredits['parserhook'][] = array(
	'path' => __FILE__,
	'name' => 'Bugaboo',
	'description' => 'Query and display bugs from a variety of bug trackers',
	'version' => '1.0',
	'author' => array( 'Gordon P. Hemsley', 'Christie Koehler' ),
	'url' => 'https://github.com/MozillaWiki/bugaboo',
	'license-name' => 'MPL 2.0',
);

$includesDirectory = __DIR__ . '/includes';

$wgAutoloadClasses['ProviderParser'] = $includesDirectory . '/ProviderParser.php';

$parserDirectory = $includesDirectory . '/parser';

$wgAutoloadClasses['BugabooParser'] = $parserDirectory . '/BugabooParser.php';
$wgAutoloadClasses['BugzillaParser'] = $parserDirectory . '/BugzillaParser.php';
// $wgAutoloadClasses['GitHubParser'] = $parserDirectory . '/GitHubParser.php';

$wgHooks['ParserFirstCallInit'][] = 'BugabooParser::setHook';
$wgHooks['ParserFirstCallInit'][] = 'BugzillaParser::setHook';

