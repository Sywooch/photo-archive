<?php
namespace app\modules\photo\modules\admin;
use Yii;
/**
 * Description of Module
 *
 * @author mateusz
 */
class Module extends \yii\base\Module {
	
	public $controllerNamespace = 'app\modules\photo\modules\admin\controllers';
	public $assetsPath;
	
	public function init() {
		parent::init();
		Yii::configure($this, require(__DIR__ . '/../../config.php'));
		
		$assets = Yii::$app->getAssetManager()->publish(__DIR__.'/../../assets');
		if (isset($assets[1])) {
			$this->assetsPath = $assets[1];
		}
		
	}
}

?>
