<?php
class GetcodeAction extends Action{
	private $Fetch;
	public function  getcode(){
		$data['schoolno']=$_REQUEST['schoolno'];
		//echo $schoolno;
		$school=new Model('school');
		$res=$school->where($data)->find();
		$jwsys=new Model('jwsys');
		$res1=$jwsys->where('sysno='.$res[sysno])->find();
		header("Content-Type:image/gif charset=utf-8");
		import ( 'ORG.My.Fetchurl' );
		$this->Fetch=new Fetchurl();
		$this->Fetch->url = $res[url].$res1[code_url];
		$this->Fetch->header_value=1;
		$this->Fetch->fetch();
		session('s_session',$this->Fetch->setcookies);
		$this->Fetch->header_value=0;
		$this->Fetch->fetch();
		$data = imagecreatefromstring ( $this->Fetch->data );
		imagepng ( $data );
		imagedestroy ( $data ); 
		}
}