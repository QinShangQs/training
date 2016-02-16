<?php

namespace Admin\Repository;

class LessonRepository extends BaseRepository {
	private $_repository = null;
	public function __construct() {
		$this->_repository = M ( 'Lesson' );
	}
	
	const STATE_READY = '报名中';
	const STATE_FULL = '已爆满';
	
	public function getById($id) {
		return $this->_repository->getById ( $id );
	}
	public function findAll($profileId=0, $state=null) {
		$conditions = array ();
		if (is_numeric ( $profileId ) && $profileId > 0) {
			$conditions ['profile_id'] = array (
					'eq',
					$profileId 
			);
		}
		if(!empty($state)){
			$conditions ['state'] = array (
					'eq',
					$state
			);
		}
		return $data = $this->_repository->where ( $conditions )->select ();
	}
}