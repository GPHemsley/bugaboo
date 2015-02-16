<?php

class HttpRest
{
	public $request;

	public function __construct( $url, $options = array() )
	{
		$this->request = MWHttpRequest::factory( $url, $options );

		$this->request->setHeader( 'Accept', 'application/json' );

		return $this->request;
	}

	public static function request( $url, $options )
	{
		$options['method'] = ( isset( $options['method'] ) ) ? strtoupper( $options['method'] ) : 'GET';

		$request = new self( $url, $options );
		$request = $request->request;
		$status = $request->execute();

		$content = ( $status->isOK() ) ? $request->getContent() : false;

		return $content;
	}

	public static function get( $url, $options = array() )
	{
		$options['method'] = 'GET';

		return self::request( $url, $options );
	}

	public static function post( $url, $postData, $options = array() )
	{
		$options['method'] = 'POST';
		$options['postData'] = $postData;

		return self::request( $url, $options );
	}
}

