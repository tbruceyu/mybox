<?php
class Box_base {
	
	public $client_id;
	public $client_secret;
	public $token;

	public function __construct($args) {
		$this->client_id = $args['client_id'];
		$this->client_secret = $args['client_secret'];
	}
	public function __destruct() {
		
	}

}