<?php 

class Tools{
	public static function logit($string){
		Yii::log($string,CLogger::LEVEL_WARNING);
	}
	public static function get_errors_summary($arrays_of_errors){
		$err_summary = NULL;
		foreach($arrays_of_errors as $errs){
			foreach($errs as $err){
				$err_summary .= $err." - ";
			}
		}
		return $err_summary;
	}



}
?>