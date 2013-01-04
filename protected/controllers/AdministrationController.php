<?php
Yii::import('ext.runactions.components.ERunActions');

class AdministrationController extends Controller
{
	public $baseurl = NULL;
	public $response = NULL;
	public function init(){
		$this->baseurl = Yii::app()->request->baseUrl;
	}
	public function actionIndex()
	{
		$this->render('index');
	}
	public function actionWebsite_list(){
		$website_list = Website::model()->findAll();
		$this->render('websites_list',array(
				'website_list'=>$website_list,
		));
	}
	public function actionWebsite_add(){
		$body = file_get_contents("php://input");
		$json = CJSON::decode($body);
		if(preg_match("#^[0-9a-z-]+(\.(com|fr|net|org|edu|gov|uk|ca|de|jp|au|us|co|c))+$#", $json["label_website"]) > 0){
			$website = new Website();
			$website->setAttribute("label_website", $json["label_website"]);
			$website->setAttribute("language", $json["language"]);
			if(is_null($website->find("label_website='".$json["label_website"]."'"))){
				if($website->save()){
					$response = array("err"=>false,
							"message"=>"The website ".$json["label_website"]." was added successfuly");
				}else{
					$err_summary = Tools::get_errors_summary($website->errors);
					$response = array("err"=>true,
							"message"=>"Database error : ".$err_summary);
				}
			}else{
				$response = array("err"=>true,
						"message"=>"Website already exists : ".$json["label_website"]);
			}
		}else{
			$response = array("err"=>true,
					"message"=>"Website label is rong : ".$json["label_website"]);
		}
		echo CJSON::encode($response);
	}
	public function actionWebsite_edit(){
		$body = file_get_contents("php://input");
		$json = CJSON::decode($body);
		$id_website = $json["id_website"];
		$website = new Website();
		$wanted_website = $website->find("id_website = ".$id_website);
		$response = NULL;
		if(!is_null($wanted_website)){
			$response = array("err"=>false,
					"id_website"=>$wanted_website->id_website,
					"label_website"=>$wanted_website->label_website,
					"language"=>$wanted_website->language);
		}else{
			$err_summary = Tools::get_errors_summary($website->errors);
			$response = array("err"=>true,
					"message"=>"Database error : ".$err_summary);
		}
		echo CJSON::encode($response);
	}
	public function actionWebsite_update(){
		$body = file_get_contents("php://input");
		$json = CJSON::decode($body);
		if(preg_match("#^[0-9a-z-]+(\.(com|fr|net|org|edu|gov|uk|ca|de|jp|au|us|co|c))+$#", $json["label_website"]) > 0){
			$website = new Website();
			$updated_rows = $website->updateAll(array(
					"label_website"=>$json["label_website"],
					"language"=>$json["language"],
			),"id_website=".$json["id_website"]);
			if($updated_rows == 1){
				$response = array("err"=>false,
						"message"=>"The website ".$json["label_website"]." was updated successfuly");
			}elseif($updated_rows == 0){
				$err_summary = Tools::get_errors_summary($website->errors);
				$response = array("err"=>true,
						"message"=>"No rows were updated : ".$err_summary);
			}
		}else{
			$response = array("err"=>true,
					"message"=>"Website label is rong : ".$json["label_website"]);
		}
		echo CJSON::encode($response);
	}
	public function actionWebsite_delete(){
		$body = file_get_contents("php://input");
		$json = CJSON::decode($body);
		$website = new Website();
		$deleted_rows = $website->deleteAll("id_website = ".$json["id_website"]);
		if($deleted_rows == 1){
			$response = array("err"=>false,
					"message"=>"The website ".$json["id_website"]." was deleted successfuly");
		}else{
			$err_summary = Tools::get_errors_summary($website->errors);
			$response = array("err"=>true,
					"message"=>"Database error : ".$err_summary);
		}
		echo CJSON::encode($response);
	}
	public function actionOs_list(){
		$website_list = Website::model()->findAll();
		$os_list = Os::model()->findAll();
		$this->render('os_list',array(
				'os_list'=>$os_list,
				'website_list'=>$website_list
		));
	}
	public function actionOs_add(){
		$body = file_get_contents("php://input");
		$json = CJSON::decode($body);
		if(preg_match("#^[a-zA-Z0-9]{1,30}$#", $json["label_os"]) > 0){
			$os = new Os();
			$os->setAttribute("label_os", $json["label_os"]);
			$os->setAttribute("id_website", $json["id_website"]);
			if(is_null($os->find("label_os='".$json["label_os"]."' && id_website='".$json["id_website"]."'"))){
				if($os->save()){
					$response = array("err"=>false,
							"message"=>"The OS ".$json["label_os"]." was added successfuly");
				}else{
					$err_summary = Tools::get_errors_summary($os->errors);
					$response = array("err"=>true,
							"message"=>"Database error : ".$err_summary);
				}
			}else{

				$response = array("err"=>true,
						"message"=>"The combination (OS / Website) already exists");
			}
		}else{
			$response = array("err"=>true,
					"message"=>"OS label is rong : ".$json["label_os"]);
		}
		echo CJSON::encode($response);
	}
	public function actionOs_edit(){
		$body = file_get_contents("php://input");
		$json = CJSON::decode($body);
		$id_os = $json["id_os"];
		$os = new Os();
		$wanted_os = $os->find("id_os = ".$id_os);
		$response = NULL;
		if(!is_null($wanted_os)){
			$response = array("err"=>false,
					"id_os"=>$wanted_os->id_os,
					"label_os"=>$wanted_os->label_os,
					"id_website"=>$wanted_os->id_website);
		}else{
			$err_summary = Tools::get_errors_summary($os->errors);
			$response = array("err"=>true,
					"message"=>"Database error : ".$err_summary);
		}
		echo CJSON::encode($response);
	}
	public function actionOs_update(){
		$body = file_get_contents("php://input");
		$json = CJSON::decode($body);
		if(preg_match("#^[a-zA-Z0-9]{1,30}$#", $json["label_os"]) > 0){
			$os = new Os();
			if(is_null($os->find("label_os='".$json["label_os"]."' && id_website='".$json["id_website"]."'"))){
				$updated_rows = $os->updateAll(array(
						"label_os"=>$json["label_os"],
						"id_website"=>$json["id_website"],
				),"id_os=".$json["id_os"]);
				if($updated_rows == 1){
					$response = array("err"=>false,
							"message"=>"The OS ".$json["label_os"]." was updated successfuly");
				}elseif($updated_rows == 0){
					$err_summary = Tools::get_errors_summary($os->errors);
					$response = array("err"=>true,
							"message"=>"No rows were updated : ".$err_summary);
				}
			}else{
				$response = array("err"=>true,
						"message"=>"The combination (OS / Website) already exists");
			}
		}else{
			$response = array("err"=>true,
					"message"=>"OS label is rong : ".$json["label_os"]);
		}
		echo CJSON::encode($response);
	}
	public function actionOs_delete(){
		$body = file_get_contents("php://input");
		$json = CJSON::decode($body);
		$os = new Os();
		$deleted_rows = $os->deleteAll("id_os = ".$json["id_os"]);
		if($deleted_rows == 1){
			$response = array("err"=>false,
					"message"=>"The OS ".$json["id_os"]." was deleted successfuly");
		}else{
			$err_summary = Tools::get_errors_summary($os->errors);
			$response = array("err"=>true,
					"message"=>"Database error : ".$err_summary);
		}
		echo CJSON::encode($response);
	}
	public function actionCategory_list(){
		$website_list = Website::model()->findAll();
		$os_list = Os::model()->findAll();
		$category_list = Category::model()->findAll();
		$this->render('category_list',array(
				'os_list'=>$os_list,
				'website_list'=>$website_list,
				'category_list'=>$category_list
		));
	}
	public function actionUpdate_os_list(){
		$body = file_get_contents("php://input");
		$json = CJSON::decode($body);
		$website_os_list = Os::model()->findAll("id_website =".$json["id_website"]);
		if(!empty($website_os_list)){
			$response = array("err"=>false,
					"message"=>"",
					"os_list"=>$website_os_list);
		}else{
			$response = array("err"=>true,
					"message"=>"There is no OS in this Site");
		}
		echo CJSON::encode($response);
	}
	public function actionUpdate_category_list(){
		$body = file_get_contents("php://input");
		$json = CJSON::decode($body);
		$os_category_list = Category::model()->findAll("id_os =".$json["id_os"]);
		if(!empty($os_category_list)){
			$response = array("err"=>false,
					"message"=>"",
					"category_list"=>$os_category_list);
		}else{
			$response = array("err"=>true,
					"message"=>"There is no Categories in this OS");
		}
		echo CJSON::encode($response);
	}
	public function actionCategory_add(){
		$body = file_get_contents("php://input");
		$json = CJSON::decode($body);
		if(preg_match("#^[a-zA-Z0-9\_\-]{1,30}$#", $json["label_category"]) > 0){
			$category = new Category();
			$category->setAttribute("label_category", $json["label_category"]);
			$category->setAttribute("id_website", $json["id_website"]);
			$category->setAttribute("id_os", $json["id_os"]);
			if(is_null($category->find("label_category='".$json["label_category"]."' && id_website='".$json["id_website"]."' && id_os='".$json["id_os"]."'"))){
				if($category->save()){
					$response = array("err"=>false,
							"message"=>"The Category ".$json["label_category"]." was added successfuly");
				}else{
					$err_summary = Tools::get_errors_summary($category->errors);
					$response = array("err"=>true,
							"message"=>"Database error : ".$err_summary);
				}
			}else{

				$response = array("err"=>true,
						"message"=>"The combination (Category / Website / OS )already exists");
			}
		}else{
			$response = array("err"=>true,
					"message"=>"Category label is rong : ".$json["label_os"]);
		}
		echo CJSON::encode($response);
	}
	public function actionCategory_edit(){
		$body = file_get_contents("php://input");
		$json = CJSON::decode($body);
		$category = new Category();
		$wanted_category = $category->find("id_category = ".$json["id_category"]);
		$response = NULL;
		if(!is_null($wanted_category)){
			$response = array("err"=>false,
					"id_category"=>$wanted_category->id_category,
					"label_category"=>$wanted_category->label_category,
					"id_os"=>$wanted_category->id_os,
					"id_website"=>$wanted_category->id_website);
		}else{
			$err_summary = Tools::get_errors_summary($category->errors);
			$response = array("err"=>true,
					"message"=>"Database error : ".$err_summary);
		}
		echo CJSON::encode($response);
	}
	public function actionCategory_update(){
		$body = file_get_contents("php://input");
		$json = CJSON::decode($body);

		if(preg_match("#^[a-zA-Z0-9]{1,30}$#", $json["label_category"]) > 0){
			$category = new Category();
			if(is_null($category->find("label_category='".$json["label_category"]."' && id_website='".$json["id_website"]."' && id_os='".$json["id_os"]."'"))){
				$updated_rows = $category->updateAll(array(
						"label_category"=>$json["label_category"],
						"id_website"=>$json["id_website"],
						"id_os"=>$json["id_os"]
				),"id_os=".$json["id_os"]);
				if($updated_rows == 1){
					$response = array("err"=>false,
							"message"=>"The Category ".$json["label_category"]." was updated successfuly");
				}elseif($updated_rows == 0){
					$err_summary = Tools::get_errors_summary($category->errors);
					$response = array("err"=>true,
							"message"=>"No rows were updated : ".$err_summary);
				}
			}else{
				$response = array("err"=>true,
						"message"=>"The combination (Category / OS / Website) already exists");
			}
		}else{
			$response = array("err"=>true,
					"message"=>"Category label is rong : ".$json["label_os"]);
		}
		echo CJSON::encode($response);
	}
	public function actionCategory_delete(){
		$body = file_get_contents("php://input");
		$json = CJSON::decode($body);
		$Category = new Category();
		$deleted_rows = $Category->deleteAll("id_category = ".$json["id_category"]);
		if($deleted_rows == 1){
			$response = array("err"=>false,
					"message"=>"The Category ".$json["id_category"]." was deleted successfuly");
		}else{
			$err_summary = Tools::get_errors_summary($Category->errors);
			$response = array("err"=>true,
					"message"=>"Database error : ".$err_summary);
		}
		echo CJSON::encode($response);
	}
	public function actionSection_list(){
		$section_list = Section::model()->findAll();
		$website_list = Website::model()->findAll();
		$os_list = Os::model()->findAll();
		$category_list = Category::model()->findAll();
		$this->render('section_list',array(
				'os_list'=>$os_list,
				'website_list'=>$website_list,
				'category_list'=>$category_list,
				'section_list'=>$section_list
		));
	}
	public function actionSection_add(){
		$body = file_get_contents("php://input");
		$json = CJSON::decode($body);
		if(preg_match("#^[a-zA-Z0-9\_\-]{1,30}$#", $json["label_section"]) > 0){
			$section = new Section();
			$section->setAttribute("label_section", $json["label_section"]);
			$section->setAttribute("id_category", $json["id_category"]);
			if(is_null($section->find("label_section='".$json["label_section"]."' && id_category='".$json["id_category"]."'"))){
				if($section->save()){
					$response = array("err"=>false,
							"message"=>"The Section ".$json["label_section"]." was added successfuly");
				}else{
					$err_summary = Tools::get_errors_summary($section->errors);
					$response = array("err"=>true,
							"message"=>"Database error : ".$err_summary);
				}
			}else{

				$response = array("err"=>true,
						"message"=>"The combination (Section / Category) already exists");
			}
		}else{
			$response = array("err"=>true,
					"message"=>"Section label is rong : ".$json["label_os"]);
		}
		echo CJSON::encode($response);
	}
	public function actionSection_delete(){
		$body = file_get_contents("php://input");
		$json = CJSON::decode($body);
		$Section = new Section();
		$deleted_rows = $Section->deleteAll("id_section = ".$json["id_section"]);
		if($deleted_rows == 1){
			$response = array("err"=>false,
					"message"=>"The Section ".$json["id_section"]." was deleted successfuly");
		}else{
			$err_summary = Tools::get_errors_summary($Section->errors);
			$response = array("err"=>true,
					"message"=>"Database error : ".$err_summary);
		}
		echo CJSON::encode($response);
	}
	public function actionAppsGrabb(){
		$tools = new Tools();
		if (ERunActions::runBackground())
		{
			$global_apps_list = "";
			$index = 2;// using to alter index (x).html for apps lists, it starts from 2 because we have some issues on index1.html, the apps there are not all from the equivalent section
			$pagenotfound = false;// if true than PAGE NOT FOUND REACHED
			Tools::logit("EXTRACT PROCESS STARTED");
			do{//do while we did not reach NOT FOUND PAGE
				$current_apps_list = "www.01net.com/telecharger/windows/Bureautique/agenda/index".$index.".html";
				$current_apps_list = $tools->get_page($current_apps_list);
				if(strpos($current_apps_list["content"], "Page non trouv") === FALSE){
					//GREAT !! , get the lines we need
					preg_match_all("/(\/telecharger\/windows\/Bureautique\/agenda\/fiches\/)((\w|\-){1,19})(\.html\" class=\"resrechlog_nomlogi\">)(.{100})/", $current_apps_list["content"], $apps_links_names);//extract link and name part 1
					foreach($apps_links_names[0] as $app){//$apps_links_names[0] contains occurences of our search
						preg_match_all("#(\/telecharger\/windows\/Bureautique\/agenda\/fiches\/)((\w|\-){1,19}\.html)|(\"\>.*\<\/a\>)#",$app,$link_name);
						foreach($link_name[0] as $element){
							$element = Tools::clean_name($element);
							$global_apps_list .= "<p style=\"white-space:nowrap\">".htmlspecialchars($element,ENT_IGNORE)."</p>";//ADD the new apps_names list to the global list
						}
					}
					$index++;//go to next page
				}else{
					//404 PAGE NOT FOUND REACHED
					$pagenotfound = true;
					Tools::logit("------------------------------> PAGE NOT FOUND");
					$pagenotfound = true;//GET OUT and SHOW APPS LIST
					
				}
			}while($pagenotfound != true);
			$this->render('appsgrabb',array('global_apps_list'=>$global_apps_list));
			//Yii::app()->end();
		}
	echo "loading ...";
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