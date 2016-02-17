<?php

namespace Home\Controller;

use Think\Controller;
use Admin\Repository\GalleryRepository;
use Admin\Repository\ProfileItemRepository;
use Admin\Repository\BaseRepository;
use Admin\Repository\MajorRepository;
use Admin\Repository\TeacherRepository;
use Admin\Repository\LessonRepository;
use Admin\Repository\LessonRegisterRepository;
use Admin\Repository\ApplyTeacherRepository;

class IndexController extends Controller {
	private $_galleryRepository;
	private $_profileItemRepository;
	private $_majorRepository;
	private $_teacherRepository;
	private $_lessonRepository;
	private $_lessonRegisterRepository;
	private $_applyTeacherRepository;
	public function __construct() {
		parent::__construct ();
		$this->_galleryRepository = new GalleryRepository ();
		$this->_profileItemRepository = new ProfileItemRepository ();
		$this->_majorRepository = new MajorRepository ();
		$this->_teacherRepository = new TeacherRepository ();
		$this->_lessonRepository = new LessonRepository ();
		$this->_lessonRegisterRepository = new LessonRegisterRepository ();
		$this->_applyTeacherRepository = new ApplyTeacherRepository ();
	}
	public function index() {
		$galleries = $this->_galleryRepository->findAll ();
		$this->assign ( "galleries", $galleries );
		$this->assign ( "galleriesCount", count ( $galleries ) );
		$this->assign ( "productItems", $this->_profileItemRepository->findAll ( BaseRepository::PRO_PRODUCT ) );
		$this->assign ( "uiItems", $this->_profileItemRepository->findAll ( BaseRepository::PRO_UI ) );
		$this->assign ( "productMajors", $this->_majorRepository->findAll ( BaseRepository::PRO_PRODUCT ) );
		$this->assign ( "uiMajors", $this->_majorRepository->findAll ( BaseRepository::PRO_UI ) );
		$this->assign ( "productTeachers", $this->_teacherRepository->findAll ( BaseRepository::PRO_PRODUCT ) );
		$this->assign ( "uiTeachers", $this->_teacherRepository->findAll ( BaseRepository::PRO_UI ) );
		$this->assign ( "lessons", $this->_lessonRepository->findAll () );
		$this->assign ( "lessons_register", $this->_lessonRepository->findAll ( 0, LessonRepository::STATE_READY ) );
		$this->display ();
	}
	private static function result($success, $message) {
		return array (
				'success' => $success,
				'message' => $message 
		);
	}
	public function lessonRegister($name, $mobile, $tencent, $lesson_id) {
		$name = trim ( $name );
		$old = $this->_lessonRegisterRepository->getByName ( $name );
		if (! empty ( $old )) {
			$this->ajaxReturn(static::result ( false, '您已经报名过了！' )) ;
		}
		$lesson = $this->_lessonRepository->getById ( $lesson_id );
		$suc = $this->_lessonRegisterRepository->add ( $name, $mobile, $tencent, $lesson_id, $lesson ['profile_id'] );
		if (! empty ( $suc )) {
			$this->ajaxReturn(static::result ( true, '恭喜您，报名成功！' ));
		} else {
			$this->ajaxReturn(static::result ( true, '系统错误，请稍后重试！' ));
		}
	}
	public function applyRegister($name, $mobile, $tencent, $profile_id) {
		$name = trim ( $name );
		$old = $this->_applyTeacherRepository->getByName ( $name );
		if (! empty ( $old)) {
			$this->ajaxReturn(static::result ( false, '您已经申请过了！' ));
		}
		$suc = $this->_applyTeacherRepository->add ( $name, $mobile, $tencent, $profile_id );
		if (! empty ( $suc )) {
			$this->ajaxReturn( static::result ( true, '恭喜您，您的申请已成功提交！' ));
		} else {
			$this->ajaxReturn( static::result ( true, '系统错误，请稍后重试！' ));
		}
	}
}