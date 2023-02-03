<?php

namespace app\controllers;

use app\models\Producto;
use yii\data\Pagination;
use Yii;

class ProductoController extends \yii\web\Controller
{
    public function behaviors(){
        $behavios = parent::behaviors();
        $behavios["verbs"] = [
            "class" => \yii\filters\VerbFilter::class,
            "actions" => [
                "index" => ["get",],
                "create" => ["post"],
                "update" => ["put"]
            ]
            
            ];
        return $behavios;
    }

    public function beforeAction($action)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }
    public function actionIndex()
    {
        $productos = Producto::find();
        $pagination = new Pagination([
            'defaultPageSize' => 7,
            'totalCount' => $productos->count(),
        ]);
        $product = $productos
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
      

        
        return $product;
    }

}
