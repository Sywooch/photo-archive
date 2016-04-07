<?php
namespace app\modules\photo\controllers;

use \Yii;

/**
 * Description of JsonController
 *
 * @author mateusz
 */
class JsonController extends \app\controllers\MainappController
{	
	public $module;
    
    public function actionPhotos($album_id)
    {
//        $photos = \app\modules\photo\models\Photos::find()->where(
//            'is_deleted=0 AND album_id=:album_id',
//            [':album_id'=>$album_id]
//        )->asArray()->all();
//        Yii::$app->response->format = 'json';
        
        $pageSize = 3;
        
        $photos = \app\modules\photo\models\Photos::find()->where(
            'is_deleted=0 AND album_id=:album_id',
            [':album_id'=>$album_id]
        );
        $provider = new \yii\data\ActiveDataProvider([
			'query' => $photos,
			'pagination' => [
				'pageSize' => $pageSize,
			],
		]);
        
        $totalCount = $provider->getTotalCount();
        $totalPageCount = (int) (($totalCount/$pageSize)+1);
        if ($totalPageCount<filter_input(INPUT_GET, 'page')) {
            exit;
        }
        
        $array = array();
        foreach ($provider->getModels() as $model) {
            $array[] = $model->attributes;
        }

        Yii::$app->response->format = 'json';
        return $array;
    }
}