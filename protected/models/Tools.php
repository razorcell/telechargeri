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
	
	
	
	//down here are some real SHIT CRAP
	function get_web_page($url,$proxy = null)
	{
		$options = array(
				CURLOPT_RETURNTRANSFER => true,     // return web page
				CURLOPT_HEADER         => false,    // don't return headers
				CURLOPT_FOLLOWLOCATION => true,     // follow redirects
				CURLOPT_ENCODING       => "",       // handle all encodings
				CURLOPT_USERAGENT      => "user", // who am i
				CURLOPT_AUTOREFERER    => true,     // set referer on redirect
				CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
				CURLOPT_TIMEOUT        => 120,      // timeout on response
				CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
				CURLOPT_PROXY              => $proxy,
		);
		$ch      = curl_init( $url );
		curl_setopt_array( $ch, $options );
		$content = curl_exec( $ch );
		$err     = curl_errno( $ch );
		$errmsg  = curl_error( $ch );
		$header  = curl_getinfo( $ch );
		curl_close( $ch );
			
		$header['errno']   = $err;
		$header['errmsg']  = $errmsg;
		$header['content'] = $content;
		return $header;
	}
	/*
	 function get_proxy(){//$content is $header['content']
	$proxy = "";
	do{
	$proxys_page = get_web_page("www.activeproxies.org/random-proxies.php",null);
	preg_match_all("/(<td>)(.*?)(<\/td>)/", $proxys_page["content"], $proxy1);//$proxy1[0] is the one containing proxys
	preg_match("#[A-Z]*\.[A-Z]{1,3}#", $proxy1[0][0], $proxy2);//$proxys_table[0] is the one containing proxys
	Yii::log("possible proxy : ".strtolower($proxy2[0]),CLogger::LEVEL_WARNING);
	$proxy = strtolower($proxy2[0]);
	
	}while(strlen($proxy) < 5);//we assume that a good domaine name xx.fr
	Yii::log("Final proxy proxy : ".$proxy,CLogger::LEVEL_WARNING);
	return $proxy;//return the proxy in lowercase
	
	}
	Yii::log("message", CLogger::LEVEL_WARNING, "category");*/
	function get_proxy(){
		do{
			$data = get_web_page("http://www.aliveproxy.com/fastest-proxies/");
			if($data["errno"] != 0 || $data["http_code"] != 200){
				Yii::log("can't get proxies list page - Curl error : ".$data["errno"]."    -  HTTP CODE : ".$data["http_code"],CLogger::LEVEL_ERROR);
			}
		}while($data["errno"] != 0 || $data["http_code"] != 200);
		//we got proxies list
		$data = preg_replace('/\s+/', '', $data["content"]);
		$data = htmlentities($data,ENT_IGNORE);
		preg_match_all("#[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\:[0-9]{2,4}#", $data, $proxys);
	
		$random_index = array_rand($proxys[0],1);
		$random_proxy = $proxys[0][$random_index];
		return $random_proxy;//array  [0] array IP:PORT
	}
	function test_get_one_page(){
		
	
	$got_current_apps_list = true;
	do {//get the current page
		$got_current_apps_list = true;//if false last time, we need to initialize it again to true
		Yii::log('get page not found',CLogger::LEVEL_WARNING);
		//Yii::log('',CLogger::LEVEL_WARNING,"Proxy : ".$proxy."         - Index : ".$index);
		$current_proxy = get_proxy();
		$current_apps_list = get_web_page("www.01net.com/telecharger/windows/Bureautique/agenda/index101.html",$current_proxy);
		if($current_apps_list["errno"] != 0 || $current_apps_list["http_code"] != 200) {//ERROR OCCURED
			Yii::log("   Proxy : ".$current_proxy."Message : ".$current_apps_list["errmsg"]."   -   HTTP CODE : ".$current_apps_list["http_code"],CLogger::LEVEL_ERROR);
			$got_current_apps_list = false;
		}else{
			Yii::log("SUCCESS",CLogger::LEVEL_WARNING);
			Yii::log("--------------->Using proxy : ".$current_proxy,CLogger::LEVEL_WARNING);
			//$current_apps_list_withoutspaces = preg_replace('/\s+/', '', $current_apps_list["content"]);
			//if(strpos($current_apps_list_withoutspaces, "Pagenontrouve") != FALSE){
				
			$this->render('index',array('res'=>strpos($current_apps_list["content"], "Page non trouv"),
					'content'=>$current_apps_list["content"]
			));
			//	}
		}
	}while($got_current_apps_list == false);
	}
	/*
	 function get_proxy2(){
	$proxys_1 = get_proxys1();
	$rnd = array_rand($proxys_1,1);
	$rnd_proxy = $proxys_1[$rnd];
	Yii::log("Random proxy : ".$rnd_proxy,CLogger::LEVEL_WARNING);
	//http://www.hidemyass.com/proxy-list/search-227956
		
	$data = get_web_page("http://www.hidemyass.com/proxy-list/search-227956",$rnd_proxy);
	Yii::log("Error number : ".$data["errno"],CLogger::LEVEL_WARNING);
	$data = preg_replace('/\s+/', '', $data["content"]);
	$data = htmlentities($data,ENT_IGNORE);
	preg_match_all("#[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}#", $data, $proxys);
	return $data;
	}*/



}
?>