<?php
namespace Admin\Controller;

use Think\Controller;
use Admin\Repository\ProfileItemRepository;
use Admin\Repository\LessonRepository;

class LessonController extends Controller {
	private $_lessonRepository;
	public function __construct() {
		parent::__construct ();
		$this->_lessonRepository = new LessonRepository();
	}
	
	public function index(){
		$this->assign('galleries', $this->_galleryRepository->findAll());
		$this->display();
	}
}