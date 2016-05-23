<?php
class JwsysAction extends Action{
	public function addschool(){
		$data['schoolname']=$_REQUEST['schoolname'];
		$data['url']=$_REQUEST['url'];
		$data['sysno']=$_REQUEST['sysno'];
		$school=new Model("school");
		$res=$school->add($data);
		if($res==false){
			$this->error('添加错误！');
		}else {
			$this->success('添加成功!');
		}
	}
	public function addjwsys(){
		$jwsys['sysname']=$_REQUEST['sysname'];
		$jwsys['m_class']=$_REQUEST['m_class'];
		$jwsys1=new Model('jwsys');
		$jwsys1->add($jwsys);
		$content='<?php
									class '.$jwsys['m_class'].'Action'.'  extends Action{
												private $Fetchurl;
												private $schoolinfo;
												private $url;
												private $wxcount;
												private $StudentPass; // 密码
												private $scount; // 学号
												private $res;
									public function __construct($arr) {
				
												} 
									public 	function grade(){
				
												}
									private function login(){
		
												}
									public function classes(){
		
												}
									public function Checklogin(){
		
												}
								}';
		$handle=fopen(PATH.'/Home/Lib/Action/Home/'.$jwsys['m_class'].'Action.class.php', 'x+');
		//var_dump($handle);
		$res=fwrite($handle, $content);
		if($res)
			$this->success('新建成功！');
		else 
			$this->error('新建失败！');
	}
}