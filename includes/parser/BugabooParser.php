<?php

class BugabooParser implements ProviderParser
{
	public static function setHook( Parser $parser )
	{
		$parser->setHook('bugaboo', __CLASS__ . '::parseTag');

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
