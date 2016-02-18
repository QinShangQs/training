<?php

namespace Admin\Controller;

use Think\Controller;
use Admin\Repository\GalleryRepository;
use Admin\Repository\TeacherRepository;
use Admin\Repository\BaseRepository;

class TeacherController extends Controller {
	private $_teacherRepository;
	public function __construct() {
		parent::__construct ();
		$this->_teacherRepository = new TeacherRepository ();
	}
	public function index() {
		$this->assign ( "productTeachers", $this->_teacherRepository->findAll ( BaseRepository::PRO_PRODUCT ) );
		$this->assign ( "uiTeachers", $this->_teacherRepository->findAll ( BaseRepository::PRO_UI ) );
		$this->display ();
	}
	public function edit($id) {
		$inst = $this->_teacherRepository->getById($id);
		$this->assign('inst',$inst);
		$this->display ();
	}
	
	public function doEdit($id, $name,$come, $degree, $profile_id, $header_image){
		//var_dump($_REQUEST);exit;
		if ($_FILES ['photo1'] ['error'] == 0) {
			$uploadResult = static::uploading();
			if (! $uploadResult->success) {
				$this->error ( $uploadResult->message );
			}
			$header_image = $uploadResult->filePath;
		}
		
		$this->_teacherRepository->save($id,$name ,$come,$degree, $profile_id, $header_image);
		$this->success ( '操作成功！', 'index' );
	}
	
	public function delete($id) {
		$result = array (
				'success' => false,
				'message' => '失败！' 
		);
		$instance = $this->_teacherRepository->getById ( $id );
		if (empty ( $instance )) {
			$result ['message'] = '找不到该记录！';
		} else {
			$success = $this->_teacherRepository->remove ( $id );
			$success = ( bool ) $success;
			$result ['success'] = $success;
			$result ['message'] = $success ? '删除成功！' : '系统异常请稍候重试！';
		}
		
		$this->ajaxReturn ( $result );
	}
	public function create($name, $come, $degree, $profile_id) {
		//var_dump($_REQUEST);exit;
		$uploadResult = static::uploading ();
		if ($uploadResult->success) {
			$data ['image_url'] = $uploadResult->filePath;
			$this->_teacherRepository->add ( $name, $come, $degree, $profile_id, $data ['image_url'] );
			$this->success ( '操作成功！', 'index' );
		} else {
			$this->error ( $uploadResult->message, 'add' );
		}
	}
	private static function uploading() {
		$uploadConfig = array (
				$_FILES ['photo1'],
				1024 * 1024,
				array (
						'jpg',
						'png',
						'jpeg' 
				) 
		);
		
		$uploadResult = upload ( $uploadConfig [0], $uploadConfig [1], $uploadConfig [2] );
		return $uploadResult;
	}
}