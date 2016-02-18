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
		$this->_teacherRepository = new TeacherRepository();
	}
	
	public function index(){
		$this->assign ( "productTeachers", $this->_teacherRepository->findAll ( BaseRepository::PRO_PRODUCT ) );
		$this->assign ( "uiTeachers", $this->_teacherRepository->findAll ( BaseRepository::PRO_UI ) );
		$this->display();
	}
	
}