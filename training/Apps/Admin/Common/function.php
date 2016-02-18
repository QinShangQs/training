<?php
/**
 * 上传文件
 * @param unknown $file
 * @param string $rootPath
 * @param number $maxSize
 * @param unknown $exts
 * @param string $randomSaveName
 * @return stdClass
 */
function upload($file, $maxSize = 3145728, $exts = array(), $rootPath = '', $randomSaveName = true,$saveName = "") {
	if(empty($rootPath)){
		$rootPath = C('IMAGE_PATH');
	}
	
	$upload = new \Think\Upload ();
	$upload->maxSize = $maxSize;
	if (! $randomSaveName){
		$upload->saveName = $saveName;
	}
	$upload->exts = $exts;
	$upload->rootPath = $rootPath;
	
	$info = $upload->uploadOne ( $file );
	$res = new stdClass ();
	if (! $info) {
		$res->success = false;
		$res->message = $upload->getError ();
		$res->filePath = "";
	} else {
		$res->success = true;
		$res->message = "上传成功";
		$res->filePath = str_replace("./", "", $rootPath) . $info ['savepath'] . $info ['savename'];
		$res->savename = $info ['savename'];
	}
	
	return $res;
}