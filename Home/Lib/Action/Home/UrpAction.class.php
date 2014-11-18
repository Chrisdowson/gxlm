<?php
class UrpAction extends Action {
	private $Fetchurl;
	private $schoolinfo;
	private $studentinfo;
	private $url;
	public function __construct() {
		import ( 'ORG.My.Fetchurl' );
		$this->Fetchurl = new Fetchurl ();
		$this->schoolinfo=new Model('schoolinfo');
		$this->studentinfo=new Model('studentinfo');
	}
	private function login() {
		$wxcount=$_REQUEST['wxcount'];
		$studentinfo=$this->studentinfo->where('wxcount='.$wxcount)->select();
		$xh = $studentinfo[0][count];
		$mm=$studentinfo[0][pwd];
		$schoolinfo=$this->schoolinfo->where('schoolno='.$studentinfo[0][schoolno])->select();
		$this->url=$schoolinfo[0][url];
		$this->Fetchurl->postdata = "zjh=$xh&mm=$mm";
		$this->Fetchurl->post_value = true;
		$this->Fetchurl->url = $this->url.'/loginAction.do';
		$this->Fetchurl->header_param = array (
				'User-Agent:Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.63 Safari/537.36' 
		);
		$this->Fetchurl->fetch ();
		return $this->Fetchurl->data;
	}
	public function grade() {
		$this->login ();
		$this->Fetchurl->url = $this->url.'/gradeLnAllAction.do?type=ln&oper=sxinfo&lnsxdm=001';
		$this->Fetchurl->fetch ();
		$data = $this->Fetchurl->data;
		$data = mb_convert_encoding ( $data, "utf-8", "GBK" );
		if ($data == null) {
			return '学校服务器出现错误了,请稍后再试[尴尬]！';
			exit ();
		}
		preg_match_all ( '/<td align="center">(.*?)<\/td>/isu', $data, $matches );
		for($i = 0; $i < count ( $matches [1] ) / 7; $i ++) {
			preg_match_all ( '/<p align="center">(.*?)&nbsp;<\/P>/isu', $matches [1] [$i * 7 + 6], $course );
			$matches [1] [$i * 7 + 6] = $course [1] [0];
			if (trim ( $matches [1] [$i * 7 + 6] ) == "")
				$matches [1] [$i * 7 + 6] = "未录入\n";
			$nav .= trim ( $matches [1] [$i * 7 + 2] ) . '---' . trim ( $matches [1] [$i * 7 + 6] ) . "\n";
		}
		dump ( $nav );
	}
	public function classes() {
		$this->login ();
		$this->Fetchurl->url = $this->url.'/xkAction.do?actionType=6';
		$this->Fetchurl->fetch ();
		$data = $this->Fetchurl->data;
		$data = mb_convert_encoding ( $data, "utf-8", "GBK" );
		preg_match_all ( '/<td>&nbsp;(.*?)<\/td>/is', $data, $matches );
		if ($data == null) {
			return '学校服务器出现错误了，请稍后再试[尴尬]！';
			exit ();
		}
		$classlist = null;
		for($i = 0; $i < 7; $i ++) {
			$classlist .= '星期' . ($i + 1) . ':';
			for($j = 0; $j < 10; $j ++) {
				$classlist .= '第' . ($j + 1) . '-' . ($j + 2) . '节：';
				// 去掉内容中的<br>,<td>,</td>,&nbsp;
				$matches [0] [$j * 7 + $i] = preg_replace ( '/(\<br\>)|(\<td\>)|(&nbsp;)|(\<\/td\>)/i', '', $matches [0] [$j * 7 + $i] );
				// 去除字符串首尾处的空白字符（或者其他字符）
				$matches [0] [$j * 7 + $i] = trim ( $matches [0] [$j * 7 + $i] );
				if ($matches [0] [$j * 7 + $i] == null)
					$classlist .= "没课哦!\n";
				else
					$classlist .= $matches [0] [$j * 7 + $i] . "\n";
			}
		}
		function getweekday() {
			switch (date ( 'D' )) {
				case 'Mon' :
					$weekday = 1;
					break;
				case 'Tue' :
					$weekday = 2;
					break;
				case 'Wed' :
					$weekday = 3;
					break;
				case 'Thu' :
					$weekday = 4;
					break;
				case 'Fri' :
					$weekday = 5;
					break;
				case 'Sat' :
					$weekday = 6;
					break;
				case 'Sun' :
					$weekday = 7;
					break;
			}
			return $weekday;
		}
		function getclassbyday($matches) {
			$i = getweekday ();
			$classes .= '星期' . tranlate ( $i ) . "\n:";
			for($j = 0; $j < 10; $j ++) {
				$classes .= '第' . ($j + 1) . '-' . ($j + 2) . '节：';
				// 去掉内容中的<br>,<td>,</td>,&nbsp;
				$matches [0] [$j * 7 + $i - 1] = preg_replace ( '/(\<br\>)|(\<td\>)|(&nbsp;)|(\<\/td\>)/i', '', $matches [0] [$j * 7 + $i - 1] );
				// 去除字符串首尾处的空白字符（或者其他字符）
				$matches [0] [$j * 7 + $i - 1] = trim ( $matches [0] [$j * 7 + $i - 1] );
				if ($matches [0] [$j * 7 + $i - 1] == null)
					$classes .= "没课哦!\n";
				else
					$classes .= $matches [0] [$j * 7 + $i - 1] . "\n";
			}
			return $classes;
		}
		function tranlate($m) {
			switch ($m) {
				case '1' :
					$day = '一';
					break;
				case '2' :
					$day = '二';
					break;
				case '3' :
					$day = '三';
					break;
				case '4' :
					$day = '四';
					break;
				case '5' :
					$day = '五';
					break;
				case '' :
					$day = '六';
					break;
				case '7' :
					$day = '日';
					break;
			}
			return $day;
		}
		dump(getclassbyday($matches));
	}
}