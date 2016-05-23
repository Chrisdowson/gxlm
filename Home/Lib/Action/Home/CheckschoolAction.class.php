<?php
class CheckschoolAction extends Action{
	public $res;
	public function __construct($postobj,$fangfa){
		$studentinfo=new Model('studentinfo');
		$arr=$studentinfo->where("wxcount='$postobj->FromUserName'")->find();
		if(empty($arr)){
			$regiter=new RegisterAction();
			$this->res='<a href="http://'.Server.'/gxlm/?m=Register&a=register&wxcount='.$postobj->FromUserName.'">点这里绑定</a>';
		}else {
			$school=new Model('school');
			$res=$school->where("schoolno=".$arr['schoolno'])->find();
			$jwsys=new Model('jwsys');
			$res=$jwsys->where("sysno=".$res['sysno'])->find();
			$m_class=$res['m_class'].Action;
			$class=new $m_class($arr);
			$this->res=$class->$fangfa();
			;
			}
		$this->assign('ToUserName',$postobj->FromUserName);
		$this->assign('FromUserName',$postobj->ToUserName);
		$this->assign('time',time());
		$this->assign('Content',$this->res);
		$this->display('Public:text');
	}
}