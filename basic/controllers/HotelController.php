<?php


namespace app\controllers;


use app\models\hotel\Booking;
use app\models\hotel\BookingSearch;
use app\models\hotel\Clients;
use app\models\hotel\Feedback;
use app\models\hotel\Floors;
use app\models\hotel\Hotelbuilding;
use app\models\hotel\Clientbookingroom;
use app\models\hotel\Hotelroom;
use app\models\hotel\Organizations;
use app\models\hotel\Paymentforservices;
use app\models\hotel\Query1;
use app\models\hotel\Query2;
use app\models\RegForm;
use app\models\LoginForm;
use http\Client;
use yii\base\BaseObject;
use yii\data\Pagination;
use yii\web\Controller;
use Yii;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;


class HotelController extends Controller
{



    public function actionIndex()
    {
        return $this->render('index');
    }
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['get'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionReg()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new RegForm();
        if ($model->load(Yii::$app->request->post()) && $model->register()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('reg', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionLab5()
    {
        return $this->render('lab5');
    }

    public function actionQuery1()
    {
        $model = new Query1();

        $query = Organizations::find()->joinWith('booking');

        if($model->load(Yii::$app->request->post())) {

            if($model->countOfPeople != 0 && $model->dateStart != "" && $model->dateEnd != "")
            {
                $query = $query->where(['>', 'countOfPeople', $model->countOfPeople])
                    ->andWhere(['>=', 'startOfBooking', $model->dateStart  ])
                    ->andWhere(['<=', 'startOfBooking', $model->dateEnd  ]);
            }
            elseif ($model->countOfPeople == 0 && $model->dateStart != "" && $model->dateEnd != "")
            {
                $query = $query
                    ->where(['>=', 'startOfBooking', $model->dateStart  ])
                    ->andWhere(['<=', 'startOfBooking', $model->dateEnd  ]);
            }
            elseif ($model->countOfPeople != 0 && $model->dateStart == "" && $model->dateEnd == "")
            {
                $query = $query->where(['>', 'countOfPeople', $model->countOfPeople]);
            }
            elseif ($model->countOfPeople == 0 && $model->dateStart != "" )
            {
                $query = $query
                    ->where(['>=', 'startOfBooking', $model->dateStart  ]);
            }
            elseif ($model->countOfPeople == 0 && $model->dateEnd != "")
            {
                $query = $query
                    ->where(['<=', 'startOfBooking', $model->dateEnd  ]);
            }
            elseif ($model->countOfPeople != 0 && $model->dateStart != "")
            {
                $query = $query
                    ->where(['>=', 'startOfBooking', $model->dateStart  ])
                    ->andWhere(['>', 'countOfPeople', $model->countOfPeople]);

            }
        }
        $count = $query->count();

        $organizations = $query->all();

        return $this->render('query1',
            [
                'model' => $model,
            'organizations' => $organizations,
            'count' => $count,
        ]
    );
    }

    public function actionQuery2()
    {
        $model = new Query2();
        $cur_date = date('Y-m-d');
        $beds =  Hotelroom::find()->all();
        $classes = Hotelbuilding::find()->all();
        $hotelClass = ['Не выбрано' => 'Не выбрано'];
        foreach ($classes as $h)
            $hotelClass[$h["hotelClass"]] = $h["hotelClass"];

//        $query = Clients::find()->joinWith('booking')->joinWith('hotelrooms');
//          $query = Hotelroom::find()->joinWith(['clients', 'booking']);
           $query = Booking::find()->joinWith(['clients', 'hotelrooms'])->joinWith('hotelrooms.hotelBuildings');


        if($model->load(Yii::$app->request->post())) {

            if($model->hotelClass != 'Не выбрано' && $model->numberOfBeds != '' && $model->paymentForDay != 0 && $model->dateStart != "" && $model->dateEnd != "")
            {
                $query = $query->where(['=', 'hotelClass', $model->hotelClass])
                    ->andWhere(['=', 'hotelroom.numberOfBeds', $model->numberOfBeds])
                    ->andWhere(['<=', 'hotelroom.paymentForDay', $model->paymentForDay])
                    ->andWhere(['>=', 'booking.startOfBooking', $model->dateStart  ])
                    ->andWhere(['<=', 'booking.startOfBooking', $model->dateEnd  ])
                    ->andWhere('clients.name IS NOT NULL');
            }
            elseif ($model->hotelClass != 'Не выбрано' && $model->numberOfBeds == '' && $model->paymentForDay == '' && $model->dateStart == "" && $model->dateEnd == "")
            {
                $query = $query->where('clients.name IS NOT NULL')
                    ->andWhere(['=', 'hotelClass', $model->hotelClass]);
            }
            elseif ($model->hotelClass == 'Не выбрано' && $model->numberOfBeds != '' && $model->paymentForDay == '' && $model->dateStart == "" && $model->dateEnd == "")
            {
                $query = $query->where('clients.name IS NOT NULL')
                    ->andWhere(['=', 'numberOfBeds', $model->numberOfBeds]);
            }
            elseif ($model->hotelClass == 'Не выбрано' && $model->numberOfBeds == '' && $model->paymentForDay == '' && $model->dateStart == "" && $model->dateEnd == "")
            {
                $query = $query->where('clients.name IS NOT NULL');
            }
            elseif ($model->hotelClass != 'Не выбрано' && $model->numberOfBeds != '' && $model->paymentForDay == '' && $model->dateStart == "" && $model->dateEnd == "")
            {
                $query = $query->where('clients.name IS NOT NULL')
                    ->andWhere(['=', 'hotelClass', $model->hotelClass])
                    ->andWhere(['=', 'hotelroom.numberOfBeds', $model->numberOfBeds]);
            }
            elseif ($model->hotelClass == 'Не выбрано' && $model->numberOfBeds == '' && $model->paymentForDay == '' && $model->dateStart != "" && $model->dateEnd != "")
            {
                $query = $query->where('clients.name IS NOT NULL')
                    ->andWhere(['>=', 'booking.startOfBooking', $model->dateStart  ])
                    ->andWhere(['<=', 'booking.startOfBooking', $model->dateEnd  ]);
            }
            elseif ($model->hotelClass == 'Не выбрано' && $model->numberOfBeds == '' && $model->paymentForDay != '' && $model->dateStart != "" && $model->dateEnd != "")
            {
                $query = $query->where('clients.name IS NOT NULL')
                    ->andWhere(['<=', 'hotelroom.paymentForDay', $model->paymentForDay])
                    ->andWhere(['>=', 'booking.startOfBooking', $model->dateStart  ])
                    ->andWhere(['<=', 'booking.startOfBooking', $model->dateEnd  ]);
            }
            elseif ($model->hotelClass != 'Не выбрано' && $model->numberOfBeds != '' && $model->paymentForDay != '' && $model->dateStart == "" && $model->dateEnd == "")
            {
                $query = $query->where('clients.name IS NOT NULL')
                    ->andWhere(['=', 'hotelClass', $model->hotelClass])
                    ->andWhere(['=', 'hotelroom.numberOfBeds', $model->numberOfBeds])
                    ->andWhere(['<=', 'hotelroom.paymentForDay', $model->paymentForDay])
                ;
            }
        }
        $count = $query->count();
//        $count = $query->select([ 'COUNT(clients.id) as cnt']);
//        $rooms = Hotelroom::find()
//            ->joinWith(['clients', 'booking', 'organizations'])
//              ->where(['<', 'startOfBooking', $cur_date  ])
//            ->andWhere(['>', 'endOfBooking', $cur_date  ]);
////            ->andWhere(['=', 'organizations.id', 'booking.organization'  ]);
//
//        $organizations = Organizations::find()
//            ->joinWith(['booking', 'hotelrooms'])
//            ->where(['<', 'startOfBooking', $cur_date  ])
//            ->andWhere(['>', 'endOfBooking', $cur_date  ])->all();


        $clients = $query->all();
        return $this->render('query2',
            [
                'model' => $model,
                'clients' => $clients,
                'numberOfBeds' => $numberOfBeds,
                'hotelClass' => $hotelClass,
                'count' => $count,
            ]
        );
    }

    public function actionQuery3()
    {
        $searchModel = new BookingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('query3', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
//    {
//
//        $query = Hotelroom::find()->with('hotelBuildings', 'floors')->where(['=', 'isNotFree', 0]);
//
//        $count = $query->count();
//
//        $rooms = $query->all();
//        return $this->render('query3',
//            [
//                'rooms' => $rooms,
//                'count' => $count,
//            ]
//        );
//    }

    public function actionQuery4()
    {
        $model = new Query2();
        $classes = Hotelbuilding::find()->all();
        $hotelClass = ['Не выбрано' => 'Не выбрано'];
        foreach ($classes as $h)
            $hotelClass[$h["hotelClass"]] = $h["hotelClass"];


        $query = Hotelroom::find()->joinWith('hotelBuildings');


        if($model->load(Yii::$app->request->post())) {

            if($model->hotelClass != 'Не выбрано' && $model->numberOfBeds != '' && $model->paymentForDay != 0 )
            {
                $query = $query->where(['=', 'isNotFree', 0])
                    ->andWhere(['=', 'hotelBuilding.hotelClass', $model->hotelClass])
                    ->andWhere(['=', 'hotelroom.numberOfBeds', $model->numberOfBeds])
                    ->andWhere(['<=', 'hotelroom.paymentForDay', $model->paymentForDay]);
            }
            elseif ($model->hotelClass == 'Не выбрано' && $model->numberOfBeds != '' && $model->paymentForDay != 0)
            {
                $query = $query->where(['=', 'isNotFree', 0])
                    ->andWhere(['=', 'hotelroom.numberOfBeds', $model->numberOfBeds])
                    ->andWhere(['<=', 'hotelroom.paymentForDay', $model->paymentForDay]);
            }
            elseif ($model->hotelClass != 'Не выбрано' && $model->numberOfBeds == '' && $model->paymentForDay != 0)
            {
                $query = $query->where(['=', 'isNotFree', 0])
                    ->andWhere(['=', 'hotelBuilding.hotelClass', $model->hotelClass])
                    ->andWhere(['<=', 'hotelroom.paymentForDay', $model->paymentForDay]);
            }
            elseif ($model->hotelClass == 'Не выбрано' && $model->numberOfBeds == '' && $model->paymentForDay != 0)
            {
                $query = $query->where(['=', 'isNotFree', 0])
                    ->andWhere(['<=', 'hotelroom.paymentForDay', $model->paymentForDay]);
            }
            elseif ($model->hotelClass == 'Не выбрано' && $model->numberOfBeds == '' && $model->paymentForDay == 0)
            {
                $query = $query->where(['=', 'isNotFree', 0]);
            }
            elseif ($model->hotelClass != 'Не выбрано' && $model->numberOfBeds == '' && $model->paymentForDay == 0)
            {
                $query = $query->where(['=', 'isNotFree', 0])
                    ->andWhere(['=', 'hotelBuilding.hotelClass', $model->hotelClass]);
            }
            elseif ($model->hotelClass != 'Не выбрано' && $model->numberOfBeds != '' && $model->paymentForDay == 0)
            {
                $query = $query->where(['=', 'isNotFree', 0])
                    ->andWhere(['=', 'hotelBuilding.hotelClass', $model->hotelClass])
                    ->andWhere(['=', 'hotelroom.numberOfBeds', $model->numberOfBeds]);
            }
        }
        $count = $query->count();

        $rooms = $query->all();
        return $this->render('query4',
            [
                'model' => $model,
                'rooms' => $rooms,
                'hotelClass' => $hotelClass,
                'count' => $count,
            ]
        );
    }

    public function actionQuery5()
    {
        $model = new Query2();
        $idRooms = Hotelroom::find()->where(['=', 'isNotFree', 0])->all();
        $id = ['Не выбрано' => 'Не выбрано'];
        foreach ($idRooms as $i)
            $id[$i["id"]] = $i["id"];


        $query = Hotelroom::find()->joinWith(['hotelBuildings', 'booking'])->where(['=', 'isNotFree', 0]);


        if($model->load(Yii::$app->request->post())) {

            if($model->id != 'Не выбрано')
            {
                $query = $query->where(['=', 'isNotFree', 0])
                    ->andWhere(['=', 'hotelroom.id', $model->id]);
            }
            elseif($model->id == 'Не выбрано')
            {
                $query = $query->where(['=', 'isNotFree', 0]);
            }
        }
        $count = $query->count();

        $rooms = $query->all();
        return $this->render('query5',
            [
                'model' => $model,
                'rooms' => $rooms,
                'id' => $id,
                'count' => $count,
            ]
        );
    }


    public function actionQuery6()
    {
        $model = new Query2();
        $cur_date = date('Y-m-d');

        $query = Hotelroom::find()->with('clientbookingroom')->joinWith(['hotelBuildings', 'booking'])->groupBy(['hotelroom.id']);
//        $query = Booking::find()->joinWith(['clients','organization', 'hotelrooms'])->joinWith('hotelrooms.hotelBuildings')->groupBy(['hotelroom.id'])->orderBy('hotelroom.id');
//        $query = Clients::find()->joinWith(['booking', 'hotelrooms'])->joinWith('hotelrooms.hotelBuildings')->groupBy(['hotelroom.id']);

        if($model->load(Yii::$app->request->post())) {

            if($model->dateEnd != '')
            {
                $query = $query->where(['=', 'clientbookingroom.isBookedNow', 1])
                    ->andWhere(['<=', 'booking.endOfBooking', $model->dateEnd  ]);
//                    ->andWhere(['<=', 'booking.endOfBooking', $model->dateEnd  ]);
            }
            elseif($model->dateEnd == '')
            {
                $query = $query->where(['=', 'clientbookingroom.isBookedNow', 1]);
            }
        }
        $count = $query->count();

        $rooms = $query->all();
        return $this->render('query6',
            [
                'model' => $model,
                'rooms' => $rooms,
                'count' => $count,
            ]
        );
    }

    public function actionQuery7()
    {
        $model = new Query2();
        $cur_date = date('Y-m-d');
        $orgs =  Organizations::find()->all();
        $nameOrg = ['Не выбрано' => 'Не выбрано'];
        foreach ($orgs as $org)
            $nameOrg[$org["name"]] = $org["name"];

        $query = Booking::find()->joinWith(['organization','hotelrooms'])->joinWith('hotelrooms.hotelBuildings');
//          $query = Hotelroom::find()->innerJoinWith(['booking', 'organizations']);
//        $query = Organizations::find()->joinWith(['booking', 'hotelrooms'])->joinWith('hotelrooms.hotelBuildings');


        if($model->load(Yii::$app->request->post())) {

            if($model->name != 'Не выбрано' && $model->dateStart != "" && $model->dateEnd != "")
            {
                $query = $query->where(['=', 'organizations.name', $model->name])
                    ->andWhere(['>=', 'booking.startOfBooking', $model->dateStart  ])
                    ->andWhere(['<=', 'booking.endOfBooking', $model->dateEnd  ]);
            }
            elseif ($model->name != 'Не выбрано' && $model->dateStart == "" && $model->dateEnd == "")
            {
                $query = $query->where(['=', 'organizations.name', $model->name]);
            }
            elseif ($model->name != 'Не выбрано' && $model->dateStart != "" && $model->dateEnd == "")
            {
                $query = $query->where(['=', 'organizations.name', $model->name])
                    ->andWhere(['>=', 'booking.startOfBooking', $model->dateStart  ]);
            }
            elseif ($model->name != 'Не выбрано' && $model->dateStart == "" && $model->dateEnd != "")
            {
                $query = $query->where(['=', 'organizations.name', $model->name])
                    ->andWhere(['<=', 'booking.endOfBooking', $model->dateEnd  ]);
            }
        }
        $count = $query->count();

        $count2 = Booking::find()->joinWith(['organization','hotelrooms'])->where(['=', 'hotelroom.numberOfBeds', 2])
        ->andWhere(['=', 'organizations.name', $model->name])
        ->count();
        $strForCount2 = "двухместные";
        $count3 = Booking::find()->joinWith(['organization','hotelrooms'])->where(['=', 'hotelroom.numberOfBeds', 4])
            ->andWhere(['=', 'organizations.name', $model->name])
            ->count();
        $strForCount3 = "трехместные";
        $count4 = Booking::find()->joinWith(['organization','hotelrooms'])->where(['=', 'hotelroom.numberOfBeds', 4])
            ->andWhere(['=', 'organizations.name', $model->name])
            ->count();
        $strForCount4 = "четырехместные";
        $organizations = $query->all();
        return $this->render('query7',
            [
                'model' => $model,
                'organizations' => $organizations,
                'nameOrg' => $nameOrg,
                'count' => $count,
                'count2' => $count2,
                'strForCount2' => $strForCount2,
                'count3' => $count3,
                'strForCount3' => $strForCount3,
                'count4' => $count4,
                'strForCount4' => $strForCount4,

            ]
        );
    }

    public function actionQuery8()
    {

        $query = Clients::find()->joinWith('feedback');
        $query = $query->where('feedback.textOfComplaint IS NOT NULL');

        $count = $query->count();

        $clients = $query->all();
        return $this->render('query8',
            [
                'clients' => $clients,
                'count' => $count,
            ]
        );
    }

    public function actionQuery9()
    {
        $model = new Query2();
        $cur_date = date('Y-m-d');
        $beds =  Hotelroom::find()->all();
        $classes = Hotelbuilding::find()->all();
        $hotelClass = ['Не выбрано' => 'Не выбрано'];
        foreach ($classes as $h)
            $hotelClass[$h["hotelClass"]] = $h["hotelClass"];

//        $query = Clients::find()->joinWith('booking')->joinWith('hotelrooms');
          $query = Hotelroom::find()->joinWith(['clients', 'booking','hotelBuildings'])->groupBy('clients.name');
//        $query = Booking::find()->joinWith(['clients', 'hotelrooms'])->joinWith('hotelrooms.hotelBuildings');


        if($model->load(Yii::$app->request->post())) {

            if($model->hotelClass != 'Не выбрано' && $model->numberOfBeds != '')
            {
                $query = $query->where(['=', 'hotelClass', $model->hotelClass])
                    ->andWhere(['=', 'hotelroom.numberOfBeds', $model->numberOfBeds]);
            }
        }
        $count = $query->count();
//        $sum = Booking::find()->joinWith(['clients', 'hotelrooms'])->where(['=', 'hotelClass', $model->hotelClass])
//            ->andWhere(['=', 'hotelroom.numberOfBeds', $model->numberOfBeds])->sum('paymentForDay');

        $rooms = $query->all();
        return $this->render('query9',
            [
                'model' => $model,
                'rooms' => $rooms,
                'hotelClass' => $hotelClass,
                'count' => $count,
            ]
        );
    }

    public function actionQuery10()
    {
        $model = new Query2();
        $cur_date = date('Y-m-d');

        $idRooms = Hotelroom::find()->joinWith('booking')->where('booking.client IS NOT NULL')
//            ->andwhere(['<', 'startOfBooking', $cur_date  ])
//            ->andWhere(['>', 'endOfBooking', $cur_date  ])
            ->orderBy('id')->all();
        $id = ['Не выбрано' => 'Не выбрано'];
        foreach ($idRooms as $i)
            $id[$i["id"]] = $i["id"];


        $query = Clients::find()->joinWith(['hotelrooms', 'booking','feedback', 'paymentforservices'])
            ->where(['=', 'clientbookingroom.client', 'IS NOT NULL']);


        if($model->load(Yii::$app->request->post())) {
//            $query = Clients::find()->joinWith(['hotelrooms', 'booking','feedback', 'paymentforservices',])->joinWith('paymentforservices.service');

            if($model->id != 'Не выбрано')
            {
                $query = $query->where(['=', 'hotelroom.id', $model->id]);
            }
            elseif($model->id == 'Не выбрано')
            {

            }
        }
        $count = $query->count();

        $clients = $query->all();
        return $this->render('query10',
            [
                'model' => $model,
                'clients' => $clients,
                'id' => $id,
                'count' => $count,
            ]
        );
    }

    public function actionQuery11()
    {
        $model = new Query1();

        $query = Organizations::find()->joinWith('booking');

        if($model->load(Yii::$app->request->post())) {

            if( $model->dateStart != "" && $model->dateEnd != "")
            {
                $query = $query->where(['>=', 'startOfBooking', $model->dateStart  ])
                    ->andWhere(['<=', 'startOfBooking', $model->dateEnd  ]);
            }
        }
        $count = $query->count();


        $organizations = $query->all();

        return $this->render('query11',
            [
                'model' => $model,
                'organizations' => $organizations,
                'count' => $count,
            ]
        );
    }

    public function actionQuery12()
    {
        $model = new Query2();
        $cur_date = date('Y-m-d');

        $idHotelBuildings = Hotelbuilding::find()->all();
        $id = ['Не выбрано' => 'Не выбрано'];
        foreach ($idHotelBuildings as $i)
            $id[$i["id"]] = $i["id"];

//        $query = Hotelbuilding::find()->joinWith('hotelrooms')->joinWith('hotelrooms.clients');
        $query = Clients::find()->joinWith('hotelrooms')->joinWith('hotelrooms.hotelBuildings');

        if($model->load(Yii::$app->request->post()))
        {
            if( $model->id != "Не выбрано")
            {
                $query = $query->limit(1)
                ->where(['=', 'hotelBuilding.id', $model->id])->groupBy('clients.name');

            }
            elseif( $model->id == "Не выбрано")
            {
                $query = $query->limit(1)->groupBy('clients.name');
            }
        }
        $count = $query->count();


        $clients = $query->all();

        return $this->render('query12',
            [
                'model' => $model,
                'clients' => $clients,
                'id' => $id,
                'count' => $count
            ]
        );
    }

    public function actionQuery13()
    {
        $model = new Query2();
        $cur_date = date('Y-m-d');

        $query = Clients::find()->joinWith(['hotelrooms','booking']);

        if($model->load(Yii::$app->request->post()))
        {
            if($model->dateStart != "" && $model->dateEnd != "")
            {
                $query = $query->where(['=', 'clients.isNewClient', 1])
                    ->andWhere(['>=', 'booking.startOfBooking', $model->dateStart ])
                    ->andWhere(['<=', 'booking.startOfBooking', $model->dateEnd ]);
            }
        }
        $count = $query->count();


        $clients = $query->all();

        return $this->render('query13',
            [
                'model' => $model,
                'clients' => $clients,
                'id' => $id,
                'count' => $count
            ]
        );    }

    public function actionQuery14()
    {
        $model = new Query2();
        $cur_date = date('Y-m-d');

        $clientNames = Clients::find()->all();
        $name = ['Не выбрано' => 'Не выбрано'];
        foreach ($clientNames as $cl)
            $name[$cl["name"]] = $cl["name"];


        $query = Clients::find()->joinWith(['hotelrooms', 'booking','feedback', 'paymentforservices'])->groupBy('booking.id');
//            ->where(['=', 'clientbookingroom.client', 'IS NOT NULL']);

        if($model->load(Yii::$app->request->post()))
        {
            if($model->name != 'Не выбрано')
            {
                $query = $query->where(['=', 'clients.name', $model->name]);
            }

        }
        $count = $query->count();

        $clients = $query->all();
        return $this->render('query14',
            [
                'model' => $model,
                'clients' => $clients,
                'name' => $name,
                'count' => $count,
            ]
        );
    }
    public function actionQuery15()
    {
        $model = new Query2();
        $idRooms = Hotelroom::find()->all();
        $id = ['Не выбрано' => 'Не выбрано'];
        foreach ($idRooms as $i)
            $id[$i["id"]] = $i["id"];


        $query = Hotelroom::find()->joinWith(['hotelBuildings', 'booking']);


        if($model->load(Yii::$app->request->post())) {

            if($model->id != 'Не выбрано' && $model->dateStart != '' && $model->dateEnd != '')
            {
                $query = $query->where(['=', 'hotelroom.id', $model->id])
                ->andWhere(['>=', 'booking.startOfBooking', $model->dateStart  ])
                    ->andWhere(['<=', 'booking.endOfBooking', $model->dateEnd  ]);

                $countCl = Hotelroom::find()->joinWith(['hotelBuildings', 'booking'])
                    ->where(['=', 'hotelroom.id', $model->id])
                    ->andWhere(['>=', 'booking.startOfBooking', $model->dateStart  ])
                    ->andWhere(['<=', 'booking.endOfBooking', $model->dateEnd  ])
                    ->andWhere('booking.client IS NOT NULL')
                    ->count();

                $countOrg = Hotelroom::find()->joinWith(['hotelBuildings', 'booking'])
                    ->where(['=', 'hotelroom.id', $model->id])
                    ->andWhere(['>=', 'booking.startOfBooking', $model->dateStart  ])
                    ->andWhere(['<=', 'booking.endOfBooking', $model->dateEnd  ])
                    ->andWhere('booking.organization IS NOT NULL')
                    ->count();
            }
            elseif ($model->id == 'Не выбрано')
            {
                Yii::$app->session->setFlash('error', 'Выберите номер.');
            }
        }
        $count = $query->count();

        $rooms = $query->all();
        return $this->render('query15',
            [
                'model' => $model,
                'rooms' => $rooms,
                'id' => $id,
                'count' => $count,
                'countOrg' =>$countOrg,
                'countCl' => $countCl
            ]
        );
    }

    public function actionQuery16()
    {


        $query = Clientbookingroom::find();

                $countTotal = $query->count();

                $countOrg = Clientbookingroom::find()
                    ->where('clientbookingroom.organization IS NOT NULL')
                    ->count();

        $rooms = $query->all();
        return $this->render('query16',
            [
                'countOrg' =>$countOrg,
                'countTotal' => $countTotal
            ]
        );
    }
}
