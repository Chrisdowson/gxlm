<?php
class Qhjw_codeAction extends Action {
	private $Fetchurl;
	private $schoolinfo;
	private $url;
	private $wxcount;
	private $StudentPass; // 密码
	private $scount; // 学号
	private $res;
	private $code;//验证码
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
		$this->Fetchurl->url=$this->url.'/j_acegi_security_check';
		$this->Fetchurl->setcookies=$_SESSION['s_session'];
		$this->Fetchurl->post_value=true;
		$this->Fetchurl->postdata="j_username=$this->scount&j_password=$this->StudentPass&j_captcha=$this->code&button1=%B5%C7%C2%BC";
		$this->Fetchurl->header_param=array(
				'Referer:'.$this->url.'/common/security/login.jsp',
				'User-Agent:Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.153 Safari/537.36'
		);
		$this->Fetchurl->fetch();
		$this->res=$this->Fetchurl->data;
	}
	public function classes() {
	}
	public function Checklogin() {
		$this->login();
		$this->res=preg_match('/index_new\.jsp/isu', iconv('gb2312', 'utf-8', $this->res));
		return $this->res;
	}
}