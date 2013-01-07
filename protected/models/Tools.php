<?php 

class Tools{
	public function time_elapsed($nowtime,$oldtime){
		$secs = $nowtime-$oldtime;
		$bit = array(
				' year'        => $secs / 31556926 % 12,
				' week'        => $secs / 604800 % 52,
				' day'        => $secs / 86400 % 7,
				' hour'        => $secs / 3600 % 24,
				' minute'    => $secs / 60 % 60,
				' second'    => $secs % 60
		);
			
		foreach($bit as $k => $v){
			if($v > 1)$ret[] = $v . $k . 's';
			if($v == 1)$ret[] = $v . $k;
		}
		array_splice($ret, count($ret)-1, 0, 'and');
		$ret[] = 'ago.';
			
		return join(' ', $ret);
	}
	public function logit($string){
		Yii::log($string,CLogger::LEVEL_WARNING);
	}
	public function get_errors_summary($arrays_of_errors){
		$err_summary = NULL;
		foreach($arrays_of_errors as $errs){
			foreach($errs as $err){
				$err_summary .= $err." - ";
			}
		}
		return $err_summary;
	}
	public function log_text($text){
		$filename = dirname(__FILE__).'/../runtime/logfile';
		if(!$handler = fopen($filename,'a')){
			fclose($handler);
			exit;
		}else{
			fwrite($handler, strftime('%c')." : ".$text."\n");
		}
	}
	public  function clean_name($string){
		$string = str_replace("\">", "", $string);
		$string = str_replace("</a>", "", $string);
		return $string;
	}
	public function get_web_page( $url, $proxy = null)
	{
		$options = array(
				CURLOPT_RETURNTRANSFER => true,     // return web page
				CURLOPT_HEADER         => false,    // don't return headers
				CURLOPT_FOLLOWLOCATION => true,     // follow redirects
				CURLOPT_ENCODING       => "",       // handle all encodings
				CURLOPT_USERAGENT      => "user", // who am i
				CURLOPT_AUTOREFERER    => true,     // set referer on redirect
				CURLOPT_CONNECTTIMEOUT => 6,      // timeout on connect
				CURLOPT_TIMEOUT        => 6,      // timeout on response
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
	/// http://proxy-ip-list.com/free-usa-proxy-ip.html
	//http://proxy-ip-list.com/free-usa-proxy-ip.html
	//http://www.slyhold.com/proxy_any_any.txt
	//http://www.freeproxy.ch/proxy.txt
	public function get_proxy3(){
		$proxies_sources = array("proxynova"=>"http://www.proxynova.com/proxy_list.txt",
				"multiproxy"=>"http://multiproxy.org/txt_anon/proxy.txt",
				"proxies"=>"http://www.pr0xies.org/");
		$proxy_source = array("freeproxy"=>"http://www.proxynova.com/proxy_list.txt");
		$data = NULL;
		do{
			$random_proxy_source_index = array_rand($proxy_source,1);
			$random_proxy_source = $proxy_source[$random_proxy_source_index];
			$data = $this->get_web_page($random_proxy_source);
			if($data["errno"] != 0 || $data["http_code"] != 200){
				$this->log_text($random_proxy_source_index." : ERROR can't get proxies list page - Curl error : ".$data["errno"]."    -  HTTP CODE : ".$data["http_code"]);
			}
		}while($data["errno"] != 0 || $data["http_code"] != 200);
		preg_match_all("#([0-9]{1,3}\.){3}[0-9]{1,3}:[0-9]{2,6}#", $data["content"], $proxys);
		$fast_proxies = $this->get_from_array($proxys[0],0,400);
		$random_index = array_rand($fast_proxies,1);
		$random_proxy = $fast_proxies[$random_index];
		Status::model()->updateByPk(1, array("total_proxies"=>count($fast_proxies)));

		//$this->log_text('Number of proxies : '.count($global_proxy_list));
		return $random_proxy;//array  [0] array IP:PORT
	}
	public function get_proxy2(){
		$proxies_sources = array("proxynova"=>"http://www.proxynova.com/proxy_list.txt",
				"multiproxy"=>"http://multiproxy.org/txt_anon/proxy.txt",
				"proxies"=>"http://www.pr0xies.org/");
		$global_proxy_list = array();
		foreach($proxies_sources as $name=>$source){
			$data = $this->get_web_page($source);
			if($data["errno"] != 0 || $data["http_code"] != 200){
				$this->log_text($name." : ERROR can't get proxies list page - Curl error : ".$data["errno"]."    -  HTTP CODE : ".$data["http_code"],CLogger::LEVEL_ERROR);
			}else{
				//we got proxies list
				preg_match_all("#([0-9]{1,3}\.){3}[0-9]{1,3}:[0-9]{2,6}#", $data["content"], $proxys);
				$global_proxy_list = array_merge($global_proxy_list,$proxys[0]);
			}
		}
		$random_index = array_rand($global_proxy_list,1);
		$random_proxy = $global_proxy_list[$random_index];
		Status::model()->updateByPk(1, array("total_proxies"=>count($global_proxy_list)));

		//$this->log_text('Number of proxies : '.count($global_proxy_list));
		return $random_proxy;//array  [0] array IP:PORT
	}
	public function get_proxy(){
		do{//proxies list 1
			$data = $this->get_web_page("http://www.aliveproxy.com/fastest-proxies/");
			if($data["errno"] != 0 || $data["http_code"] != 200){
				Yii::log("aliveproxy : can't get proxies list page - Curl error : ".$data["errno"]."    -  HTTP CODE : ".$data["http_code"],CLogger::LEVEL_ERROR);
			}
		}while($data["errno"] != 0 || $data["http_code"] != 200);
		//we got proxies list
		$data = preg_replace('/\s+/', '', $data["content"]);
		$data = htmlentities($data,ENT_IGNORE);
		preg_match_all("#[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\:[0-9]{2,4}#", $data, $proxys);

		$random_index = array_rand($proxys[0],1);
		$random_proxy = $proxys[0][$random_index];
		Status::model()->updateByPk(1, array("total_proxies"=>count($proxys[0])));
		return $random_proxy;//array  [0] array IP:PORT
	}
	public function get_page($url){
		Yii::log('-----------get_page()',CLogger::LEVEL_WARNING);
		$page = NULL;
		do {//while we did not get the page
			$got_page = true;//if false last time, we need to initialize it again to true
			$proxy = $this->get_proxy();
			$page = $this->get_web_page($url,$proxy);
			if($page["errno"] != 0 || $page["http_code"] != 200) {//ERROR OCCURED
				Yii::log("Page : ".$url."   Proxy : ".$proxy."Message : ".$page["errmsg"]."   -   HTTP CODE : ".$page["http_code"],CLogger::LEVEL_ERROR);
				$got_page = false;
			}else{
				Yii::log("SUCCESS : ".$url,CLogger::LEVEL_WARNING);
				Status::model()->updateAll(array("current_proxy"=>$proxy),"id=1");
				Yii::log("--------------->Using proxy : ".$proxy,CLogger::LEVEL_WARNING);
			}
		}while($got_page == false);
		return $page;
	}
	public function get_from_array($arr, $start, $length)
	{
		$sliced = array();
		foreach ($arr as $k => $v)
		{
			if ($start <= $k && $k <= $start + $length - 1)
			{
				$sliced[] = $v;
				if (count($sliced) == $length) break;
			}
		}
		return $sliced;
	}
	



	/*
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
	Yii::log("message", CLogger::LEVEL_WARNING, "category");
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