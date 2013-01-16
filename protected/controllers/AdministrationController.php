<?php

class AdministrationController extends Controller {

    public $tools = NULL;
    public $baseurl = NULL;
    public $response = NULL;
    public $downloaded_pages = NULL;
    public $page_title;

    public function init() {
        $this->tools = new Tools();
        $this->baseurl = Yii::app()->request->baseUrl;
    }
    public function actionLogin(){
        $this->render("login");
    }

    public function actionGet_scan_info() {
        $status = Status::model()->find("id=1");
        $elapsed_time = $this->tools->time_elapsed(time(), $status->start_time);
        $start_finish_time = $this->tools->time_elapsed(intval($status->finish_time), intval($status->start_time));
        $start_finish_time = str_replace("ago", "", $start_finish_time);
        $info = array("elapsed_time" => $elapsed_time,
            "start_finish_time" => $start_finish_time,
            "total_proxies" => $status->total_proxies,
            "current_proxy" => $status->current_proxy,
            "website" => $status->website,
            "scanned_apps" => $status->scanned_apps,
            "os" => $status->os,
            "category" => $status->category,
            "section" => $status->section,
            "list_link" => $status->list_link,
            "application_link" => $status->application_link,
            "application_name" => $status->application_name,
            "downloaded_pages" => $status->downloaded_pages,
            "applications_added" => $status->applications_added,
            "applications_updated" => $status->applications_updated,
            "progression_section" => $status->progression_section,
            "progression_category" => $status->progression_category,
            "progression_os" => $status->progression_os,
            "scan_stat" => $status->scan_stat);
        echo CJSON::encode($info);
    }

    public function actionIndex() {
        $this->page_title = "Home";
        $array = array(1, 2, 3, 4, 5, 6, 7, 8);
        $string = "";
        foreach ($array as $key => $element) {
            if ($key % 2 == 0) {
                $string .= " / current : " . $element . " - next : " . $array[$key + 1];
            }
        }
        $this->render('index', array("string" => $string));
    }

    public function actionApplications() {
        $this->page_title = "Applications";
        $application_list = Application::model()->findAll();
        $category_list = Category::model()->findAll();
        $section_list = Section::model()->findAll();
        $os_list = Os::model()->findAll();
        $this->render("application_list", array("application_list" => $application_list,
            "category_list" => $category_list,
            "section_list" => $section_list,
            "os_list" => $os_list
        ));
    }

    public function actionApplication_delete() {
        $body = file_get_contents("php://input");
        $json = CJSON::decode($body);
        $application = new Application();
        $deleted_rows = $application->deleteAll("id_application = " . $json["id_application"]);
        if ($deleted_rows == 1) {
            $response = array("err" => false,
                "message" => "The Application " . $json["id_application"] . " was deleted successfuly");
        } else {
            $err_summary = $this->tools->get_errors_summary($application->errors);
            $response = array("err" => true,
                "message" => "Database error : " . $err_summary);
        }
        echo CJSON::encode($response);
    }

    public function actionApplication_edit() {
        $body = file_get_contents("php://input");
        $json = CJSON::decode($body);
        $application = new Application();
        $wanted_application = $application->find("id_application = " . $json["id_application"]);
        $response = NULL;
        if (!is_null($wanted_application)) {
            $response = array("err" => false,
                "id_application" => $wanted_application->id_application,
                "description" => $wanted_application->description);
        } else {
            $err_summary = $this->tools->get_errors_summary($application->errors);
            $response = array("err" => true,
                "message" => "Database error : " . $err_summary);
        }
        echo CJSON::encode($response);
    }

    public function actionApplication_update() {
        $body = file_get_contents("php://input");
        $json = CJSON::decode($body);
        $application = new Application();
        $updated_rows = $application->updateAll(array(
            "description" => $json["description"],
                ), "id_application=" . $json["id_application"]);
        if ($updated_rows == 1) {
            $response = array("err" => false,
                "message" => "The application " . $json["id_application"] . " was updated successfuly");
        } elseif ($updated_rows == 0) {
            $err_summary = $this->tools->get_errors_summary($application->errors);
            $response = array("err" => true,
                "message" => "No rows were updated : " . $err_summary);
        }
        echo CJSON::encode($response);
    }

    public function actionWebsite_list() {
        $this->page_title = "Websites";
        $website_list = Website::model()->findAll();
        $this->render('websites_list', array(
            'website_list' => $website_list,
        ));
    }

    public function actionWebsite_add() {
        $body = file_get_contents("php://input");
        $json = CJSON::decode($body);
        if (preg_match("#^[0-9a-z-]+(\.(com|fr|net|org|edu|gov|uk|ca|de|jp|au|us|co|c))+$#", $json["label_website"]) > 0) {
            $website = new Website();
            $website->setAttribute("label_website", $json["label_website"]);
            $website->setAttribute("language", $json["language"]);
            if (is_null($website->find("label_website='" . $json["label_website"] . "'"))) {
                if ($website->save()) {
                    $response = array("err" => false,
                        "message" => "The website " . $json["label_website"] . " was added successfuly");
                } else {
                    $err_summary = $this->tools->get_errors_summary($website->errors);
                    $response = array("err" => true,
                        "message" => "Database error : " . $err_summary);
                }
            } else {
                $response = array("err" => true,
                    "message" => "Website already exists : " . $json["label_website"]);
            }
        } else {
            $response = array("err" => true,
                "message" => "Website label is rong : " . $json["label_website"]);
        }
        echo CJSON::encode($response);
    }

    public function actionWebsite_edit() {
        $body = file_get_contents("php://input");
        $json = CJSON::decode($body);
        $id_website = $json["id_website"];
        $website = new Website();
        $wanted_website = $website->find("id_website = " . $id_website);
        $response = NULL;
        if (!is_null($wanted_website)) {
            $response = array("err" => false,
                "id_website" => $wanted_website->id_website,
                "label_website" => $wanted_website->label_website,
                "language" => $wanted_website->language);
        } else {
            $err_summary = $this->tools->get_errors_summary($website->errors);
            $response = array("err" => true,
                "message" => "Database error : " . $err_summary);
        }
        echo CJSON::encode($response);
    }

    public function actionWebsite_update() {
        $body = file_get_contents("php://input");
        $json = CJSON::decode($body);
        if (preg_match("#^[0-9a-z-]+(\.(com|fr|net|org|edu|gov|uk|ca|de|jp|au|us|co|c))+$#", $json["label_website"]) > 0) {
            $website = new Website();
            $updated_rows = $website->updateAll(array(
                "label_website" => $json["label_website"],
                "language" => $json["language"],
                    ), "id_website=" . $json["id_website"]);
            if ($updated_rows == 1) {
                $response = array("err" => false,
                    "message" => "The website " . $json["label_website"] . " was updated successfuly");
            } elseif ($updated_rows == 0) {
                $err_summary = $this->tools->get_errors_summary($website->errors);
                $response = array("err" => true,
                    "message" => "No rows were updated : " . $err_summary);
            }
        } else {
            $response = array("err" => true,
                "message" => "Website label is rong : " . $json["label_website"]);
        }
        echo CJSON::encode($response);
    }

    public function actionWebsite_delete() {
        $body = file_get_contents("php://input");
        $json = CJSON::decode($body);
        $website = new Website();
        $deleted_rows = $website->deleteAll("id_website = " . $json["id_website"]);
        if ($deleted_rows == 1) {
            $response = array("err" => false,
                "message" => "The website " . $json["id_website"] . " was deleted successfuly");
        } else {
            $err_summary = $this->tools->get_errors_summary($website->errors);
            $response = array("err" => true,
                "message" => "Database error : " . $err_summary);
        }
        echo CJSON::encode($response);
    }

    public function actionOs_list() {
        $this->page_title = "Operating systems";
        $website_list = Website::model()->findAll();
        $os_list = Os::model()->findAll();
        $this->render('os_list', array(
            'os_list' => $os_list,
            'website_list' => $website_list
        ));
    }

    public function actionOs_add() {
        $body = file_get_contents("php://input");
        $json = CJSON::decode($body);
        if (preg_match("#^[a-zA-Z0-9]{1,30}$#", $json["label_os"]) > 0) {
            $os = new Os();
            $os->setAttribute("label_os", $json["label_os"]);
            $os->setAttribute("id_website", $json["id_website"]);
            if (is_null($os->find("label_os='" . $json["label_os"] . "' && id_website='" . $json["id_website"] . "'"))) {
                if ($os->save()) {
                    $response = array("err" => false,
                        "message" => "The OS " . $json["label_os"] . " was added successfuly");
                } else {
                    $err_summary = $this->tools->get_errors_summary($os->errors);
                    $response = array("err" => true,
                        "message" => "Database error : " . $err_summary);
                }
            } else {

                $response = array("err" => true,
                    "message" => "The combination (OS / Website) already exists");
            }
        } else {
            $response = array("err" => true,
                "message" => "OS label is rong : " . $json["label_os"]);
        }
        echo CJSON::encode($response);
    }

    public function actionOs_edit() {
        $body = file_get_contents("php://input");
        $json = CJSON::decode($body);
        $id_os = $json["id_os"];
        $os = new Os();
        $wanted_os = $os->find("id_os = " . $id_os);
        $response = NULL;
        if (!is_null($wanted_os)) {
            $response = array("err" => false,
                "id_os" => $wanted_os->id_os,
                "label_os" => $wanted_os->label_os,
                "id_website" => $wanted_os->id_website);
        } else {
            $err_summary = $this->tools->get_errors_summary($os->errors);
            $response = array("err" => true,
                "message" => "Database error : " . $err_summary);
        }
        echo CJSON::encode($response);
    }

    public function actionOs_update() {
        $body = file_get_contents("php://input");
        $json = CJSON::decode($body);
        if (preg_match("#^[a-zA-Z0-9]{1,30}$#", $json["label_os"]) > 0) {
            $os = new Os();
            if (is_null($os->find("label_os='" . $json["label_os"] . "' && id_website='" . $json["id_website"] . "'"))) {
                $updated_rows = $os->updateAll(array(
                    "label_os" => $json["label_os"],
                    "id_website" => $json["id_website"],
                        ), "id_os=" . $json["id_os"]);
                if ($updated_rows == 1) {
                    $response = array("err" => false,
                        "message" => "The OS " . $json["label_os"] . " was updated successfuly");
                } elseif ($updated_rows == 0) {
                    $err_summary = $this->tools->get_errors_summary($os->errors);
                    $response = array("err" => true,
                        "message" => "No rows were updated : " . $err_summary);
                }
            } else {
                $response = array("err" => true,
                    "message" => "The combination (OS / Website) already exists");
            }
        } else {
            $response = array("err" => true,
                "message" => "OS label is rong : " . $json["label_os"]);
        }
        echo CJSON::encode($response);
    }

    public function actionOs_delete() {
        $body = file_get_contents("php://input");
        $json = CJSON::decode($body);
        $os = new Os();
        $deleted_rows = $os->deleteAll("id_os = " . $json["id_os"]);
        if ($deleted_rows == 1) {
            $response = array("err" => false,
                "message" => "The OS " . $json["id_os"] . " was deleted successfuly");
        } else {
            $err_summary = $this->tools->get_errors_summary($os->errors);
            $response = array("err" => true,
                "message" => "Database error : " . $err_summary);
        }
        echo CJSON::encode($response);
    }

    public function actionCategory_list() {
        $this->page_title = "Categories";
        $website_list = Website::model()->findAll();
        $os_list = Os::model()->findAll();
        $category_list = Category::model()->findAll();
        $this->render('category_list', array(
            'os_list' => $os_list,
            'website_list' => $website_list,
            'category_list' => $category_list
        ));
    }

    public function actionUpdate_os_list() {
        $body = file_get_contents("php://input");
        $json = CJSON::decode($body);
        $website_os_list = Os::model()->findAll("id_website =" . $json["id_website"]);
        if (!empty($website_os_list)) {
            $response = array("err" => false,
                "message" => "",
                "os_list" => $website_os_list);
        } else {
            $response = array("err" => true,
                "message" => "There is no OS in this Site");
        }
        echo CJSON::encode($response);
    }

    public function actionUpdate_category_list() {
        $body = file_get_contents("php://input");
        $json = CJSON::decode($body);
        $os_category_list = Category::model()->findAll("id_os =" . $json["id_os"]);
        if (!empty($os_category_list)) {
            $response = array("err" => false,
                "message" => "",
                "category_list" => $os_category_list);
        } else {
            $response = array("err" => true,
                "message" => "There is no Categories in this OS");
        }
        echo CJSON::encode($response);
    }

    public function actionCategory_add() {
        $body = file_get_contents("php://input");
        $json = CJSON::decode($body);
        if (preg_match("#^[a-zA-Z0-9\_\-]{1,30}$#", $json["label_category"]) > 0) {
            $category = new Category();
            $category->setAttribute("label_category", $json["label_category"]);
            $category->setAttribute("id_website", $json["id_website"]);
            $category->setAttribute("id_os", $json["id_os"]);
            if (is_null($category->find("label_category='" . $json["label_category"] . "' && id_website='" . $json["id_website"] . "' && id_os='" . $json["id_os"] . "'"))) {
                if ($category->save()) {
                    $response = array("err" => false,
                        "message" => "The Category " . $json["label_category"] . " was added successfuly");
                } else {
                    $err_summary = $this->tools->get_errors_summary($category->errors);
                    $response = array("err" => true,
                        "message" => "Database error : " . $err_summary);
                }
            } else {

                $response = array("err" => true,
                    "message" => "The combination (Category / Website / OS )already exists");
            }
        } else {
            $response = array("err" => true,
                "message" => "Category label is rong : " . $json["label_os"]);
        }
        echo CJSON::encode($response);
    }

    public function actionCategory_edit() {
        $body = file_get_contents("php://input");
        $json = CJSON::decode($body);
        $category = new Category();
        $wanted_category = $category->find("id_category = " . $json["id_category"]);
        $response = NULL;
        if (!is_null($wanted_category)) {
            $response = array("err" => false,
                "id_category" => $wanted_category->id_category,
                "label_category" => $wanted_category->label_category,
                "id_os" => $wanted_category->id_os,
                "id_website" => $wanted_category->id_website);
        } else {
            $err_summary = $this->tools->get_errors_summary($category->errors);
            $response = array("err" => true,
                "message" => "Database error : " . $err_summary);
        }
        echo CJSON::encode($response);
    }

    public function actionCategory_update() {
        $body = file_get_contents("php://input");
        $json = CJSON::decode($body);

        if (preg_match("#^[a-zA-Z0-9]{1,30}$#", $json["label_category"]) > 0) {
            $category = new Category();
            if (is_null($category->find("label_category='" . $json["label_category"] . "' && id_website='" . $json["id_website"] . "' && id_os='" . $json["id_os"] . "'"))) {
                $updated_rows = $category->updateAll(array(
                    "label_category" => $json["label_category"],
                    "id_website" => $json["id_website"],
                    "id_os" => $json["id_os"]
                        ), "id_category=" . $json["id_category"]);
                if ($updated_rows == 1) {
                    $response = array("err" => false,
                        "message" => "The Category " . $json["label_category"] . " was updated successfuly");
                } elseif ($updated_rows == 0) {
                    $err_summary = $this->tools->get_errors_summary($category->errors);
                    $response = array("err" => true,
                        "message" => "No rows were updated : " . $err_summary);
                }
            } else {
                $response = array("err" => true,
                    "message" => "The combination (Category / OS / Website) already exists");
            }
        } else {
            $response = array("err" => true,
                "message" => "Category label is rong : " . $json["label_os"]);
        }
        echo CJSON::encode($response);
    }

    public function actionCategory_delete() {
        $body = file_get_contents("php://input");
        $json = CJSON::decode($body);
        $Category = new Category();
        $deleted_rows = $Category->deleteAll("id_category = " . $json["id_category"]);
        if ($deleted_rows == 1) {
            $response = array("err" => false,
                "message" => "The Category " . $json["id_category"] . " was deleted successfuly");
        } else {
            $err_summary = $this->tools->get_errors_summary($Category->errors);
            $response = array("err" => true,
                "message" => "Database error : " . $err_summary);
        }
        echo CJSON::encode($response);
    }

    public function actionSection_list() {
        $this->page_title = "Sections";
        $section_list = Section::model()->findAll();
        $website_list = Website::model()->findAll();
        $os_list = Os::model()->findAll();
        $category_list = Category::model()->findAll();
        $this->render('section_list', array(
            'os_list' => $os_list,
            'website_list' => $website_list,
            'category_list' => $category_list,
            'section_list' => $section_list
        ));
    }

    public function actionSection_add() {
        $body = file_get_contents("php://input");
        $json = CJSON::decode($body);
        if (preg_match("#^[a-zA-Z0-9\_\-]{1,30}$#", $json["label_section"]) > 0) {
            $section = new Section();
            $section->setAttribute("label_section", $json["label_section"]);
            $section->setAttribute("id_category", $json["id_category"]);
            if (is_null($section->find("label_section='" . $json["label_section"] . "' && id_category='" . $json["id_category"] . "'"))) {
                if ($section->save()) {
                    $response = array("err" => false,
                        "message" => "The Section " . $json["label_section"] . " was added successfuly");
                } else {
                    $err_summary = $this->tools->get_errors_summary($section->errors);
                    $response = array("err" => true,
                        "message" => "Database error : " . $err_summary);
                }
            } else {

                $response = array("err" => true,
                    "message" => "The combination (Section / Category) already exists");
            }
        } else {
            $response = array("err" => true,
                "message" => "Section label is rong : " . $json["label_os"]);
        }
        echo CJSON::encode($response);
    }

    public function actionSection_edit() {
        $body = file_get_contents("php://input");
        $json = CJSON::decode($body);
        $section = new Section();
        $wanted_section = $section->find("id_section = " . $json["id_section"]);
        $response = NULL;
        if (!is_null($wanted_section)) {
            $section_category = Category::model()->find("id_category = " . $wanted_section["id_category"]);
            if (!is_null($section_category)) {
                $section_category_os = Os::model()->find("id_os = " . $section_category["id_os"]);
                if (!is_null($section_category_os)) {
                    $response = array("err" => false,
                        "id_section" => $wanted_section->id_section,
                        "label_section" => $wanted_section->label_section,
                        "id_category" => $wanted_section->id_category,
                        "id_os" => $section_category_os->id_os,
                        "id_website" => $section_category_os->id_website);
                } else {
                    $err_summary = $this->tools->get_errors_summary($section_category->errors);
                    $response = array("err" => true,
                        "message" => "Database error LEVEL : \$section_category_os" . $err_summary);
                }
            } else {
                $err_summary = $this->tools->get_errors_summary($section_category->errors);
                $response = array("err" => true,
                    "message" => "Database error LEVEL : \$section_category" . $err_summary);
            }
        } else {
            $err_summary = $this->tools->get_errors_summary($section->errors);
            $response = array("err" => true,
                "message" => "Database error : " . $err_summary);
        }
        echo CJSON::encode($response);
    }

    public function actionSection_update() {
        $body = file_get_contents("php://input");
        $json = CJSON::decode($body);

        if (preg_match("#^[a-zA-Z0-9\-\_]{1,30}$#", $json["label_section"]) > 0) {
            $section = new Section();
            if (is_null($section->find("label_section='" . $json["label_section"] . "' && id_category='" . $json["id_category"] . "'"))) {
                $updated_rows = $section->updateAll(array(
                    "label_section" => $json["label_section"],
                    "id_category" => $json["id_category"],
                        ), "id_section=" . $json["id_section"]);
                if ($updated_rows == 1) {
                    $response = array("err" => false,
                        "message" => "The Section " . $json["label_section"] . " was updated successfuly");
                } elseif ($updated_rows == 0) {
                    $err_summary = $this->tools->get_errors_summary($section->errors);
                    $response = array("err" => true,
                        "message" => "No rows were updated : " . $err_summary);
                }
            } else {
                $response = array("err" => true,
                    "message" => "The combination (Section / Category) already exists");
            }
        } else {
            $response = array("err" => true,
                "message" => "Section label is rong : " . $json["label_section"]);
        }
        echo CJSON::encode($response);
    }

    public function actionSection_delete() {
        $body = file_get_contents("php://input");
        $json = CJSON::decode($body);
        $Section = new Section();
        $deleted_rows = $Section->deleteAll("id_section = " . $json["id_section"]);
        if ($deleted_rows == 1) {
            $response = array("err" => false,
                "message" => "The Section " . $json["id_section"] . " was deleted successfuly");
        } else {
            $err_summary = $this->tools->get_errors_summary($Section->errors);
            $response = array("err" => true,
                "message" => "Database error : " . $err_summary);
        }
        echo CJSON::encode($response);
    }

    public function scan_apps_lists($link_before_index, $os, $category, $section = NULL) {
        $global_apps_list = "";
        $index = 2; // using to alter index (x).html for apps lists, it starts from 2 because we have some issues on index1.html, the apps there are not all from the equivalent section
        $pagenotfound = false; // if true than PAGE NOT FOUND REACHED
        $this->tools->log_text("\n||||||||||||||||||||||||||||||||  APPS LIST : " . $link_before_index);
        do {//do while we did not reach NOT FOUND PAGE
            $current_apps_list_link_string = $link_before_index . "index" . $index . ".html";
            $current_apps_list = $this->tools->get_page($current_apps_list_link_string);
            if (!is_null($current_apps_list)) {//if we have a good page, extracted from a good proxy
                Status::model()->updateAll(array("downloaded_pages" => $this->downloaded_pages++,
                    "list_link" => $current_apps_list_link_string), "id=1");
                if (strpos($current_apps_list["content"], "Page non trouv") === FALSE) {
                    $regex_app_link = NULL;
                    $regex_app_name = NULL;
                    if (is_null($section)) {
                        $regex_app_link = "/(\/telecharger\/" . $os . "\/" . $category . "\/fiches\/)((\w|\-){1,19})(\.html\" class=\"resrechlog_nomlogi\">)(.{100})/";
                        $regex_app_name = "#(\/telecharger\/" . $os . "\/" . $category . "\/fiches\/)((\w|\-){1,19}\.html)|(\"\>.*\<\/a\>)#";
                    } else {
                        $regex_app_link = "/(\/telecharger\/" . $os . "\/" . $category . "\/" . $section . "\/fiches\/)((\w|\-){1,19})(\.html\" class=\"resrechlog_nomlogi\">)(.{100})/";
                        $regex_app_name = "#(\/telecharger\/" . $os . "\/" . $category . "\/" . $section . "\/fiches\/)((\w|\-){1,19}\.html)|(\"\>.*\<\/a\>)#";
                    }
                    //GREAT !! , get the lines we need
                    preg_match_all($regex_app_link, $current_apps_list["content"], $apps_links_names); //extract link and name part 1
                    foreach ($apps_links_names[0] as $app) {//$apps_links_names[0] contains occurences of our search
                        preg_match_all($regex_app_name, $app, $link_name);
                        //$x = 0;
                        foreach ($link_name[0] as $key => $element) {//element is either app link or app name 0 : link 1 : name / 2 : link  3 : name
                            if ($key % 2 == 0) {//this is a link
                                $current_app_name = $link_name[0][$key + 1]; //this is a name
                                $current_app_link = $element;
                                $this->tools->log_text("\nLink to application page  : " . $current_app_link);
                                Status::model()->updateAll(array("application_link" => $current_app_link), "id=1");
                                $current_app_name = $this->tools->clean_name($current_app_name);
                                $current_app_name = utf8_encode($current_app_name);
                                Status::model()->updateAll(array("application_name" => $current_app_name), "id=1");
                                $this->tools->log_text("[[[[[[[[[[SCAN APPLICATION STARTED: ".$current_app_name);
                                $this->scan_app_link($current_app_link, $current_app_name, $category, $section); //get all apps in the page
                                $this->tools->log_text("SCAN APPLICATION FINISHED: ".$current_app_name."]]]]]]]]]]");
                                //this part must be at the end
                                $query = "UPDATE Status SET scanned_apps = scanned_apps + 1 WHERE id=1";
                                Yii::app()->db->createCommand($query)->execute();
                                //$global_apps_list .= "\n" . $element . "\n"; //ADD the new apps_names list to the global list
                            }
                        }
                    }
                    $index++; //go to next page
                } else {
                    //404 PAGE NOT FOUND REACHED
                    $pagenotfound = true;
                    $this->tools->log_text("------------------------------> PAGE NOT FOUND");
                }
            } else {//we are not going to do any scan, we end the application and log a message
                $this->tools->log_text("we had more than 50 loops");
                Yii::app()->end();
            }
        } while ($pagenotfound != true);
        //return $global_apps_list;
    }

    public function scan_app_link($app_link, $app_name, $category, $section = NULL) {
        $current_app_info = array("label_application" => $app_name,
            "download_link" => "",
            "image_link" => "",
            "description" => "",
            "id_category" => "",
            "id_section" => "");
        $this->tools->log_text("scan_app_link started(" . $app_name . " , " . $app_link . ")");
        $url = "www.01net.com" . $app_link;
        $app_page = $this->tools->get_page($url); //current application page
        if (!is_null($app_page)) {
            Status::model()->updateAll(array("downloaded_pages" => $this->downloaded_pages++));
            //$this->tools->log_text("got the page");
            //if app exists in DB
            $res = Application::model()->findAll("label_application = :app_name", array(":app_name" => $app_name));
            if (empty($res)) {//app does not exists
                $this->tools->log_text("Not found in DB app_name : " . $app_name);
                //get image links
                $current_app_info["image_link"] = $this->get_image_link($app_page["content"], $app_name);
                $current_app_info["description"] = $this->get_description($app_page["content"]);
                $current_app_info["download_link"] = $this->get_download_link($app_page["content"]);
                $application = new Application();
                $app_category = Category::model()->find("label_category = :label_category", array("label_category" => $category));
                if (!is_null($app_category)) {//category found
                    $this->tools->log_text("category found = " . $app_category->id_category); //----------------------------------------------------------------->
                    $current_app_info["id_category"] = $app_category->id_category;
                    if (is_null($section)) {//this app has no section
                        $this->tools->log_text("this app has no section");
                        $current_app_info["id_section"] = NULL;
                    } else {//this app has section we need to find it
                        $section = Section::model()->find("label_section = :label_section", array("label_section" => $section));
                        if (!is_null($section)) {//section found
                            $this->tools->log_text("section found");
                            $current_app_info["id_section"] = $section->id_section;
                        } else {
                            $this->tools->log_text("ERROR couldn't find section app_name = " . $app_name);
                        }
                    }
                    $this->tools->log_text("saving application");

                    $application->setAttributes(array("label_application" => $app_name,
                        "description" => $current_app_info["description"],
                        "insert_date" => date("D.M.Y"),
                        "id_section" => $current_app_info["id_section"],
                        "id_category" => $current_app_info["id_category"]));
                    if (!is_null($current_app_info["image_link"])) {//if image exists we add it
                        $application->setAttributes(array("image_link" => $current_app_info["image_link"]));
                    }
                    if ($application->save()) {//save download link
                        $last_inserted_app_id = Yii::app()->db->lastInsertID;
                        $download_link = new DownloadLink();
                        $download_link->setAttributes(array("label_download_link" => $current_app_info["download_link"],
                            "id_application" => $last_inserted_app_id));
                        if ($download_link->save()) {
                            $this->tools->log_text("application added to DB : \n
								name : " . $app_name . "\n
								image link : " . $current_app_info["image_link"] . "\n" .
                                    "description : " . $current_app_info["description"] . "\n"
                                    . "download link : " . $current_app_info["download_link"]);
                        }
                    } else {
                        $this->tools->log_text("ERROR : can't save application REPORT : " . $this->tools->get_errors_summary($application->errors));
                    }
                } else {
                    $this->tools->log_text("ERROR couldn't get the category, app_name = " . $app_name);
                }
            } else {//if application(s) exists in DB
                $this->tools->log_text("\nApplication exists !");
                //get the current category id from label BECAUSE IF THE LABEL OF APPLICATION MAY BE REPEATED BUT HAS DIFFERENT CATEGORY AND OS fo EX(will do this later if NEEDED :), so we should get the current app category and test it with the category of app found in database)
                $current_download_links = DownloadLink::model()->findAll("id_application = :id_application", array(":id_application" => $res[0]->id_application));
                if (!empty($current_download_links)) {
                    $online_download_link = $this->get_download_link($app_page["content"]);
                    foreach ($current_download_links as $download_link) {
                        if ($download_link->label_download_link != $online_download_link) {//link changed
                            DownloadLink::model()->updateAll(array("label_download_link" => $online_download_link), "id_application = " . $res[0]->id_application);
                            $this->tools->log_text("\n\nDownload link updated : \n OLD : " . $download_link->label_download_link
                                    . "\nNEW : " . $online_download_link);
                        } else {
                            $this->tools->log_text("\n\nDownload link UNCHANGED");
                        }
                    }
                } else {
                    $this->tools->log_text("Couldn't find any Download link for this app : " . $app_name);
                }
            }
        } else {
            $this->tools->log_text("scan_app_link : we had more than 50 loops");
            Yii::app()->end();
        }
    }

    public function get_download_link($app_page_content) {
        $app_download_link = NULL;
        $status = Status::model()->find("id=1");
        if (!is_null($status)) {
            $os = $status->os;
            $category = $status->category; //No section in this category
            $section = $status->section;
            $regex = "";
            ///outils/telecharger/windows/Internet/ftp/fiches/tele17966.html
            if ($section == "No section in this category") {
                $regex = "/outils/telecharger/" . $os . "/" . $category . "/fiches/";
            } else {
                $regex = "/outils/telecharger/" . $os . "/" . $category . "/" . $section . "/" . "fiches/";
            }
            $regex = "#" . $regex . ".*\.html#"; //Ex : "#/outils/telecharger/linux/Programmation/fiches/.*\.html#"
            $x = preg_match_all($regex, $app_page_content, $res);
            if ($x > 0) {
                foreach ($res[0] as $element) {
                    $app_download_link = $element; //Ex: /outils/telecharger/linux/Programmation/fiches/tele29223.html
                }
            } else {
                $this->tools->log_text("download link regex found nothing");
            }
            $app_download_link = "www.01net.com" . $app_download_link;
            $this->tools->log_text(">>>>>>>>>>get_download_link page");
            $final_download_link_page = $this->tools->get_page($app_download_link);
            if (!is_null($final_download_link_page)) {
                $query = "UPDATE Status SET downloaded_pages = downloaded_pages + 1 WHERE id=1";
                Yii::app()->db->createCommand($query)->execute();
                $regex = "#href=\".*target=\"_blank\">cliquer ici#";
                $x = preg_match_all($regex, $final_download_link_page["content"], $res);
                if ($x > 0) {
                    foreach ($res[0] as $element) {
                        $element = str_replace(array("href=\""), "", $element);
                        $element = preg_replace("#\".*#", "", $element);
                        $app_download_link = $element;
                    }
                } else {
                    echo "ERROR couldn't get the final link page x = " . $x;
                }
            } else {
                $this->tools->log_text("get_download_link : we had more than 50 loops");
                return null;
            }
        } else {
            $this->tools->log_text("ERROR Status is NULL");
            return null;
        }
        $this->tools->log_text("get_download_link page finished<<<<<<<<<<");
        return $app_download_link;
    }

    public function get_description($app_page_content) {
        $this->tools->log_text("..........get_description");
        $app_description = NULL;
        $regex = "#tc_description_logiciel(.*){0,500}#";
        $x = preg_match_all($regex, $app_page_content, $res);
        if ($x > 0) {
            foreach ($res[0] as $element) {
                $element = str_replace(array("tc_description_logiciel\">", "<em>", "</em>", "&nbsp;", "</p></div>"), "", $element);
                $element = preg_replace("#(<[\w\/]{1,10}>)#", "", $element);
                $element = preg_replace("#<.*>#", "", $element);
                $app_description = $element;
            }
        } else {
            $this->tools->log_text("description regex found nothing");
        }
        $this->tools->log_text("get_description..........");
        return utf8_encode($app_description);
    }

    public function get_image_link($app_page_content, $app_name) {
        $official_image_link = NULL;
        //<a class="tc_onglet_off_liens" href="/telecharger/windows/Bureautique/agenda/fiches/img50789.html">Captures<br>d'écran</a>
        $regex_capture_ecran_tab_link = "#\/telecharger\/.*\.html\">[\s]*Captures#";
        $x = preg_match_all($regex_capture_ecran_tab_link, $app_page_content, $res);
        if ($x > 0) {
            foreach ($res[0] as $key => $link) {//image found
                $link = str_replace("Captures", "", $link);
                $link = str_replace("\">", "", $link); //we have now a clean link
                $link = "www.01net.com" . $link;
                $this->tools->log_text("***************get image");
                $image_page = $this->tools->get_page($link); //get the official image link
                Status::model()->updateAll(array("downloaded_pages" => $this->downloaded_pages++));
                $regex_official_image_link = "#/images/logiciel/.*\.jpg#";
                $x = preg_match_all($regex_official_image_link, $image_page["content"], $res);
                if ($x > 0) {//got official image link
                    $official_image_link = $res[0][0];
                } else {//regex found nothing
                    $this->tools->log_text("REGEX found no image for app_name : " . $app_name);
                }
            }
        } else {//no image found
            $this->tools->log_text("No images page for this application, x = " . $x);
        }
        $this->tools->log_text("***************get image finished");
        return $official_image_link;
    }

    public function actionAppsGrabb() {
        $this->page_title = "Bombing page";
        $this->render('appsgrabb');
    }

    public function actionStart() {
        //Yii::import('ext.runactions.components.ERunActions');
        //if (ERunActions::runBackground())
        //{
        Status::model()->updateByPk(1, array("progression_section" => 0,
            "website" => "",
            "os" => "",
            "category" => "",
            "section" => "",
            "list_link" => "",
            "progression_category" => 0,
            "progression_os" => 0,
            "scanned_apps" => 0,
            "application_link" => "",
            "application_name" => "",
            "downloaded_pages" => 0,
            "applications_added" => 0,
            "total_proxies" => 0,
            "current_proxy" => "",
            "scan_stat" => "ongoing",
            "finish_time" => time() + 604800, //current time + 7 days :), if you don't do this we get error in finish-start time in Get_scan_info function
            "start_time" => time()));
        $this->downloaded_pages = 0;
        $website_list = Website::model()->findAll();
        foreach ($website_list as $website) {
            $os_list = Os::model()->findAll("id_website=" . $website->id_website);
            foreach ($os_list as $os) {
                $category_list = Category::model()->findAll("id_os=" . "'" . $os->id_os . "' && id_website=" . "'" . $website->id_website . "'");
                foreach ($category_list as $category) {
                    $section_list = Section::model()->findAll("id_category=" . "'" . $category->id_category . "'");
                    $apps_list_link = NULL;
                    if (!empty($section_list)) {//if this category has sections
                        foreach ($section_list as $section) {
                            $status = Status::model()->updateAll(array("website" => $website->label_website,
                                "os" => $os->label_os,
                                "category" => $category->label_category,
                                "section" => $section->label_section, "id=1"));
                            $apps_list_link = "www." . $website->label_website . "/telecharger/" . $os->label_os . "/" . $category->label_category . "/" . $section->label_section . "/";
                            //$global_apps_list = $this->scan_apps_lists($apps_list_link, $os->label_os, $category->label_category, $section->label_section);
                            $this->scan_apps_lists($apps_list_link, $os->label_os, $category->label_category, $section->label_section);

                            $this->tools->log_text(">>>>>>>>>>>>>SCANNED SECTION : website : " . $website->label_website . " - Os : " . $os->label_os . " - category : " . $category->label_category . " Section : " . $section->label_section . " : \n\n\n");
                            $query = "UPDATE Status SET progression_section = progression_section + 1 WHERE id=1";
                            Yii::app()->db->createCommand($query)->execute();
                        }
                    } else {//if category has NO sections
                        $status = Status::model()->updateAll(array("website" => $website->label_website,
                            "os" => $os->label_os,
                            "category" => $category->label_category,
                            "section" => "No section in this category", "id=1"));
                        $apps_list_link = "www." . $website->label_website . "/telecharger/" . $os->label_os . "/" . $category->label_category . "/";
                        //$global_apps_list = $this->scan_apps_lists($apps_list_link, $os->label_os, $category->label_category);
                        $this->scan_apps_lists($apps_list_link, $os->label_os, $category->label_category);
                        $this->tools->log_text(">>>>>>>>>>>>>SCANNED CATEGORY: website : " . $website->label_website . " - Os : " . $os->label_os . " - category : " . $category->label_category . " : \n\n\n");
                    }
                    $query = "UPDATE Status SET progression_category = progression_category + 1 WHERE id=1";
                    Yii::app()->db->createCommand($query)->execute();
                }
                $query = "UPDATE Status SET progression_os = progression_os + 1 WHERE id=1";
                Yii::app()->db->createCommand($query)->execute();
            }
        }
        Status::model()->updateAll(array("scan_stat" => "finished"), "id=1");
        Status::model()->updateAll(array("finish_time" => time()), "id=1");
        //}//end runBackground
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