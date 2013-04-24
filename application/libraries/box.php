<?php
class Box {
	public $ch;
	public $client_id;
	public $client_secret;
	public $uri;
	public $token;
	public $options;
	public $redirect_uri;
	public function __construct($args) {
		$this->client_id = $args['client_id'];
		$this->client_secret = $args['client_secret'];
		$this->uri = "https://www.box.com/services/tbruceyu";
		$this->options =  array(
			CURLOPT_URL=>"",
			CURLOPT_RETURNTRANSFER=>TRUE,
			CURLOPT_SSL_VERIFYPEER=>FALSE,
			CURLOPT_USERAGENT=>'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.1 Safari/537.11',
//			CURLOPT_POST=>1,
//			CURLOPT_POSTFIELDS =>array()
		);
		$this->redirect_uri = "https://www.box.com/services/tbruceyu";
		$this->ch = curl_init();
	}
	public function __destruct() {
		curl_close($this->ch);
	}
	private function _curl_exec() {
		
		curl_setopt_array($this->ch, $this->options);
		$result = curl_exec($this->ch);
		curl_errno($this->ch);
		echo curl_error($this->ch);
		return $result;
	}
	private function _init_login_postdata($page_str) {
		echo $page_str;
	}
	public function get_code() {
		$this->uri = "https://www.box.com/api/oauth2/authorize";
		
		$response_type = "code";
		$req_uri = $this->uri."?response_type=code"."&client_id=".$this->client_id."&state=authenticated&redirect_uri=".$this->redirect_uri;
		$this->options[CURLOPT_URL] = $req_uri;
		$login_page_str = $this->_curl_exec();
		$post_data = $this->_init_login_postdata($login_page_str);
	}
}
