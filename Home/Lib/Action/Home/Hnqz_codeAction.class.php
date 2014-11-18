<?php
class Hnqz_codeAction extends Action {
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
		$this->Fetchurl->url=$this->url;
	}
	public function classes() {
	}
	public function Checklogin() {
	}
}