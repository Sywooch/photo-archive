<?php
namespace app\modules\photo\modules\admin\controllers;

use \Yii;

/**
 * Description of PhotoController
 *
 * @author mateusz
 */
class PhotoController extends \app\controllers\MainappController
{
	public function actionAdd($album_id)
	{
		/* Czy mam prawo do albumu */
		$album = \app\modules\photo\models\Albums::findOne($album_id);
		if (!$album->canEdit()) {
			throw new \app\components\exceptions\FormException('Nie możesz dodawać zdjęć do tego albumu.',403);
		}
		
		return $this->render('add',['album'=>$album,'assetsPath'=>$this->module->assetsPath]);
	}
	
	public function actionTarget() 
	{	
		$request = Yii::$app->request;
		$uploadedFile = \yii\web\UploadedFile::getInstanceByName('file');
		if ($uploadedFile && $request->post('album_id')) {
			$album = \app\modules\photo\models\Albums::findOne($request->post('album_id'));
			if (!$album || !$album->canEdit()) {
				throw new \app\components\exceptions\FormException('Nie możesz dodawać zdjęć do tego albumu.',403);
			}
			$album->uploadsPath = $this->module->params['uploadsPath'];
			$trans = Yii::$app->db->beginTransaction();
			try {
				$photo = new \app\modules\photo\models\Photos();
				$photo->album_id = $album->id;
				$photo->albumPath = $album->getPathToAlbum();
				$photo->imageFile = $uploadedFile;
				if ($photo->validate() && $photo->save()) {
					if (!$photo->upload()) {
						throw new \app\components\exceptions\FormException('Błąd podczas zapisu pliku w '.$this->getFilePath().': '.print_r($this->errors,true));
					}
					$trans->commit();
				} else {
					throw new \app\components\exceptions\FormException('Problem podczas zapisu danych pliku.');
				}
			} catch (\yii\base\Exception $exc) {
				$trans->rollBack();
				echo $exc->getMessage();
				echo $exc->getTraceAsString();
			}
		} else {
			throw new \app\components\exceptions\FormException('Nie odebrano poprawnie danych.');
		}
		Yii::$app->end();
	}
	
	public function actionList($album_id) 
	{
		/* Czy mam prawo do albumu */
		$album = \app\modules\photo\models\Albums::findOne($album_id);
		if (!$album || !$album->canEdit()) {
			throw new \app\components\exceptions\FormException('Nie możesz edytować zdjęć tego albumu.',403);
		}
		
		$dataProvider = $album->searchListOfPhotos();
		return $this->render('list',[
			'dataProvider' => $dataProvider,
			'album' => $album,
			'title' => 'Zdjęcia'
		]);
	}
}

?>
