<?php
header("Content-type: text/html; charset=utf-8");
define("ACCESS_TOKEN", "mF5mIlPLWYE2dnF1dOjmEAeOhBIHYkVYI1sWwjJTFKquBKPeUq4rBSROa43DLfGYR0v7OwgOi1Sc-fd53qI9yg");
//创建菜单
function createMenu($data){
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_URL, "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".ACCESS_TOKEN);
 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
 curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
 curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
 curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
 curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
 curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 $tmpInfo = curl_exec($ch);
 if (curl_errno($ch)) {
  return curl_error($ch);
 }
 curl_close($ch);
 return $tmpInfo;
}
//获取菜单
function getMenu(){
 return file_get_contents("https://api.weixin.qq.com/cgi-bin/menu/get?access_token=".ACCESS_TOKEN);
}
//删除菜单
function deleteMenu(){
 return file_get_contents("https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=".ACCESS_TOKEN);
}
 
 
/* $data = '{
     "button":[	
        {		"name":"娱乐",
		 "sub_button":[
        {   
		"type":"click",
           "name":"人品计算器",
           "key":"renpin"
		},
		{   
		"type":"click",
           "name":"笑话",
           "key":"joke"
		},
		{   
		"type":"click",
           "name":"魔图",
           "key":"picture"
		}
		]
      },
      {		"name":"实用工具",
		 "sub_button":[
        {   
		"type":"click",
           "name":"翻译",
           "key":"translate"
		},
		{   
		"type":"click",
           "name":"天气",
           "key":"weather"
		},
		{   
		"type":"click",
           "name":"长途汽车",
           "key":"qiche"
		},
		{   
		"type":"click",
           "name":"快递",
           "key":"kuaidi"
		}
		]
      },
      {		"name":"查询",
		 "sub_button":[
        {   
		"type":"click",
           "name":"成绩查询",
           "key":"searchgrade"
		},
		{
			  "type":"click",
               "name":"个人信息查询",
               "key":"searchinfo"
	  	},
		{
			  "type":"click",
	          "name":"电费查询",
	          "key":"searchdianfei"
		},{
			   "type":"click",
	           "name":"缴费查询",
	           "key":"searchjiaofei"
		}
		]
      }
		]
 }'; */
/*$data='{
     "button":[	
		{	
          "type":"click",
          "name":"城建app",
          "key":"app"
      }，	
      {	 "name":"查教务",
		 "sub_button":[
        {   
		   "type":"click",
           "name":"空闲教室",
           "key":"searchrom"
		},
 		{	
          "type":"click",
          "name":"成绩查询",
          "key":"searchgrade"
        },
 		{	
          "type":"click",
          "name":"考证",
          "key":"http://www.daxuem.com/weixin/jiaowu/kaozheng.html"
        }
		]
      }
		]
 }';*/
$data=' {
     "button":[
     {
           "name":"教务助手",
           "sub_button":[
            {
               "type":"click",
               "name":"绑定系统",
               "key":"bangding"
            },
            {
			   "type":"click",
               "name":"本人课表",
               "key":"classes"
            },
            {
               "type":"click",
               "name":"本人成绩",
               "key":"grade"
            },	
			{	
               "type":"click",
               "name":"课程给分高低",
               "key":"bifen"
            },					
            {
               "type":"view",
               "name":"公选课点评查询",
               "url":"http://www.daxuem.com/weixin/jiaowu/xuanke0.php"
            }]
	    },
		
      {
           "name":"生活助手",
           "sub_button":[
           {	
               "type":"view",
               "name":"二手物品",
               "url":"http://www.daxuem.com/3g/f/listall.php?ordertype=id"
            },
           {	
               "type":"view",
               "name":"重要电话",
               "url":"http://www.daxuem.com/weixin/bjut/tel-vip.html"
            },	
            {
               "type":"view",
               "name":"查空教室",
               "url":"http://class.bjut.edu.cn/Foreground/classroom.do;jsessionid=64FC406DCE994BA8537515930374086F?method=foreEmptyClassroomList"
            },
            {
               "type":"view",
               "name":"课程教师论坛",
               "url":"http://www.daxuem.com/3g/news/listall.php?ordertype=id&zone_id=37"
            },
            {
               "type":"view",
               "name":"本校综合查询",
               "url":"http://www.daxuem.com/weiwangzhan/ios/index.php"
            }]
	    },
			
          {
           "name":"其他",
           "sub_button":[
		    {
               "type":"view",
               "name":"关于我们",
                "url":"http://www.daxuem.com/weixin/about.html"
            },
            {
               "type":"click",
               "name":"留言互动",
               "key":"hudong"
            },
           {	
               "type":"view",
               "name":"地图周边",
               "url":"http://map.baidu.com/mobile/webapp/index/index/foo=bar/vt=map/?third_party=ucsearchbox"
            },					
		
			{	
               "type":"view",
               "name":"30万教师查询",
               "url":"http://www.daxuem.com/weixin/jiaowu/biaodan.php"
            },	
            {
               "type":"view",
               "name":"2000大学查询",
               "url":"http://www.daxuem.com/weixin/2000u.php"
            }]
       }
	   ]
 }';
echo createMenu($data);
//echo getMenu();
//echo deleteMenu();?>