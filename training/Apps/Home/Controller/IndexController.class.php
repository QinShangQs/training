<?php
namespace Home\Controller;
use Think\Controller;
use Admin\Repository\GalleryRepository;
use Admin\Repository\ProfileItemRepository;
use Admin\Repository\BaseRepository;
use Admin\Repository\MajorRepository;
use Admin\Repository\TeacherRepository;
class IndexController extends Controller {
	private $_galleryRepository;
	private $_profileItemRepository;
	private $_majorRepository;
	private $_teacherRepository;
	
	public function __construct(){
		parent::__construct();
		$this->_galleryRepository = new GalleryRepository();
		$this->_profileItemRepository = new ProfileItemRepository();
		$this->_majorRepository = new MajorRepository();
		$this->_teacherRepository = new TeacherRepository();
	}
	
    public function index(){
    	$galleries = $this->_galleryRepository->findAll();
    	$this->assign("galleries", $galleries);
    	$this->assign("galleriesCount", count($galleries));
    	$this->assign("productItems", $this->_profileItemRepository->findAll(BaseRepository::PRO_PRODUCT));
    	$this->assign("uiItems", $this->_profileItemRepository->findAll(BaseRepository::PRO_UI));
    	$this->assign("productMajors", $this->_majorRepository->findAll(BaseRepository::PRO_PRODUCT));
    	$this->assign("uiMajors", $this->_majorRepository->findAll(BaseRepository::PRO_UI));
    	$this->assign("productTeachers", $this->_teacherRepository->findAll(BaseRepository::PRO_PRODUCT));
    	$this->assign("uiTeachers", $this->_teacherRepository->findAll(BaseRepository::PRO_UI));
        $this->display();
    }
}