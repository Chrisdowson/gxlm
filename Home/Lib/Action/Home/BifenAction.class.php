<?php
class BifenAction extends Action{
	public function index(){
		$scount=$_GET['scount'];
		$this->display("index");
	}
	public function bifen(){
		$leibie=trim($_POST["leibie"]);
		$cxnr=trim($_POST["cxnr"]);
		$bg0_course=new Model('bg0_course');
		$where['name']=array('like',"%$cxnr%");
		$res=$bg0_course->query("SELECT distinct course FROM bg0_course where course like '%$cxnr%'");
		foreach ($res as $key=>$value){
				$result=$bg0_course->query("SELECT *  FROM bg0_course where course ='".$value['course']."' ORDER BY chengji");
				$r1=$bg0_course->query("SELECT max(chengji) FROM bg0_course where course ='".$value['course']."'");
				$r2=$bg0_course->query("SELECT min(chengji) FROM bg0_course where course ='".$value['course']."'");
				$r3=$bg0_course->query("SELECT avg(chengji) FROM bg0_course where course ='".$value['course']."'"); 
				 $nav.= '在现有数据库中，课程 '.$value['course'].' </br>';
				$nav.='最高分 : '.$r1[0]["max(chengji)"].'</br>';
				$nav.= '最低分 : '.$r2[0]["min(chengji)"].'</br>';
				$nav.= '平均分 :' .$r3[0]["avg(chengji)"].'</br>'; 
				$nav.= "具体分数为：</br>";
				foreach ($result as $key1 =>$value1) {
					$nav.= $value1['chengji']."、";
				}
				
				$nav.="<br />";
				$nav.="<br />";	 
		 }
		$this->assign('res',$nav);
		$this->display('bifen');
	}
}