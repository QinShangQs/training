<?php
namespace Admin\Controller;

use Think\Controller;
use Admin\Repository\LessonRepository;
use Admin\Repository\LessonRegisterRepository;
use Admin\Repository\Admin\Repository;

class LessonRegisterController extends Controller {
	private $_lessonRegisterRepository;
	private $_lessonRepository;
	public function __construct() {
		parent::__construct ();
		$this->_lessonRegisterRepository = new LessonRegisterRepository();
		$this->_lessonRepository = new LessonRepository();
	}
	
	public function index(){
		$lessons = $this->_lessonRepository->findAll();
		$this->assign('lessons',array_reverse($lessons)) ;
		$this->display();
	}
	
	public function search($key = '', $profile_id=0, $lesson_id=0, $rows, $page) {
		$result = $this->_lessonRegisterRepository->page($key, $profile_id, $lesson_id, $rows, $page);
		$this->ajaxReturn ( $result );
	}
	
	public function delete($id){
		$result = array('success'=>false,'message'=>'失败！');
		$instance = $this->_lessonRegisterRepository->getById($id);
		if(empty($instance)){
			$result['message'] = '找不到该记录！';
		}else{
			$success = $this->_lessonRegisterRepository->remove($id);
			$success = (bool)$success;
			$result['success'] =  $success;
			$result['message'] = $success ? '删除成功！' :'系统异常请稍候重试！' ;
		}
	
		$this->ajaxReturn($result);
	}
}