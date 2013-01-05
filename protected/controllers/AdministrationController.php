<?php
Yii::import('ext.runactions.components.ERunActions');

class AdministrationController extends Controller
{
	public $tools = NULL;
	public $baseurl = NULL;
	public $response = NULL;
	public $downloaded_pages = NULL;

	public function init(){
		$this->tools = new Tools();
		$this->baseurl = Yii::app()->request->baseUrl;
	}
	public function actionGet_scan_info(){
		$status = Status::model()->find("id=1");
		$elapsed_time = $this->tools->time_elapsed(time(),$status->start_time);
		$info = array("elapsed_time"=>$elapsed_time,
				"website"=>$status->website,
				"scanned_apps"=>$status->scanned_apps,
				"os"=>$status->os,
				"category"=>$status->category,
				"section"=>$status->section,
				"list_link"=>$status->list_link,
				"application_link"=>$status->application_link,
				"application_name"=>$status->application_name,
				"downloaded_pages"=>$status->downloaded_pages,
				"applications_added"=>$status->applications_added,
				"applications_updated"=>$status->applications_updated,
				"progression_section"=>$status->progression_section,
				"total_section"=>$status->total_section,
				"progression_category"=>$status->progression_category,
				"total_category"=>$status->total_category,
				"prograssion_os"=>$status->progression_os,
				"total_os"=>$status->total_os);
		echo CJSON::encode($info);
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
					$err_summary = $tools->get_errors_summary($website->errors);
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
			$err_summary = $tools->get_errors_summary($website->errors);
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
				$err_summary = $tools->get_errors_summary($website->errors);
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
			$err_summary = $tools->get_errors_summary($website->errors);
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
					$err_summary = $tools->get_errors_summary($os->errors);
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
			$err_summary = $tools->get_errors_summary($os->errors);
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
					$err_summary = $tools->get_errors_summary($os->errors);
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
			$err_summary = $tools->get_errors_summary($os->errors);
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
					$err_summary = $tools->get_errors_summary($category->errors);
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
			$err_summary = $tools->get_errors_summary($category->errors);
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
					$err_summary = $tools->get_errors_summary($category->errors);
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
			$err_summary = $tools->get_errors_summary($Category->errors);
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
					$err_summary = $tools->get_errors_summary($section->errors);
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
			$err_summary = $tools->get_errors_summary($Section->errors);
			$response = array("err"=>true,
					"message"=>"Database error : ".$err_summary);
		}
		echo CJSON::encode($response);
	}
	public function scan_apps_lists($link_before_index,$os,$category,$section = NULL){
		$global_apps_list = "";
		$index = 2;// using to alter index (x).html for apps lists, it starts from 2 because we have some issues on index1.html, the apps there are not all from the equivalent section
		$pagenotfound = false;// if true than PAGE NOT FOUND REACHED
		$this->tools->log_text("EXTRACT PROCESS STARTED");
		do{//do while we did not reach NOT FOUND PAGE
			$current_apps_list_link_string = $link_before_index."index".$index.".html";
			$current_apps_list = $this->tools->get_page($current_apps_list_link_string);
			Status::model()->updateAll(array("downloaded_pages"=>$this->downloaded_pages++,
					"list_link"=>$current_apps_list_link_string),"id=1");
			if(strpos($current_apps_list["content"], "Page non trouv") === FALSE){
				$regex_app_link = NULL;
				$regex_app_name = NULL;
				if(is_null($section)){
					$regex_app_link = "/(\/telecharger\/".$os."\/".$category."\/fiches\/)((\w|\-){1,19})(\.html\" class=\"resrechlog_nomlogi\">)(.{100})/";
					$regex_app_name = "#(\/telecharger\/".$os."\/".$category."\/fiches\/)((\w|\-){1,19}\.html)|(\"\>.*\<\/a\>)#";
				}else{
					$regex_app_link = "/(\/telecharger\/".$os."\/".$category."\/".$section."\/fiches\/)((\w|\-){1,19})(\.html\" class=\"resrechlog_nomlogi\">)(.{100})/";
					$regex_app_name = "#(\/telecharger\/".$os."\/".$category."\/".$section."\/fiches\/)((\w|\-){1,19}\.html)|(\"\>.*\<\/a\>)#";
				}
				//GREAT !! , get the lines we need
				preg_match_all($regex_app_link, $current_apps_list["content"], $apps_links_names);//extract link and name part 1
				foreach($apps_links_names[0] as $app){//$apps_links_names[0] contains occurences of our search
					preg_match_all($regex_app_name,$app,$link_name);
					$x = 0;
					foreach($link_name[0] as $element){//element is either app link or app name 0 : link 1 : name / 2 : link  3 : name
						if($x % 2 == 0){//this is a link
							$this->tools->log_text("this is a link  : ".$element);
							Status::model()->updateAll(array("application_link"=>$element),"id=1");
						}else{//this is a name
							$query = "UPDATE Status SET scanned_apps = scanned_apps + 1 WHERE id=1";
							Yii::app()->db->createCommand($query)->execute();
							$element = $this->tools->clean_name($element);
							Status::model()->updateAll(array("application_name"=>$element),"id=1");
							$this->tools->log_text("this is a name  : ".$element);
						}
						$global_apps_list .= "\n".$element."\n";//ADD the new apps_names list to the global list
						
						$x++;
					}
				}
				$index++;//go to next page
			}else{
				//404 PAGE NOT FOUND REACHED
				$pagenotfound = true;
				$this->tools->logit("------------------------------> PAGE NOT FOUND");
				$pagenotfound = true;//GET OUT and SHOW APPS LIST
			}
		}while($pagenotfound != true);
		return $global_apps_list;
	}
	public function actionAppsGrabb(){
		$this->render('appsgrabb');
	}
	public function actionStart(){
		if (ERunActions::runBackground())
		{
			$total_section = Section::model()->find();
			$total_category = Category::model()->findAll();
			$total_os  = Os::model()->findAll();
			Status::model()->updateByPk(1,array("total_section"=>count($total_section),
					"total_category"=>count($total_category),
					"total_os"=>count($total_os),
					"scanned_apps"=>0,
					"start_time"=>time()));
			$this->downloaded_pages = 0;
			$progression_os = 0;
			$progression_category = 0;
			$progression_section = 0;
			$website_list = Website::model()->findAll();
			foreach($website_list as $website){
				$os_list = Os::model()->findAll("id_website=".$website->id_website);
				foreach($os_list as $os){
					Status::model()->updateAll(array("progression_os"=>$progression_os++),"id=1");
					$category_list = Category::model()->findAll("id_os="."'".$os->id_os."' && id_website="."'".$website->id_website."'");
					foreach($category_list as $category){
						Status::model()->updateAll(array("progression_category"=>$progression_category++),"id=1");
						$section_list = Section::model()->findAll("id_category="."'".$category->id_category."'");
						$apps_list_link = NULL;
						if(!empty($section_list)){//if this category has sections
							foreach($section_list as $section){
								Status::model()->updateAll(array("progression_section"=>$progression_section++),"id=1");
								$status = Status::model()->updateAll(array("website"=>$website->label_website,
										"os"=>$os->label_os,
										"category"=>$category->label_category,
										"section"=>$section->label_section,"id=1"));
								$apps_list_link = "www.".$website->label_website."/".$os->label_os."/".$category->label_category."/".$section->label_section."/";
								$global_apps_list = $this->scan_apps_lists($apps_list_link,$os->label_os,$category->label_category,$section->label_section);
								$this->tools->log_text("SCANNED : website : ".$website->label_website." - Os : ".$os->label_os." - category : ".$category->label_category." Section : ".$section->label_section." : \n\n\n");
							}
						}else{//if category has NO sections
							$status = Status::model()->updateAll(array("website"=>$website->label_website,
									"os"=>$os->label_os,
									"category"=>$category->label_category,
									"section"=>"No section in this category","id=1"));
							$apps_list_link = "www.".$website->label_website."/".$os->label_os."/".$category->label_category."/";
							$global_apps_list = $this->scan_apps_lists($apps_list_link,$os->label_os,$category->label_category);
							$this->tools->log_text("SCANNED : website : ".$website->label_website." - Os : ".$os->label_os." - category : ".$category->label_category." : \n\n\n".$global_apps_list);
						}
					}
				}
			}
		}//end runBackground
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