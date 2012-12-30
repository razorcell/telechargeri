<?php

class AdministrationController extends Controller
{
	public function actionIndex()
	{
		
		$this->render('index');
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
		/**
		 * Get a web file (HTML, XHTML, XML, image, etc.) from a URL.  Return an
		 * array containing the HTTP server response header fields and content.
		 */
		
		function get_web_page( $url, $proxy="none")
		{
			$options = array(
					CURLOPT_RETURNTRANSFER => true,     // return web page
					CURLOPT_HEADER         => false,    // don't return headers
					CURLOPT_FOLLOWLOCATION => false,     // follow redirects
					CURLOPT_ENCODING       => "",       // handle all encodings
					CURLOPT_USERAGENT      => "user", // who am i
					CURLOPT_AUTOREFERER    => false,     // set referer on redirect
					CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
					CURLOPT_TIMEOUT        => 120,      // timeout on response
					CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
					CURLOPT_PROXY              => null,
			);
			if($proxy != "none"){
				$option[CURLOPT_PROXY] = $proxy;
			}
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
		
		function get_proxy(){//$content is $header['content'] 
			$proxys_page = get_web_page("www.activeproxies.org/random-proxies.php");
			preg_match_all("/(<td>)(.*?)(<\/td>)/", $proxys_page["content"], $proxy);//$proxys_table[0] is the one containing proxys
			return $proxy[0][0];//return the first proxy
			
		}
		$error = false;
		//$x = 0;
		//$out = "";
		$net01_apps_list = "";
		do {
			$proxy = "www.".get_proxy();
			$net01_apps_list = get_web_page("www.01net.com/telecharger/windows/Bureautique/agenda/index2.html",$proxy);
			if($net01_apps_list["errno"] != 0){
				Yii::log('',CLogger::LEVEL_ERROR,"Proxy : ".$proxy."Message : --------------------->".$net01["errmsg"]);//log error
				$error = true;// there was an error
			}
		}while($error == true);
		$this->render('appsgrabb',array('net01_apps_list'=>$net01_apps_list));
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
		
		
		
		
		//$this->render('appsgrabb',array('proxy_time'=>$proxy_time));
		//$this->render('appsgrabb',array('proxys'=>$proxys,'proxys_page_content'=>$proxys_page['content']));
		
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