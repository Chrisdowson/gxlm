<?php
class BlAction extends Action {
	private $Fetchurl;
	private $schoolinfo;
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
		$this->schoolinfo = new Model ( 'schoolinfo' );
		$schoolinfo = $this->schoolinfo->where ( 'schoolno=' . $arr ['schoolno'] )->select ();
		$this->url = $schoolinfo [0] [url];
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
		$this->Fetchurl->data = iconv ( 'gb2312', 'utf-8', $this->Fetchurl->data );
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
							$nav .= '课程名：' . $matches [1] [$i * 15 + 19] . '成绩=' . $matches [1] [$i * 15 + 24] . '补考成绩=' . $matches [1] [$i * 15 + 26] . '重修成绩=' . $matches [1] [$i * 15 + 27] . "\n";
						} else {
							$nav .= '课程名：' . $matches [1] [$i * 15 + 19] . '成绩=' . $matches [1] [$i * 15 + 24] . '补考成绩=' . $matches [1] [$i * 15 + 26] . "\n";
						}
					} else {
						$nav .= '课程名：' . $matches [1] [$i * 15 + 19] . '成绩=' . $matches [1] [$i * 15 + 24] . "\n";
					}
				} else {
					break;
				}
			}
		} else {
			$nav = '[流泪]查询失败，请确定学号和密码学校都木有错，或者稍后再试下!';
		}
		return $nav;
	}
	public function classes() {
		import('ORG.My.Simple_html_dom');
		$bl_course = new Model ( 'bl_course' );
		$result = $bl_course->where ( 'scount=' . $this->scount )->select ();
		if (empty ( $result )) {
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
			$this->Fetchurl->data = iconv ( 'gb2312', 'utf-8', $this->Fetchurl->data );
			$html = new simple_html_dom();
			$html->load($this->Fetchurl->data);
			foreach($html->find('table.blacktab td') as $element) {
				$data=preg_replace('/(&nbsp;)|(\(换\d*\))|(、)|(\(停\d*\))/iu', '', $element->plaintext);
				$data=preg_replace('/\s+/iu', '-', $data);
				if($data){
					$data=trim($data);
					preg_match_all( '/([^-].+?)-周(.)第(.*?)节\{.*?(\d+)-(\d+).*?\}-(.+?)-(.+?\d+)/isu', $data, $res );
					for($i=0;$res[0][$i];$i++){
						$nav.='课程名:' . $res[1][$i]. '时间:周'.$res[2][$i].'第'.$res[3][$i].'节'.$res[4][$i].'-'.$res[5][$i].'周老师'.$res[6][$i].'地点:'.$res[7][$i]."\n";
						$result['scount'] = "$this->scount";
						$result ['startweek'] = "{$res[4][$i]}";
						$result ['finalweek'] = "{$res[5][$i]}";
						$result ['week'] = "{$res[2][$i]}";
						$result ['jieci'] = "{$res[3][$i]}";
						$result ['course'] = "{$res[1][$i]}";
						$result ['teacher'] = "{$res[6][$i]}";
						$result ['where'] = "{$res[7][$i]}";
						$bl_course->add ( $result );
					}
				}
				elseif($result==null&&$i)
					$nav = '亲，你们这个学期木有课程哦!';
			}
			$html->clear();
		}
			 else {
			foreach ( $result as $key => $value )
				$nav .= '课程名:' . $value ['course'] . '时间:周' . $value ['week'] . '第' . $value ['jieci'] . '节' . $value ['startweek'] . '-' . $value ['finalweek'] . '周老师:' . $value ['teacher'] . '地点:' . $value ['where'] . "\n";
		}
		return $nav;
	}
	public function Checklogin(){
		$this->login();
		return $this->res;
	}
	public function freerom() {
	}
}