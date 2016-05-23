<?php
/**
 * Created by PhpStorm.
 * User: chris.duan
 * Date: 15-12-2
 * Time: 下午4:44
 */
namespace  Org\My;
class Tool{
    /*
     * @param array $data 要编码的字符
     * @access public
     */
    static public function json($data){
        header('Content-type: text/json');
        echo json_encode($data);
    }
}