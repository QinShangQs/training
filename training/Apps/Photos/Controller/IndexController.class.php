<?php

namespace Photos\Controller;

use Think\Controller;
use Photos\Repository\PhotosRepository;

class IndexController extends Controller {
	private $_service = null;
	public function __construct(){
		parent::__construct();
		$this->_service = new PhotosRepository();
	}
	
	public function index() {
		$this->display ();
	}
	
	public function detail($id = 0){
		$inst = $this->_service->getById($id);
		if(empty($inst)){
			$this->redirect('index');
		}
		$inst = static::forDownloadUrl($inst,false);
		$this->assign('inst', $inst);
		$this->display();
	}
	
	public function uploadx($name='') {
		$name = trim($name);
		$uploadConfig = array (
				$_FILES ['photo'],
				1024 * 1024 * 10,
				array (
						'jpg',
						'png',
						'gif',
						'jpeg' 
				),
				C('PHOTOS_IMAGE_PATH'),//路径
				false,
				$name
		);
		
		$uploadResult = upload ( $uploadConfig [0], $uploadConfig [1], $uploadConfig [2], $uploadConfig [3], $uploadConfig [4] ,$uploadConfig [5]);
		$uploadResult = (array)$uploadResult;
		if ($uploadResult['success']) {
			$newId = $this->_service->add($uploadResult['savename'], $uploadResult['filePath']);
			$uploadResult['newId'] = $newId;//生成ID
		}
		
		$this->assign('inst', $uploadResult);
		$this->display('result');
	}
	
	private static function forDownloadUrl($rows, $isList = true) {
		if (empty ( $rows ))
			return $rows;
		$domain = "http://" .$_SERVER['HTTP_HOST']. __ROOT__."/";
		if ($isList) {
			foreach ( $rows as $key => $val ) {
				$rows [$key] ['download_url'] =  $domain. $val ['img_path'] ;
			}
		} else {
			$rows ['download_url'] = $domain. $rows ['img_path'];
		}
		return $rows;
	}
	
	public function search($key = '',$page=1, $rows=20){
		$result = $this->_service->page($key, $rows, $page);
		$result['rows'] = static::forDownloadUrl($result['rows']);
		$this->ajaxReturn($result);
	}
	
	public function removes($ids,$imgPaths){ 
		$c = $this->_service->remove($ids);
		if($c > 0){
			$imgs = explode(',', $imgPaths);
			foreach ($imgs as $key=>$val){
				@unlink('./'.$val);
			}
		}
		
		$this->ajaxReturn(array('success'=> $c > 0));
	}
}