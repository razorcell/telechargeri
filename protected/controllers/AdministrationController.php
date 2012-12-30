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
		function get_web_page( $url )
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
			);
		
			$ch      = curl_init( $url );
			curl_setopt_array( $ch, $options );
			$content = curl_exec( $ch );
// 			$err     = curl_errno( $ch );
// 			$errmsg  = curl_error( $ch );
			$header  = curl_getinfo( $ch );
			curl_close( $ch );
			
// 			$header['errno']   = $err;
// 			$header['errmsg']  = $errmsg;
			$header['content'] = $content;
			return $header;
		}
		$proxys_page = get_web_page("http://www.activeproxies.org/random-proxies.php");
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
			
		}
		
		$this->render('appsgrabb',array('proxy_time'=>$proxy_time));
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