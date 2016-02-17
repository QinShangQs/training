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
}