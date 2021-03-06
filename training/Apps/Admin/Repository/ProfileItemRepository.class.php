<?php

namespace Admin\Repository;

class ProfileItemRepository {
	private $_repository = null;
	public function __construct() {
		$this->_repository = M ( 'ProfileItem' );
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
	public function save($id, $title, $content) {
		$instance = new \stdClass ();
		$instance->id = $id;
		$instance->title = $title;
		$instance->content = $content;		
		return $this->_repository->data ( $instance )->save ();
	}
}