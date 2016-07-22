<?php

namespace Photos\Controller;

use Think\Controller;

class IndexController extends Controller {
	public function index() {
		$this->display ();
	}
	public function uploadx($name) {
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
		$this->assign('inst', (array)$uploadResult);
		$this->display('result');
	}
}