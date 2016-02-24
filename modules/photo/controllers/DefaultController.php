<?php
namespace app\modules\photo\controllers;
use \Yii;
/**
 * Description of DefaultController
 *
 * @author mateusz
 */
class DefaultController extends \app\controllers\MainappController{
	
	public $module;
	
//	public function __call($name, $params) {
//		echo $name; exit;
//		return parent::__call($name, $params);
//	}
//	
	public function actionIndex()
	{
		exit;
	}
	
	public function createAction($id) 
	{
		$part = explode('_', $id);
		if (isset($part[0]) && isset($part[1]) && strpos($part[0], 'img')!==false) {
			$this->getPhoto(str_replace('img', '', $part[0]),$part[1]);
			exit;
		}
		return parent::createAction($id);
	}
	
	private function getPhoto($id, $resolution)
	{
		$photo = \app\modules\photo\models\Photos::findOne($id);
		$photo->createAlbumPath($this->module->params['uploadsPath']);
		return (new \app\modules\photo\components\Image($photo, $resolution))->get()->render();
	}
}

?>
