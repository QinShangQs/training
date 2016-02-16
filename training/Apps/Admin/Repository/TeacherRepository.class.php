<?php

namespace Admin\Repository;

class TeacherRepository extends BaseRepository {
	private $_repository = null;
	public function __construct() {
		$this->_repository = M ( 'Teacher' );
	}
	public function getById($id) {
		return $this->_repository->getById ( $id );
	}
	public function findAll($profileId) {
		$conditions = array ();
		if (is_numeric ( $profileId ) && $profileId > 0) {
			$conditions ['profile_id'] = array (
					'eq',
					$profileId 
			);
		}
		return $data = $this->_repository->where ( $conditions )->select ();
	}
}