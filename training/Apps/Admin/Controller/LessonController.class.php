<?php

namespace Admin\Controller;

use Think\Controller;
use Admin\Repository\ProfileItemRepository;
use Admin\Repository\LessonRepository;

class LessonController extends Controller {
	private $_lessonRepository;
	public function __construct() {
		parent::__construct ();
		$this->_lessonRepository = new LessonRepository ();
	}
	public function index() {
		$this->display ();
	}
	public function search($key = null, $profile_id = 0, $state, $rows = 25, $page = 1) {
		$result = $this->_lessonRepository->page ( $key, $profile_id,$state, $rows, $page );
		$this->ajaxReturn($result);
	}
	
	public function create($name, $open_date, $profile_id){
		$success = $this->_lessonRepository->add($name, $open_date, $profile_id);
		if(!empty($success)){
			$this->success('操作成功！', 'index');
		}else{
			$this->error('操作失败，请稍后重试！');
		}
	}
	
	public function edit($id){
		$old = $this->_lessonRepository->getById($id);
		if(empty($old)){
			$this->error('找不到该记录！');
		}
		
		$this->assign('inst', $old);
		$this->display();
	}
	public function doEdit($id,$name, $open_date, $profile_id, $state){
		$success = $this->_lessonRepository->save($id,$name, $open_date, $profile_id, $state);
		if(!empty($success)){
			$this->success('操作成功！', 'index');
		}else{
			$this->error('操作失败，请稍后重试！');
		}
	}
	public function delete($id) {
		$result = array (
				'success' => false,
				'message' => '失败！'
		);
		$instance = $this->_lessonRepository->getById ( $id );
		if (empty ( $instance )) {
			$result ['message'] = '找不到该记录！';
		} else if($instance['peoples'] > 0){
			$result ['success'] = false;
			$result ['message'] = '该课程已有学员报名，不可删除！';
		} else {
			$success = $this->_lessonRepository->remove ( $id );
			$success = ( bool ) $success;
			$result ['success'] = $success;
			$result ['message'] = $success ? '删除成功！' : '系统异常请稍候重试！';
		}
	
		$this->ajaxReturn ( $result );
	}
}