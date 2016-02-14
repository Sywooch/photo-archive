<?php
namespace app\modules\photo\modules\admin\controllers;

use \Yii;

/**
 * Description of AlbumController
 *
 * @author mateusz
 */
class AlbumController extends \app\controllers\MainappController
{
	
	/**
	 * Formularz tworzenia nowego albumu
	 * @return type
	 */
	public function actionCreate () 
	{
		return $this->actionEdit(0);
	}
	
	/**
	 * Formularz edycji albumu
	 * @param type $id
	 * @return type
	 * @throws \app\components\exceptions\FormException
	 */
	public function actionEdit ($id) 
	{
		$model = new \app\modules\photo\models\Albums();
		if ($id > 0) {
			$model = $model->findOne($id);
			if (!$model) {
				throw new \app\components\exceptions\FormException('Nie znaleziono obiektu',404);
			}		
			if (!$model->canEdit()) {
				throw new \app\components\exceptions\FormException('Nie możesz dodawać zdjęć do tego albumu.',403);
			}
		}
		
		$post = Yii::$app->request->post('Albums');
		if ($post) {
			$model->setAttributes($post);
			$trans = Yii::$app->db->beginTransaction();
			try {
				$model->uploadsPath = $this->module->params['uploadsPath'];
				if ($model->validate() && $model->save()) {
					\app\helpers\Flash::setSuccess('Zapisano poprawnie.');
					$this->redirect(['/photo/admin/album/edit','id'=>$model->id]);
				} else {
					throw new \app\components\exceptions\FormException('Błąd podczas zapisu.');
				}
				$trans->commit();
			} catch (\yii\base\Exception $exc) {
				$trans->rollback();
				\app\helpers\Flash::setError($exc->getMessage());
			}
		}
		
		return $this->render('edit',[
			'id' => $id,
			'model' => $model
		]);
	}
	
	/**
	 * Lista albumów zalogowanego użytkownika
	 */
	public function actionMylist()
	{
		$dataProvider = \app\modules\photo\models\Albums::searchMyAlbums();
		return $this->render('list',[
			'dataProvider' => $dataProvider,
			'title' => 'Lista moich albumów'
		]);
	}
	
}

?>
