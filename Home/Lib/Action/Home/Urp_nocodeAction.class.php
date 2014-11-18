<?php
class Urp_nocodeAction extends Action{
	private $Fetchurl;
	private $schoolinfo;
	private $url;
	private $wxcount;
	private $StudentPass; // 密码
	private $scount; // 学号
	private $res;
	public function __construct($arr) {
		import ( 'ORG.My.Fetchurl' );
		$this->Fetchurl = new Fetchurl ();
		$this->scount=$arr['scount'];
		$this->StudentPass=$arr['pwd'];
		$this->schoolinfo=new Model('school');
		$schoolinfo=$this->schoolinfo->where('schoolno='.$arr['schoolno'])->select();
		$this->url=$schoolinfo[0][url];
		//$this->res=$this->scount;
	}
	private function login(){
		$this->Fetchurl->url="$this->url/loginAction.do";
		$this->Fetchurl->post_value=true;
		$this->Fetchurl->postdata="dllx=dldl&zjh=$this->scount&mm=$this->StudentPass";
		$this->Fetchurl->fetch();
		$this->Fetchurl->data=iconv('gbk', 'utf-8', $this->Fetchurl->data);
		$this->res=$this->Fetchurl->data;
	} 
	public function grade(){
		$bysj0=new Model('bysj0_course');
		$res=$bysj0->where("scount='$this->scount'")->select();
		if($res==null){
		$this->login();
		$this->Fetchurl->url="$this->url/gradeLnAllAction.do?type=ln&oper=sxinfo&lnsxdm=001";
		$this->Fetchurl->fetch();
		$this->Fetchurl->data=iconv('gbk', 'utf-8', $this->Fetchurl->data);
		preg_match_all('/<td align="center">(.*?)<\/td>/isu', $this->Fetchurl->data, $matches);
		for ($i = 0; $i < count($matches[1]) / 7; $i++)
		{
			preg_match_all('/<p align="center">(.*?)&nbsp;<\/P>/isu', $matches[1][$i * 7 + 6],$course);
			$matches[1][$i * 7 + 6]=$course[1][0];
			if (trim($matches[1][$i * 7 + 6]) == "")
				$matches[1][$i * 7 + 6] = "未录入\n";
				$data['scount']=$this->scount;
				$data['course']=trim($matches[1][$i * 7 + 2]);
				$data['chengji']=trim($matches[1][$i * 7 + 6]);
				$bysj0->add($data);
			$nav .= trim($matches[1][$i * 7 + 2]) . '=' . trim($matches[1][$i * 7 + 6])."\n" ;
		}
		}else {
			foreach ( $res as $key => $value )
				$nav.=$value['course'].'='.$value['chengji']."\n";
						}
		return $nav;
	}
	public function classes(){
		import('ORG.My.Simple_html_dom');
		$html = new simple_html_dom();
		$Bysj=new Model('bysj_course');
		$res=$Bysj->where("scount='$this->scount'")->select();
		if($res==null){
		$this->login();
		$nav=null;
		$this->Fetchurl->url="$this->url/xkAction.do?actionType=6";
		$this->Fetchurl->fetch();
		$content=iconv('gbk','utf-8', $this->Fetchurl->data);
		$html->load($content);
		$data=array();
		foreach($html->find('table tr.odd td') as $element) {
			//$i++;
			//echo $i.'=>';
			$element->plaintext=preg_replace('/(&nbsp;)|(\s)/iu', '', $element->plaintext);
			array_push($data, $element->plaintext);
			//var_dump($element->plaintext);
		}
		$html->clear();
		if($data[2]){
		for($i=0;$i<count($data);$i){
			$course=$data[$i+2];
			$teacher=$data[$i+7];
			$arr['scount']=$this->scount;
			$arr['course']=$data[$i+2];
			$arr['teacher']=$data[$i+7];
			$arr['weekend']=$data[$i+11];
			$arr['week']=$data[$i+12];
			$arr['class']=$data[$i+13];
			$arr['jieci']=$data[$i+14];
			$arr['where']=$data[$i+16].$data[$i+17];
			$nav.='课程:'.$arr['course'].'老师:'.$arr['teacher'].'周次:'.$arr['weekend'].'星期'.$arr['week'].'从第'.$arr['class'].'开始上'.$arr['jieci'].'节'.'教室:'.$arr['where']."\n";
			$Bysj->add($arr);
			$i=$i+18;
			while(preg_match('/周/iu',$data[$i])){
				$arr['scount']=$this->scount;
				$arr['course']=$course;
				$arr['teacher']=$teacher;
				$arr['weekend']=$data[$i];
				$arr['week']=$data[$i+1];
				$arr['class']=$data[$i+2];
				$arr['jieci']=$data[$i+3];
				$arr['where']=$data[$i+4].$data[$i+6];
				$nav.='课程:'.$arr['course'].'老师:'.$arr['teacher'].'周次:'.$arr['weekend'].'星期'.$arr['week'].'从第'.$arr['class'].'开始上'.$arr['jieci'].'节'.'教室:'.$arr['where']."\n";
				$Bysj->add($arr);
				$i+=7;
			}
		}
		}else 					
			$nav = '亲，你们这个学期木有课程哦!';
		}else {
			foreach ( $res as $key => $value )
				$nav.='课程:'.$value['course'].'老师:'.$value['teacher'].'周次:'.$value['weekend'].'星期'.$value['week'].'从第'.$value['class'].'开始上'.$value['jieci'].'节'.'教室:'.$value['where']."\n";
						}
						return $nav;
		
	}
	public function Checklogin(){
		$this->login();
		$this->res=preg_match('/\/menu\/top\.jsp/iu', $this->res);
		return $this->res;
	}
}