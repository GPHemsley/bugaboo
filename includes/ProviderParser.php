<?php

interface ProviderParser
{
	public static function setHook( Parser $parser );
	public static function parseTag( $input, array $args, Parser $parser, PPFrame $frame );
}

/* vim:set ts=4 sw=4 sts=4 noexpandtab: */
