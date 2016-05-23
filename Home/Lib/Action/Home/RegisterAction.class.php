<?php
class RegisterAction extends Action{
	private $data;
public function register(){
	$wxcount=$_REQUEST['wxcount'];
	$school=new Model('school');
	$res=$school->select();
	$this->assign('res',$res);
	$this->assign('wxcount',$wxcount);
	$this->display('register');
}
public function registerprocess(){
	$this->data['wxcount']=$_REQUEST['wxcount'];
	$this->data['scount']=$_REQUEST['scount'];
	$this->data['pwd']=$_REQUEST['pwd'];
	$this->data['schoolno']=$_REQUEST['schoolno'];
	$this->data['nickname']=$_REQUEST['nickname'];
	$this->data['code']=$_REQUEST['code'];
	$studentinfo=new Model('studentinfo');
	//检查账号、密码、学校是否输入正确
	$checkcount=$this->Checkcount();
	if($checkcount){
	$res=$studentinfo->add($this->data);
	if($res){
	$this->display	('success');
	}else{
	$this->display('error');
	} 
	}else{
		$this->display('error');
	}
}
public function Checkcount(){
	$school=new Model('school');
	$res=$school->where("schoolno=".$this->data['schoolno'])->find();
	$jwsys=new Model('jwsys');
	$res=$jwsys->where("sysno=".$res['sysno'])->find();
	$m_class=$res['m_class'].Action;
	$class=new $m_class($this->data);
	if($class->Checklogin()==null){
		return false;
	}else {
		return true;
	}
} 
public function check_iscode(){
	$data['schoolno']=$_POST['schoolno'];
	$school=new Model('school');
	$res=$school->where($data)->find();
	$jwsys=new Model('jwsys');
	$res=$jwsys->where('sysno='.$res['sysno'])->find();
	if($res['iscode']==1){
		//返回json数据表示要显示验证码
		echo '{"iscode":1}';
		//echo 'ok';
	}else{
		//返回json数据表示不要显示验证码
		echo '{"iscode":0}';
	}
}
}