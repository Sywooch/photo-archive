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
        $pageSize = 10;
        
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
    
    public function actionNextphoto($photo_id)
    {
        $photo = \app\modules\photo\models\Photos::findNext($photo_id);
        $array = $photo->attributes;
        Yii::$app->response->format = 'json';
        return $array;
    }
    
    public function actionPreviousphoto($photo_id)
    {
        $photo = \app\modules\photo\models\Photos::findPrevious($photo_id);
        $array = $photo->attributes;
        Yii::$app->response->format = 'json';
        return $array;
    }
}
