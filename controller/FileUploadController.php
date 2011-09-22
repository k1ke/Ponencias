<?php
include_once dirname(__FILE__)."/../_exceptions/FileUploadException.php";

class FileUploadController{
    	
	public static function upload($filename,  $usuario, $extensiones = array("doc", "docx", "pdf")){
		$fname = $_FILES[$filename]['name'];
		$ftype = $_FILES[$filename]['type'];
		$fsize = $_FILES[$filename]['size'];
		$ftemp = $_FILES[$filename]['tmp_name'];
		
		if(in_array($ftype, $formats) && $fsize < 3500000){
			if(!move_uploaded_file($ftemp, "ponencias/" . $usuario->getAlias() . '/' . $fname )){
				throw FileUploadException("Cant move file", $fname, 1);
			}
		}else{
			throw FileUploadException("Extension problem", $fname, 2);
		}
	}
}