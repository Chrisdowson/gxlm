<?php
/**
 * Created by PhpStorm.
 * User: chris.duan
 * Date: 15-12-5
 * Time: 下午4:06
 */
namespace Admin\Model;
use Think\Model;
class TikuModel extends Model{
    protected $tableName = 'problems';
    protected $_validate = array(
        array('id','require','id必须存在'),
        array('title','require','title必须存在'),
        array('type','require','type必须存在'),
        array('category','require','category必须存在'),
        array('answer','require','answer必须存在')
    );
}