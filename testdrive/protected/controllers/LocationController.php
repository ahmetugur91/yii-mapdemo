<?php

class LocationController extends Controller
{
    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        $criteria = new CDbCriteria();
        $criteria->order = 't.id DESC';

        $limit = 2;

        $item_count = Location::model()->count($criteria);

        $pages = new CPagination($item_count);

        $pages->setPageSize($limit);

        $pages->applyLimit($criteria);  // the trick is here!

        $this->render('index', array(

            'locations' => Location::model()->with("user")->findAll($criteria),

            'item_count' => $item_count,

            'page_size' => $limit,

            'items_count' => $item_count,

            'pages' => $pages,

        ));
    }

    public function actionCreate()
    {
        $location = new Location();

        if (isset($_POST["create"]) and isset($_POST["location"])) {

            $location->attributes = $_POST["location"];
            if ($location->validate()) {

                var_dump($location->save());

                print_r($location->getErrors());exit();
                $this->redirect("/?r=location/index");
            }

        }

        $this->render("create", compact("location"));
    }

}