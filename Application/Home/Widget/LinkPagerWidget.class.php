<?php
/**
 * Created by PhpStorm.
 * User: chrisdowson.duan
 * Date: 15-12-10
 * Time: 下午2:58
 */
namespace Home\Widget;
use Think\Controller;
class LinkPagerWidget extends Controller{
    public function LinkPager($pagecount, $pagenow, $category){
        $category = $category?$category:0;
        $pager = '<div class="pagination pagination-centered"><ul>';
            if($pagenow>1){
                $pager.='<li><a href="?pagenow='.($pagenow-1).'&category='.$category.'">上一页</a></li>';
            }

            if($pagenow<=5){
                for($i=1;$i<$pagenow;$i++){
                    $pager.='<li><a href="?pagenow='.$i.'&category='.$category.'">'.$i.'</a></li>';
                }
                    $pager.='<li class="active"><a href="?pagenow='.$pagenow.'&category='.$category.'">'.$pagenow.'</a></li>';
                for($j=$pagenow+1;$j<=(10<$pagecount?10:$pagecount);$j++){
                    $pager.='<li><a href="?pagenow='.$j.'&category='.$category.'">'.$j.'</a></li>';
                }
            }else{
                for($i=$pagenow-4;$i<$pagenow;$i++){
                    $pager.='<li><a href="?pagenow='.$i.'&category='.$category.'">'.$i.'</a></li>';
                }
                    $pager.='<li class="active"><a href="?pagenow='.$pagenow.'&category='.$category.'">'.$pagenow.'</a></li>';
                for($j=$pagenow+1;$j<=$pagenow+5;$j++){
                    $pager.='<li><a href="?pagenow='.$j.'&category='.$category.'">'.$j.'</a></li>';
                }
            }

            if($pagenow<$pagecount){
                $pager.='<li><a href="?pagenow='.($pagenow+1).'&category='.$category.'">下一页</a></li>';
            }

        $pager.='</ul></div>';
        echo $pager;
    }
}