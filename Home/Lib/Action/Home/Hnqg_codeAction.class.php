<?php

/**
 * Class Hnqg_codeAction
 * 湖南青果教务系统
 * 山西师范大学
 */
class Hnqg_codeAction extends Action {
	private $Fetchurl;
	private $schoolinfo;
	private $url;
	private $wxcount;
	private $StudentPass; // 密码
	private $scount; // 学号
	private $res;
	private $code; // 验证码
	public function __construct($arr) {
		import ( 'ORG.My.Fetchurl' );
		$this->scount = $arr ['scount'];
		$this->StudentPass = $arr ['pwd'];
		$this->code=$arr['code'];
		$this->Fetchurl = new Fetchurl ();
		$this->school = new Model ( 'school' );
		$school = $this->school->where ( 'schoolno=' . $arr ['schoolno'] )->select ();
		$this->url = $school[0] [url];
	}
	public function grade() {
	}
	private function login() {
		$this->Fetchurl->url=$this->url.'/_data/index_LOGIN.aspx';
		$this->Fetchurl->setcookies=session('s_session');
		$this->Fetchurl->fetch();
		$this->Fetchurl->data = iconv ( 'gb2312', 'utf-8', $this->Fetchurl->data );
		preg_match_all ( '/name="__VIEWSTATE"\svalue="(.*)"/iu', $this->Fetchurl->data, $matches );
		$content = urlencode ( $matches [1] [0] );
		/**
		 * **
		*/
		$this->Fetchurl->url = $this->url .'/_data/index_LOGIN.aspx';
		$this->Fetchurl->postdata = "__VIEWSTATE=$content&UserID=$this->scount&PassWord=$this->StudentPass&pcInfo=Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.153 Safari/537.36undefined5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.153 Safari/537.36 SN:NULL&typeName=%D1%A7%C9%FA&Sel_Type=STU&cCode=$this->code&sbtState=";
		//$this->Fetchurl->setcookies=session('s_session');
		$this->Fetchurl->post_value = true;
		$this->Fetchurl->header_param = array (
				'User-Agent:Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.63 Safari/537.36',
				'Referer:'.$this->url.'/_data/index_LOGIN.aspx'
		);
		$this->Fetchurl->fetch ();
		$this->res=$this->Fetchurl->data;
	}
	public function classes() {
	
	}
	public function Checklogin() {
		$this->login();
		//var_dump($this->res);
		$this->res=preg_match('/\/MAINFRM\.aspx/isu',iconv('gb2312', 'utf-8', $this->res));
		return $this->res;
	}
}