<?php

class AdministrationController extends Controller
{
	public function actionIndex()
	{
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
	public function actionWebsite_list(){
		$websites=new CActiveDataProvider('Website');
		$this->render('websites_list',array(
				'websites'=>$websites,
		));
		
	}
	public function actionWebsite_add(){
		
	}
	public function actionAppsGrabb(){
		Yii::log("actionAppsGrabb()",CLogger::LEVEL_WARNING);
		/**
		 * Get a web file (HTML, XHTML, XML, image, etc.) from a URL.  Return an
		 * array containing the HTTP server response header fields and content.
		 */
		
		function get_web_page( $url, $proxy = null)
		{
			$options = array(
					CURLOPT_RETURNTRANSFER => true,     // return web page
					CURLOPT_HEADER         => false,    // don't return headers
					CURLOPT_FOLLOWLOCATION => true,     // follow redirects
					CURLOPT_ENCODING       => "",       // handle all encodings
					CURLOPT_USERAGENT      => "user", // who am i
					CURLOPT_AUTOREFERER    => true,     // set referer on redirect
					CURLOPT_CONNECTTIMEOUT => 30,      // timeout on connect
					CURLOPT_TIMEOUT        => 30,      // timeout on response
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
		function get_page($url){
			Yii::log('-----------get_page()',CLogger::LEVEL_WARNING);
			$page = NULL;
			do {//while we did not get the page
				$got_page = true;//if false last time, we need to initialize it again to true
				$proxy = get_proxy();
				$page = get_web_page($url,$proxy);
				if($page["errno"] != 0 || $page["http_code"] != 200) {//ERROR OCCURED
					Yii::log("Page : ".$url."   Proxy : ".$proxy."Message : ".$page["errmsg"]."   -   HTTP CODE : ".$page["http_code"],CLogger::LEVEL_ERROR);
					$got_page = false;
				}else{
					Yii::log("SUCCESS : ".$url,CLogger::LEVEL_WARNING);
					Yii::log("--------------->Using proxy : ".$proxy,CLogger::LEVEL_WARNING);
				}
			}while($got_page == false);
			return $page;
		}
		
		
		
		
		$global_apps_list = "";
		$index = 2;// using to alter index (x).html for apps lists, it starts from 2 because we have some issues on index1.html, the apps there are not all from the equivalent section
		$pagenotfound = false;// if true than PAGE NOT FOUND REACHED
		Yii::log('',CLogger::LEVEL_WARNING,"EXTRACT PROCESS STARTED");
		do{//do while we did not reach NOT FOUND PAGE
			$current_apps_list = "www.01net.com/telecharger/windows/Bureautique/agenda/index".$index.".html";
			$current_apps_list = get_page($current_apps_list);
			if(strpos($current_apps_list["content"], "Page non trouv") === FALSE){
				//GREAT !! , get the lines we need
				preg_match_all("/(\/telecharger\/windows\/Bureautique\/agenda\/fiches\/)((\w|\-){1,19})(\.html\" class=\"resrechlog_nomlogi\">)(.{100})/", $current_apps_list["content"], $apps_links_names);//extract link and name part 1
				
						
						foreach($apps_links_names[0] as $app){//$apps_links_names[0] contains occurences of our search
							preg_match_all("#(\/telecharger\/windows\/Bureautique\/agenda\/fiches\/)((\w|\-){1,19}\.html)|(\"\>.*\<\/a\>)#",$app,$link_name);
							foreach($link_name[0] as $element){
								$global_apps_list .= "<p style=\"white-space:nowrap\">".htmlspecialchars($element,ENT_IGNORE)."</p>";//ADD the new apps_names list to the global list
							}
							
						}
				$index++;//go to next page
			}else{
				//404 PAGE NOT FOUND REACHED
				$pagenotfound = true;
				Yii::log("------------------------------> PAGE NOT FOUND",CLogger::LEVEL_WARNING);
				//Yii::log("strpos() returned :  ".gettype(strpos($current_apps_list["content"], "Page non trouv")),CLogger::LEVEL_WARNING);
				$pagenotfound = true;//GET OUT and SHOW APPS LIST
				$this->render('appsgrabb',array('global_apps_list'=>$global_apps_list));
			} 
		}while($pagenotfound != true);
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		//$this->render('appsgrabb',array('apps_links_names'=>$apps_links_names));
		//$this->render('appsgrabb',array('global_apps_list'=>$global_apps_list));-------------------------
		
		//$current_apps_list_withoutspaces = preg_replace('/\s+/', '', $current_apps_list["content"]);
		/*
		$proxys_page = get_web_page("www.activeproxies.org/random-proxies.php");
		//$proxys = strstr($proxys_page['content'],'<table>');
		
		preg_match_all("/(<td>)(.*?)(<\/td>)/", $proxys_page['content'], $proxys_table);//$proxys_table[0] is the one containing proxys
		
		$proxy_time = array();
		for($x=0;$x<25;$x++){
			if($x % 5 == 0){
				array_push($proxy_time,array("proxy"=>$proxys_table[0][$x],
						"loading_speed"=>str_replace(' Seconds','',$proxys_table[0][$x+1]),
						"uptime"=>str_replace('%','',$proxys_table[0][$x+2])
																)
								);
			}
		}*/
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}