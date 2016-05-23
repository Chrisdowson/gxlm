<?php
class EventAction extends Action{
	public $res;
	public function __construct($postobj){
		if("subscribe"==$postobj->Event){
			$this->res='感谢您关注公众平台教程！';
			$this->assign('ToUserName',$postobj->FromUserName);
			$this->assign('FromUserName',$postobj->ToUserName);
			$this->assign('time',time());
			$this->assign('Content',$this->res);
			$this->display('Public:text');
		}elseif( "CLICK"==$postobj->Event){
		switch ($postobj->EventKey){
			case 'grade':
				$Checkschool=new CheckschoolAction($postobj,'grade');
				$this->res=$Checkschool->res;
				break;
			case 'classes':
				$Checkschool=new CheckschoolAction($postobj,'classes');
				$this->res=$Checkschool->res;
				break;
			case 'info':
				$Studentinfo=new StudentinfoAction($postobj);
				$this->res=$Studentinfo->res;
				break;
			case 'exit':
				$Exit=new ExitAction($postobj);
				$this->res=$Exit->res;
				break;
		}
		}
		}
	}