<?php
require_once("box_base.php");
class Box extends Box_base{
	public $ch;
	public $request_url;
	public $redirect_url;
	public $options;
	public $code;
	
	public function __construct($args) {
		parent::__construct($args);
		$this->redirect_url = "https://www.box.com/services/tbruceyu";
		$this->options =  array(
			CURLOPT_URL=>"",
			CURLOPT_RETURNTRANSFER=>TRUE,
			CURLOPT_SSL_VERIFYPEER=>FALSE,
			CURLOPT_USERAGENT=>'Mozilla/5.0 (Windows NT 6.1; rv:11.0) Gecko/20100101 Firefox/11.0',
			CURLOPT_HEADER => array('Host'=>'www.box.com')
		);
		$this->ch = curl_init();
	}
	public function __destruct() {
		curl_close($this->ch);
	}
	private function _curl_exec() {
		$this->options[CURLOPT_URL] = $this->request_url;
		curl_setopt_array($this->ch, $this->options);
		$result = curl_exec($this->ch);
		curl_errno($this->ch);
		echo curl_error($this->ch);
		return $result;
	}
	
	private function _gen_login_postdata($page_str) {
		$array = array();
		preg_match("/request_token = '(.*)'/", $page_str, $array);
		$post_request_token = $array[1];
		$this->token = $post_request_token;
		preg_match("/www.box.com\/(.*)/", $this->request_url, $array);
		$post_redirect_url = $array[1];
		$post_data = array (
			'_redirect_url'=>$post_redirect_url,
			'login' => 't_bruce_yu@qq.com',
			'password' => 'yu19841022',
			'_pw_sql' => '',
			'remember_login' => 'on',
			'__login' => 1,
			'dologin' => 1,
			'client_id' => $this->client_id,
			'response_type' => 'code',
			'redirect_uri' => $this->redirect_url,
			'redirect_url' => $post_redirect_url,
			'scope' => '["root_readwrite"]',
			'state' => 'authenticated',
			'reg_step' => '',
			'submit1' => 1,
			'folder' => '',
			'skip_framework_login' => 1,
			'login_or_register_mode' => 'login',
			'new_login_or_register_mode' => '',
			'request_token' => $post_request_token
		);

		return $post_data;
	}
	
	private function _gen_allow_access_postdata($page_str) {
		$array = array();
		preg_match('/<input type="hidden" name="ic" value="(.*)"/', $page_str, $array);
		$post_ic = $array[1];
		preg_match("/request_token = '(.*)'/", $page_str, $array);
		$post_request_token = $array[1];
		$this->token = $post_request_token;
		
		$post_data = array (
			'client_id' => $this->client_id,
			'response_type' => 'code',
			'redirect_uri' => $this->redirect_url,
			'scope' => '["root_readwrite"]',
			'doconsent' => 'doconsent',
			'ic' => $post_ic,
			'state' => 'authenticated',
			'consent_accept' => 'Accept',
			'request_token' => $post_request_token
		);
		
		return $post_data;
	}
	public function trim_http_header($http_content) {
		$header_size = curl_getinfo($this->ch, CURLINFO_HEADER_SIZE);
		$result=substr($http_content,$header_size);

		return $result;
	}
	public function get_code() {
		$this->request_url = "https://www.box.com/api/oauth2/authorize";
		$this->request_url = $this->request_url."?response_type=code"."&client_id=".$this->client_id."&state=authenticated&redirect_uri=".$this->redirect_url;

		$cookie_file=tempnam('./temp','cookie.txt');
		$this->options[CURLOPT_COOKIEFILE] = $cookie_file;
		$login_page_str = $this->_curl_exec();
		$post_data = $this->_gen_login_postdata($login_page_str);
		
		
		$this->options[CURLOPT_COOKIEJAR] = $cookie_file;
		$this->options[CURLOPT_COOKIEFILE] = $cookie_file;
		$this->options[CURLOPT_POST] = 1;
		$this->options[CURLOPT_POSTFIELDS] = $post_data;
		$temp = $this->_curl_exec();

		$post_data = $this->_gen_allow_access_postdata($temp);
		$this->options[CURLOPT_POSTFIELDS] = $post_data;
		$this->options[CURLOPT_REFERER] = $this->request_url;
		$temp = $this->_curl_exec();
		$array = array();
		preg_match("/code=(.*)/", $temp, $array);
		$this->code = trim($array[1]);
		$post_data = array(
			"grant_type" => "authorization_code",
			"code" => $this->code,
			"client_id" => "41a8gnjftgmms40s8sapcyz0iftl78z9",
			"client_secret" => "fAeduj4Yfty4dUPaopDcfyfhIHi8SqU3"
		);
		$this->request_url = "https://www.box.com/api/oauth2/token";
		$this->options[CURLOPT_POSTFIELDS] = $post_data;
		$temp = $this->_curl_exec();
		echo $this->trim_http_header($temp);
	}
}
