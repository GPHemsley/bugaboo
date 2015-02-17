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
		$jsonQuery = self::buildQuery( $input );

		$jsonResult = self::sendRequest( $jsonQuery );

		return self::formatResult( $jsonResult );
	}

	protected static function decodeInput( $input )
	{
		return FormatJson::decode( $input );
	}

	protected static function buildQuery( $input )
	{
		$decodedInput = self::decodeInput( $input );

		if ( is_null( $decodedInput ) ) {
			return false;
		}

		return $decodedInput;
	}

	protected static function sendRequest( $jsonQuery )
	{
		if ( $jsonQuery === false ) {
			return false;
		}

		$url = 'https://bugzilla.mozilla.org/bzapi/bug?' . http_build_query( $jsonQuery );

		$jsonResult = self::buildResult( HttpRest::get( $url ) );

		return $jsonResult;
	}

	protected static function buildResult( $request )
	{
		if ( !$request ) {
			return false;
		}

		return FormatJson::decode( $request );
	}

	protected static function formatResult( $jsonResult )
	{
		if ( !$jsonResult ) {
			return 'BAD JSON!';
		}

		$output = '[[ Query returned ' . count( $jsonResult->bugs ) . ' bugs ]]';

		return htmlentities( $output );
	}
}

/* vim:set ts=4 sw=4 sts=4 noexpandtab: */
