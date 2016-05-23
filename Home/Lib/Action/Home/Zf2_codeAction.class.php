<?php
class Zf2_codeAction  extends Action{
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
			$this->url = $school[0] [url];
		} 
		public 	function  grade(){
				
		}
		private function login(){
			$this->Fetchurl->url = $this->url . '/default2.aspx';
			$this->Fetchurl->fetch ();
			$this->Fetchurl->data = iconv ( 'gb2312', 'utf-8', $this->Fetchurl->data );
			preg_match_all ( '/name="__VIEWSTATE"\svalue="(.*)"/iu', $this->Fetchurl->data, $matches );
			$content = urlencode ( $matches [1] [0] );
			
			/**
			 * **
			*/
			$this->Fetchurl->url = $this->url . '/default2.aspx';
			$this->Fetchurl->postdata = "__VIEWSTATE=$content&__VIEWSTATEGENERATOR=92719903&TextBox1=$this->scount&TextBox2=$this->StudentPass&TextBox3=&RadioButtonList1=%D1%A7%C9%FA&Button1=&lbLanguage=&hidsc=";
			$this->Fetchurl->post_value = true;
			$this->Fetchurl->header_param = array (
					'User-Agent:Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.63 Safari/537.36'
			);
			$this->Fetchurl->fetch ();
			$this->res=$this->Fetchurl->data;
		}
		public function classes(){
		
		}
		public function Checklogin(){
		$this->login();
		$this->res=preg_match('/xs_main\.aspx/isu', $this->res);
		return $this->res;
		}
				}