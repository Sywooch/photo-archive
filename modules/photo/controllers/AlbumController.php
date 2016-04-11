<?php
namespace app\modules\photo\controllers;

use \Yii;

/**
 * Description of AlbumController
 *
 * @author mateusz
 */
class AlbumController extends \app\controllers\MainappController
{
    public function actionIndex()
    {
        $albums = \app\modules\photo\models\Albums::find()->all();
        return $this->render('index',[
            'albums' => $albums
        ]);
    }
    
    public function actionShow($id)
    {
        return $this->render('show',[
            'id' => $id,
            'assetsPath' => $this->module->assetsPath
        ]);
    }
    
    public function actionRead()
    {
    }
}
