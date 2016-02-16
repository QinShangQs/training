<?php
namespace Home\Controller;
use Think\Controller;
use Admin\Repository\GalleryRepository;
use Admin\Repository\ProfileItemRepository;
use Admin\Repository\BaseRepository;
class IndexController extends Controller {
	private $_galleryRepository;
	private $_profileItemRepository;
	
	public function __construct(){
		parent::__construct();
		$this->_galleryRepository = new GalleryRepository();
		$this->_profileItemRepository = new ProfileItemRepository();
	}
	
    public function index(){
    	$galleries = $this->_galleryRepository->findAll();
    	$this->assign("galleries", $galleries);
    	$this->assign("galleriesCount", count($galleries));
    	$this->assign("productItems", $this->_profileItemRepository->findAll(BaseRepository::PRO_PRODUCT));
    	$this->assign("uiItems", $this->_profileItemRepository->findAll(BaseRepository::PRO_UI));
    	
        $this->display();
    }
}