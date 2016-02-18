<?php
namespace Admin\Controller;

use Think\Controller;
use Admin\Repository\GalleryRepository;
class GalleryController extends Controller {
	private $_galleryRepository;
	public function __construct() {
		parent::__construct ();
		$this->_galleryRepository = new GalleryRepository();
	}
	
	public function index(){
		$this->assign('galleries', $this->_galleryRepository->findAll());
		$this->display();
	}
	
	public function delete($id){
		$result = array('success'=>false,'message'=>'失败！');
		$instance = $this->_galleryRepository->getById($id);
		if(empty($instance)){
			$result['message'] = '找不到该记录！';
		}else{
			$success = $this->_galleryRepository->remove($id);
			$success = (bool)$success;
			$result['success'] =  $success;
			$result['message'] = $success ? '删除成功！' :'系统异常请稍候重试！' ;
		}
	
		$this->ajaxReturn($result);
	}
	
	public function create(){
		$uploadConfig = array (
				$_FILES ['photo1'],
				1024*1024,
				array (
						'jpg','png','jpeg'
				)
		);
		
		$uploadResult = upload ( $uploadConfig [0], $uploadConfig [1], $uploadConfig [2] );
		if ($uploadResult->success) {
			$data ['image_url'] = $uploadResult->filePath;
			$this->_galleryRepository->add($data ['image_url']);
			$this->success ( $uploadResult->message,'index' );
		} else {
			$this->error ( $uploadResult->message ,'index');
		}
	}
	
	public function doEdit($edit_id){
		$uploadConfig = array (
				$_FILES ['photo2'],
				1024*1024,
				array (
						'jpg','png','jpeg'
				)
		);
		
		$uploadResult = upload ( $uploadConfig [0], $uploadConfig [1], $uploadConfig [2] );
		if ($uploadResult->success) {
			$data ['image_url'] = $uploadResult->filePath;
			$this->_galleryRepository->save($edit_id,$data ['image_url']);
			$this->success ( $uploadResult->message,'index' );
		} else {
			$this->error ( $uploadResult->message ,'index');
		}
	}
	
}