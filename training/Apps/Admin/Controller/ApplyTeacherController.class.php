<?php
namespace Admin\Controller;

use Think\Controller;
use Admin\Repository\ApplyTeacherRepository;

class ApplyTeacherController extends Controller {
	private $_applyTeacherRepository;
	public function __construct() {
		parent::__construct ();
		$this->_applyTeacherRepository = new ApplyTeacherRepository();
	}
	
	public function index(){
		$this->display();
	}
	
	public function search($key = '', $profile_id=0, $rows, $page) {
		$result = $this->_applyTeacherRepository->page($key, $profile_id, $rows, $page);
		$this->ajaxReturn ( $result );
	}
	
	public function delete($id){
		$result = array('success'=>false,'message'=>'失败！');
		$instance = $this->_applyTeacherRepository->getById($id);
		if(empty($instance)){
			$result['message'] = '找不到该记录！';
		}else{
			$success = $this->_applyTeacherRepository->remove($id);
			$success = (bool)$success;
			$result['success'] =  $success;
			$result['message'] = $success ? '删除成功！' :'系统异常请稍候重试！' ;
		}
	
		$this->ajaxReturn($result);
	}
}