<?php

namespace Admin\Controller;

use Think\Controller;
use Admin\Repository\MajorRepository;
use Admin\Repository\BaseRepository;

class MajorController extends Controller {
	private $_majorRepository;
	public function __construct() {
		parent::__construct ();
		$this->_majorRepository = new MajorRepository ();
	}
	public function index() {
		$this->assign ( "productMajors", $this->_majorRepository->findAll ( BaseRepository::PRO_PRODUCT ) );
		$this->assign ( "uiMajors", $this->_majorRepository->findAll ( BaseRepository::PRO_UI ) );
		$this->display ();
	}
	public function doEdit($id, $name, $descs, $old_price, $price){
		$this->_majorRepository->save($id, $name, $descs, $old_price, $price);
		$this->success('保存成功！','index');
	}
}