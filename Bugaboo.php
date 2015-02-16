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

$wgAutoloadClasses['Bugaboo'] = __DIR__ . '/Bugaboo.body.php';

$wgHooks['ParserFirstCallInit'][] = 'Bugaboo::setHook';

