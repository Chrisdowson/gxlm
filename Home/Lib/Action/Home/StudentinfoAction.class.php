<?php
class StudentinfoAction extends Action{
	public $res;
	public function __construct($postobj){
		$studentinfo=new Model('studentinfo');
		$schoolinfo=new Model('schoolinfo');
		$arr=$studentinfo->where("wxcount='$postobj->FromUserName'")->find();
		if($arr){
		$schoolname=$schoolinfo->where('schoolno='.$arr['schoolno'])->find();
		$this->res="学号:\n".$arr['scount']."密码\n".$arr['pwd']."昵称\n".$arr['nickname']."大学\n".$schoolname['schoolname'];
		}else 
		$this->res='你都还没绑定信息，查个毛的信息呀！[鄙视]';
		$this->assign('ToUserName',$postobj->FromUserName);
		$this->assign('FromUserName',$postobj->ToUserName);
		$this->assign('time',time());
		$this->assign('Content',$this->res);
		$this->display('Public:text');
	}
}