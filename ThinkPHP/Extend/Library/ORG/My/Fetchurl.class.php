<?php
class Fetchurl {
	public $url;
	public $postdata=null; // post的数据
	public $post_value = FALSE;//是否用post发送数据
	public $ch;
	public $timeout=10;
	public $header_param = array (); // 浏览器头信息
	public $data; // 返回的网页数据（包含头信息）
	public $setcookies; // 要回送的cookie值
	public $header_value=1;//是否返回头
	public function __construct() {
		$this->ch = curl_init ();
	}
	public function fetch() {
		curl_setopt ( $this->ch, CURLOPT_URL, $this->url );
		curl_setopt ( $this->ch, CURLOPT_HEADER, $this->header_value );
		curl_setopt($this->ch, CURLOPT_TIMEOUT,$this->timeout);
		curl_setopt ( $this->ch, CURLOPT_POST, $this->post_value );
		if($this->post_value){
		curl_setopt ( $this->ch, CURLOPT_POSTFIELDS, $this->postdata );
		}
		curl_setopt ( $this->ch, CURLOPT_HTTPHEADER, $this->header_param );
		curl_setopt ( $this->ch, CURLOPT_RETURNTRANSFER, 1 );
		if($this->setcookies){
		curl_setopt ( $this->ch, CURLOPT_COOKIE, $this->setcookies );
		}
		$this->data = curl_exec ( $this->ch );
		$this->getcookies();
	}
	public function getcookies() {
		$kvs = array ();
		if (preg_match_all ( '/Set-Cookie:\s([^\r\n]+);/i', $this->data, $matches )) {
			foreach ( $matches [1] as $match ) {
				$cookie = array ();
				$items = explode ( ";", $match );
				foreach ( $items as $_ ) {
					$item = explode ( "=", trim ( $_ ) );
					$cookie [$item [0]] = $item [1];
				}
				//array_push ( $cookies, $cookie );
				$kvs = array_merge ( $kvs, $cookie );
				foreach ( $kvs as $key => $value )
					$cookies .= $key . '=' . $value . '; ';
			}
			$this->setcookies = preg_replace ( '/(; )$/iu', '', $cookies );
			//$this->setcookies=$this->data;
		}
	}
	public function __destruct(){
		curl_close($this->ch);
	}
}