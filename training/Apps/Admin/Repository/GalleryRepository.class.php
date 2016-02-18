<?php

namespace Admin\Repository;

class GalleryRepository extends BaseRepository {
	private $_repository = null;
	public function __construct() {
		$this->_repository = M ( 'Gallery' );
	}
	public function getById($id) {
		return $this->_repository->getById ( $id );
	}
	
	public function add($image_url) {
		$instance = new \stdClass ();
		$instance->image_url = $image_url;
		return $this->_repository->data ( $instance )->add ();
	}
	
	public function save($id,$image_url) {
		$instance = new \stdClass ();
		$instance->id = $id;
		$instance->image_url = $image_url;
		return $this->_repository->data ( $instance )->save ();
	}
	
	public function remove($id){
		return $this->_repository->delete($id);
	}
	
	public function findAll(){
		return $data = $this->_repository->select ();
	}
}