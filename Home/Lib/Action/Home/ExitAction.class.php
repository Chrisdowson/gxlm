<?php
class ExitAction extends Action{
	public $res;
	public function __construct($postobj){
		$studentinfo=new Model('studentinfo');
		$info=$studentinfo->where("wxcount='$postobj->FromUserName'")->find();
		switch ($info['schoolno']){
			case '3':
				$bg=new Model('bg_course');
				$bg_res=$bg->where("scount='$info[scount]'")->delete();
				break;
			case '4':
				$bl=new Model('bl_course');
				$bl_res=$bl->where("scount='$info[scount]'")->delete();
				break;
			case '5':
				$bysj=new Model('bysj_course');
				$bysj_res=$bysj->where("scount='$info[scount]'")->delete();
				break;
		}
		$res=$studentinfo->where("wxcount='$postobj->FromUserName'")->delete();
			 if($res){
			$this->assign('ToUserName',$postobj->FromUserName);
			$this->assign('FromUserName',$postobj->ToUserName);
			$this->assign('time',time());
			$this->assign('Content','注销成功！');
			$this->display('Public:text');
		}else {			
			$this->assign('ToUserName',$postobj->FromUserName);
			$this->assign('FromUserName',$postobj->ToUserName);
			$this->assign('time',time());
			$this->assign('Content','注销失败！');
			$this->display('Public:text');
		}
	}
}