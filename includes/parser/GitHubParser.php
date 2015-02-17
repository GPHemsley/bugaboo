<?php

class GitHubParser implements ProviderParser
{
	public static function setHook( Parser $parser)
	{
		$parser->setHook('github', __CLASS__ . '::parseTag');

		return true;
	}

	public static function parseTag( $input, array $args, Parser $parser, PPFrame $frame )
	{
		$output = '';
		$matches = preg_match('/https:\/\/github.com\/([^\/]+)\/([^\/]+)\/issues(\?.+)?/', $args['src'], $match);
		$output .= 'matches count: ' . $matches;
		foreach ($match as $k => $v ) {
			$output .= '<br>'.$k.'=>'.$v;
		}
		//$username = $match[1];
		//$repo = $match[2];
		//$query = $match[3];
		//
		//GET /repos/:owner/:repo/issues
		//https://github.com/mozilla/mediawiki-bugzilla/issues/64
		//https://api.github.com/repos/mozilla/mediawiki-bugzilla/issues?state=open
		//$url = 'https://api.github.com/repos/mozilla/mediawiki-bugzilla/issues';
		$url = 'https://api.github.com/repos/'.$args['owner'].'/'.$args['project'].'/issues';
		// other ways to do this:
		// take a src arg that's a full github url and parse it
		// e.g https://github.com/aaronpk/MediaWiki-Github-Issues/blob/master/issues.php#L29
		$jsonQuery = FormatJson::decode( $input );
		if ( !is_null( $jsonQuery ) ) {
			$url .= '?' . http_build_query( $jsonQuery );
		}
		$jsonObject = FormatJson::decode( HttpRest::get( $url ) );

		$output .= '<br>[[ Query returned ' . count($jsonObject) . ']]<br>';
		if ( !is_null($args) ) {
			foreach ($args as $key => $value) {
				$output .= $key . ' = ' . $value . '<br>';
			}
		}
		return $output;
		//return htmlentities( $output );
	}
}

/* vim:set ts=4 sw=4 sts=4 noexpandtab: */
