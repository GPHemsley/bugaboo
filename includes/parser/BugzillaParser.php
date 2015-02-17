<?php

class BugzillaParser implements ProviderParser
{
	public static function setHook( Parser $parser )
	{
		$parser->setHook('bugzilla', __CLASS__ . '::parseTag');

		return true;
	}

	public static function parseTag( $input, array $args, Parser $parser, PPFrame $frame )
	{
		$jsonQuery = FormatJson::decode( $input );

		if ( !is_null( $jsonQuery ) ) {
			$url = 'https://bugzilla.mozilla.org/bzapi/bug?' . http_build_query( $jsonQuery );

			$jsonObject = FormatJson::decode( HttpRest::get( $url ) );

			$output = '[[ Query returned ' . count($jsonObject->bugs) . ' bugs ]]';
		} else {
			$output = 'BAD JSON!';
		}

		return htmlentities( $output );
	}
}

/* vim:set ts=4 sw=4 sts=4 noexpandtab: */
