<?php
class Jxnd_nocodeAction  extends Action{
				private $Fetchurl;
				private $schoolinfo;
				private $url;
				private $wxcount;
				private $StudentPass; // 密码
				private $scount; // 学号
				private $res;
		public function __construct($arr) {
			import ( 'ORG.My.Fetchurl' );
			$this->scount = $arr ['scount'];
			$this->StudentPass = $arr ['pwd'];
			$this->Fetchurl = new Fetchurl ();
			$this->school = new Model ( 'school' );
			$school = $this->school->where ( 'schoolno=' . $arr ['schoolno'] )->select ();
			$this->url = $school [0] [url];
		} 
		public 	function grade(){
				
				}
		private function login(){
			$this->Fetchurl->url=$this->url.'/user/login';
			$this->Fetchurl->fetch();
			$this->Fetchurl->url=$this->url.'/User/CheckLogin';
			$this->Fetchurl->postdata="validation=&UserName=$this->scount&PassWord=$this->StudentPass";
			$this->Fetchurl->post_value=true;
			$this->Fetchurl->header_param = array (
					'User-Agent:Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.63 Safari/537.36'
			);
			$this->Fetchurl->fetch();
			$this->res=$this->Fetchurl->data;
		}
		public function classes(){
		
		}
		public function Checklogin(){
		$this->login();
		$this->res=preg_match('/\/Main\/Index\//isu', $this->res);
		return $this->res;
		}
				}