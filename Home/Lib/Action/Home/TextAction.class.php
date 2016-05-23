<?php
class TextAction extends Action{
	public $res;
	public function __construct($postobj){
		 switch ($postobj->Content){
			case '查成绩':
				$Checkschool=new CheckschoolAction($postobj,'grade');
				$this->res=$Checkschool->res;
				break;
			case '查课表':
				$Checkschool=new CheckschoolAction($postobj,'classes');
				$this->res=$Checkschool->res;
				break;
			case '比分':
				$Checkschool=new CheckschoolAction($postobj,'bifen');
				$this->res=$Checkschool->res;
				break;
			case '个人信息':
				$Studentinfo=new StudentinfoAction($postobj);
				$this->res=$Studentinfo->res;
				break;
			case '擦除密码':
				$Checkschool=new CheckschoolAction($postobj,'dpwd');
				$this->res=$Checkschool->res;
				break;
			case 'exit':
				$Exit=new ExitAction($postobj);
				$this->res=$Exit->res;
				break;
		 }
	}
}