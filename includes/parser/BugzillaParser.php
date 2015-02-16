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
		$output = $input . "\n";

		foreach ( $args as $attr => $val ) {
			$output .= "$attr => $val\n";
		}

		return str_replace( "\n", "<br />", htmlentities( $output ) );
	}
}
