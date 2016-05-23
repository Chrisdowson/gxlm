<?php
class Zf1_codeAction extends Action {
	private $Fetchurl;
	private $school;
	private $url;
	private $wxcount;
	private $StudentPass; // 密码
	private $scount; // 学号
	private $res;
	public function __construct($arr) {
		import ( 'ORG.My.Fetchurl' );
		$this->scount = $arr ['scount'];
		$this->StudentPass = $arr ['pwd'];
		$this->Fetchurl = new Fetchurl ();
		$this->school = new Model ( 'school' );
		$school = $this->school->where ( 'schoolno=' . $arr ['schoolno'] )->select ();
		$this->url = $school[0] [url];
	}
	private function login() {
		/**
		 * ***
		 */
		$this->Fetchurl->url = $this->url . '/default2.aspx';
		$this->Fetchurl->fetch ();
		$this->Fetchurl->data = iconv ( 'gb2312', 'utf-8', $this->Fetchurl->data );
		preg_match_all ( '/name="__VIEWSTATE"\svalue="(.*)"/iu', $this->Fetchurl->data, $matches );
		$content = urlencode ( $matches [1] [0] );
		/**
		 * **
		 */
		$this->Fetchurl->url = $this->url . '/default2.aspx';
		$this->Fetchurl->postdata = "__VIEWSTATE=$content&txtUserName=$this->scount&TextBox2=$this->StudentPass&txtSecretCode=&RadioButtonList1=%D1%A7%C9%FA&Button1=&lbLanguage=&hidPdrs=&hidsc=";
		$this->Fetchurl->post_value = true;
		$this->Fetchurl->header_param = array (
				'User-Agent:Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.63 Safari/537.36' 
		);
		$this->Fetchurl->fetch ();
		$this->res=$this->Fetchurl->data;
		/**
		 * *获取学生主页信息**
		 */
		$this->Fetchurl->url = "$this->url/xs_main.aspx?xh=$this->scount";
		$this->Fetchurl->post_value = false;
		$this->Fetchurl->header_param = array (
				"Referer:$this->url/default2.aspx",
				'User-Agent:Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.63 Safari/537.36' 
		);
		$this->Fetchurl->fetch ();
	}
	
	
	
	public function grade() {
		return 'ok';
		$this->login ();
		if($this->StudentPass=='*/*/*/*/'){
				$nav='<a href="http://'.Server.'/gxlm/?m=Bg&a=rpwd&scount='.$this->scount.'">你已删除密码，请输入密码后再查成绩，请点击</a>';
				return $nav;
		}	
	
		$bg0=new Model('bg0_course');
		$bg0_res=$bg0->where("scount='$this->scount'")->delete();
		$res=$bg0->where("scount='$this->scount'")->select();
		if($res==null){
			$this->login ();
			ereg ( iconv ( "UTF-8", "GB2312", "<span id=\"xhxm\">$this->scount(.*)同学</span>" ), $this->Fetchurl->data, $xm );
			$xm = urlencode ( trim ( $xm [1] ) );
			/**
			 * *请求一次成绩查询页是为了获得最新的cookie**
			 */
			$this->Fetchurl->url = "$this->url/xscjcx.aspx?xh=$this->scount&xm=$xm&gnmkdm=N121605";
			$this->Fetchurl->header_param = array (
					"Referer: $this->url/xs_main.aspx?xh=$this->scount" 
			);
			$this->Fetchurl->fetch ();
			$this->Fetchurl->data = iconv ( 'gb2312', 'utf-8', $this->Fetchurl->data );
			preg_match_all ( '/name="__VIEWSTATE"\svalue="(.*)"/iu', $this->Fetchurl->data, $matches );
			$this->Fetchurl->url = "$this->url/xscjcx.aspx?xh=$this->scount&xm=$xm&gnmkdm=N121605";
			$this->Fetchurl->post_value = true;
			$content = urlencode ( $matches [1] [0] );
			$this->Fetchurl->postdata = "__EVENTTARGET=&__EVENTARGUMENT=&__VIEWSTATE=$content&hidLanguage=&ddlXN=&ddlXQ=&ddl_kcxz=&btn_zcj=%C0%FA%C4%EA%B3%C9%BC%A8";
			$this->Fetchurl->header_param = array (
					"Referer: $this->url/xscjcx.aspx?xh=$this->scount&xm=$xm&gnmkdm=N121605" 
			);
			$this->Fetchurl->fetch ();
			$this->Fetchurl->data = iconv ( 'gbk', 'utf-8', $this->Fetchurl->data );
			preg_match_all ( '/<td>(.*?)<\/td>/isu', $this->Fetchurl->data, $matches );
			// return $matches[1][1];
			/**
			 * matches[1]数组张16为年份，17为学期，18为课程代码，19为课程名，20为课程性质，21为课程归属，22为学分
			 * 23为绩点，24为成绩，25为辅修标记，26为补考成绩，27为重修成绩，28为开课学院
			 * ***
			 */
			if (!empty($matches[1][1])) {
				for($i = 0;; $i ++) {
					if ($matches [1] [$i * 15 + 19]) {
						if ('&nbsp;' != $matches [1] [$i * 15 + 26]) {
							if ('&nbsp;' != $matches [1] [$i * 15 + 27]) {
								$data['xuenian']=trim($matches [1] [$i * 15 + 16]);
								$data['xueqi']=trim($matches [1] [$i * 15 + 17]);
				                $data['scount']=$this->scount;
								$data['daima']=trim($matches [1] [$i * 15 + 18]);
								$data['course']=trim($matches [1] [$i * 15 + 19]);
								$data['xingzhi']=trim($matches [1] [$i * 15 + 20]);
								$data['xuefen']=trim($matches [1] [$i * 15 + 22]);
								$data['jidian']=trim($matches [1] [$i * 15 + 23]);
								$data['chengji']=trim($matches [1] [$i * 15 + 24]);
								$data['xueyuan']=trim($matches [1] [$i * 15 + 28]);
								$bg0->add($data);
								$nav .= '课程名：' . $matches [1] [$i * 15 + 19] . '成绩=' . $matches [1] [$i * 15 + 24] . '补考成绩=' . $matches [1] [$i * 15 + 26] . '重修成绩=' . $matches [1] [$i * 15 + 27] . "\n";
							} else {
								$data['xuenian']=trim($matches [1] [$i * 15 + 16]);
								$data['xueqi']=trim($matches [1] [$i * 15 + 17]);
				                $data['scount']=$this->scount;
								$data['daima']=trim($matches [1] [$i * 15 + 18]);
								$data['course']=trim($matches [1] [$i * 15 + 19]);
								$data['xingzhi']=trim($matches [1] [$i * 15 + 20]);
								$data['xuefen']=trim($matches [1] [$i * 15 + 22]);
								$data['jidian']=trim($matches [1] [$i * 15 + 23]);
								$data['chengji']=trim($matches [1] [$i * 15 + 24]);
								$data['xueyuan']=trim($matches [1] [$i * 15 + 28]);
								$bg0->add($data);
								$nav .= '课程名：' . $matches [1] [$i * 15 + 19] . '成绩=' . $matches [1] [$i * 15 + 24] . '补考成绩=' . $matches [1] [$i * 15 + 26] . "\n";
							}
						} else {
								$data['xuenian']=trim($matches [1] [$i * 15 + 16]);
								$data['xueqi']=trim($matches [1] [$i * 15 + 17]);
				                $data['scount']=$this->scount;
								$data['daima']=trim($matches [1] [$i * 15 + 18]);
								$data['course']=trim($matches [1] [$i * 15 + 19]);
								$data['xingzhi']=trim($matches [1] [$i * 15 + 20]);
								$data['xuefen']=trim($matches [1] [$i * 15 + 22]);
								$data['jidian']=trim($matches [1] [$i * 15 + 23]);								
								$data['chengji']=trim($matches [1] [$i * 15 + 24]);
								$data['xueyuan']=trim($matches [1] [$i * 15 + 28]);
								$bg0->add($data);
								
								
						 if ($data['xuenian'] == '2013-2014') 
				       {	
							$nav .= $matches [1] [$i * 15 + 19] . '=' . $matches [1] [$i * 15 + 24] . "\n";
						}
						}
					} else {
						break;
					}
				}
			} else {
				$nav = '[流泪]查询失败，可能由于网络问题 ，请稍后再试下!';
			}
		}else {
		//	foreach ( $res as $key => $value )
		//		$nav.=$value['course'].'='.$value['chengji']."\n";
						}
			
		$nav ="您最近一年的成绩为：". "\n".$nav . "\n". "\n".'<a href="http://www.daxuem.com/weixin/lm/kecheng.php">点击此 查课程给分高低</a>';

		return $nav;
	}
	
	public function bifen(){
		$bg0_course=new Model('bg0_course');
		$res=$bg0_course->where("scount='$this->scount'")->select();
		if(empty($res)){
			$res="你还没有查成绩，先查成绩再查课程给分高低！";
		}else 
			$res='<a href="http://'.Server.'/gxlm/?m=Bifen&a=index&scount='.$this->scount.'">你有资格查询课程给分高低，请点这里</a>';
		return $res;
	}	
	
	public function dpwd(){
		$studentinfo=new Model('studentinfo');
		$data['pwd'] = '*/*/*/*/';
		$res=$studentinfo->where("scount='$this->scount'")->save($data);
		if($res){
			$res='删除成功！';
		}else
			$res='删除失败！';
		return $res;
	}
	
	public function rpwd(){
		$pwd=$_REQUEST['pwd'];
		$scount=$_REQUEST['scount'];
		if($pwd){
			$data['pwd']="$pwd";
			$studentinfo=new Model('studentinfo');
			$res=$studentinfo->where("scount=$scount")->save($data);
			if($res)
				$res='密码删除成功！';
			else 
				$res='密码删除失败！';
			$this->assign('res',$res);
			$this->display('rpwd');
		}
		else {
			$this->assign('scount',$scount);
			$this->display('index');
		}
			
	}
	
	
	public function classes() {
		$bg_course = new Model ( 'bg_course' );
		if($this->StudentPass=='*/*/*/*/'){
			$nav='<a href="http://'.Server.'/gxlm/?m=Bg&a=rpwd&scount='.$this->scount.'">你已删除密码，请输入密码后再查课表，请点击</a>';
			return $nav;
		}
		$result = $bg_course->where ( 'scount=' . $this->scount )->order( 'week asc' )->select ();
		if (empty ( $result )) {
			echo "hi";
			$this->login ();
			ereg ( iconv ( "UTF-8", "GB2312", "<span id=\"xhxm\">$this->scount(.*)同学</span>" ), $this->Fetchurl->data, $xm );
			$xm = trim ( $xm [1] );
			$this->Fetchurl->url = "$this->url/xskbcx.aspx?xh=$this->scount&xm=$xm&gnmkdm=N121603";
			// $this->Fetchurl->post_value = true;
			$content = file_get_contents ( 'content.txt' );
			$this->Fetchurl->header_param = array (
					"Referer: $this->url/xs_main.aspx?xh=$this->scount",
					'User-Agent:Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.63 Safari/537.36' 
			);
			$this->Fetchurl->fetch ();
			$this->Fetchurl->data = iconv ( 'gbk', 'utf-8', $this->Fetchurl->data );
			preg_match_all ( '/<td align="Center" rowspan=.*?>.*?<br>.*?{.*?}<br>.*?<br>.*?<\/td>/iu', $this->Fetchurl->data, $matches );
			if($matches[0][1]){
			for($i = 0;$i<=90; $i ++) {
				if ($matches [0] [$i]) {
					preg_match_all ( '/>(.*?[^\d].*?)<br>(.*?\d.*?)<br>(.*?[^\d].*?)<br>(.*?)</iu', $matches [0] [$i], $res );
					preg_match ('/周(.)第(.*?)节\{第(\d+)-(\d+)周/iu', $res [2] [0], $res1 );
					preg_match ( '/周(.)第(.*?)节\{第(\d+)-(\d+)周/iu', $res [2] [1], $res2 );
					// dump($res);
					$data ['scount'] = "$this->scount";
					$data ['startweek'] = "$res1[3]";
					$data ['finalweek'] = "$res1[4]";
					$data ['week'] = "$res1[1]";
					$data ['jieci'] = "$res1[2]";
					$data ['course'] = "{$res[1][0]}";
					$data ['teacher'] = "{$res[3][0]}";
					$data ['where'] = "{$res[4][0]}";
					$bg_course->add ( $data );
					if($res[1][1]){
					$data ['scount'] = "$this->scount";
					$data ['startweek'] = "$res2[3]";
					$data ['finalweek'] = "$res2[4]";
					$data ['week'] = "$res2[1]";
					$data ['jieci'] = "$res2[2]";
					$res[1][1]=preg_replace('/<br>/', '', $res [1] [1]);
					$data ['course'] = "{$res[1][1]}";
					$data ['teacher'] = "{$res[3][1]}";
					$data ['where'] = "{$res[4][1]}";
					$bg_course->add ( $data );
					}
					$nav .= $res [2] [0] . ':' .$res [1] [0] . ':' .  $res [3] [0] . ':' . $res [4] [0] . "\n";
					if($res[1][1])
					$nav .= $res [2] [1] . ':' . preg_replace('/<br>/', '', $res [1] [1]) . ':' . $res [3] [1] . ':' . $res [4] [1] . "\n";
				} else {
					break;
				}
			}
			}else				
				$nav = '亲，你们这个学期木有课程哦!';
		} else {
		    
			foreach ( $result as $key => $value )

				//$nav .= '周' . $value ['week'] . '第' . $value ['jieci'] . '节{' . $value ['startweek'] . '-' . $value ['finalweek'] . '周}:' .$value ['course'] . '：' . $value ['teacher'] . ':' . $value ['where'] . "\n". "\n";
				$nav='http://localhost/gxlm/Bgclasses/classes?scount='.$this->scount;
				
		}
		return $nav;
	}
	public function Checklogin(){
		$this->login();
		$this->res=preg_match("/xh=".$this->scount."/iu", $this->res);
		
		return $this->res;
	}
	public function freerom() {
	}
}
