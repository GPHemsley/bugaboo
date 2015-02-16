<?php

interface ProviderParser
{
	public static function setHook( Parser $parser );
	public static function parseTag( $input, array $args, Parser $parser, PPFrame $frame );
}

