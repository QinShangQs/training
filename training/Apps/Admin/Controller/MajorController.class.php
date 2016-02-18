<?php
namespace Admin\Controller;

use Think\Controller;
use Admin\Repository\MajorRepository;
use Admin\Repository\BaseRepository;
class MajorController extends Controller {
	private $_majorRepository;
	public function __construct() {
		parent::__construct ();
		$this->_majorRepository = new MajorRepository();
	}
	
	public function index(){
		$this->assign ( "productTeachers", $this->_teacherRepository->findAll ( BaseRepository::PRO_PRODUCT ) );
		$this->assign ( "uiTeachers", $this->_teacherRepository->findAll ( BaseRepository::PRO_UI ) );
		$this->display();
	}
	
}