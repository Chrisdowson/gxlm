<?php
class BgclassesAction extends Action{
	public function classes(){
		$scount=$_GET['scount'];
		$classes=array();
		$bg=new Model('bg_course');
		$res=$bg->order( "find_in_set(week,'一,二,三,四,五'),jieci")->where('scount=' .$scount)->select();
		foreach ($res as $key=>$value){
			switch ($value['week']){
				case '一':
					$i=0;
					break;
				case '二':
					$i=1;
					break;
				case '三':
					$i=2;
					break;
				case '四':
					$i=3;
					break;
				case '五':
					$i=4;
					break;
				case '六':
					$i=5;
					break;
				case '日':
					$i=6;
					break;
			}
			preg_match_all('/(\d?[13579]),\d?[02468]/iu', $value['jieci'], $matches);
			 foreach ($matches as $key=>$val){
				$j= $matches[1][$key]/2;
				if($j){
				//dump($matches[1][$key]);
				$classes[$i][$j].=$value['course'].'<br>'.$value['where'].'<br>'.$value['teacher'].'<br>'.$value['startweek'].'--'.$value['finalweek'].'周<br>';
			} 
			 }
			//dump($matches);
			
		}
		//exit();
		$arr=array('一','二','三','四','五','六','日');
		$this->assign('arr',$arr);
		$this->assign('res',$res);
		$this->assign('classes',$classes);
		$this->display('classes');
		
	}
}