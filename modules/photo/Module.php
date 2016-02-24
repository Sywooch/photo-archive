<?php
namespace app\modules\photo;
use Yii;
/**
 * Description of Module
 *
 * @author mateusz
 */
class Module extends \yii\base\Module {
	
	public $controllerNamespace = 'app\modules\photo\controllers';
	public $assetsPath;
	
	public function init() {
		parent::init();
		Yii::configure($this, require(__DIR__ . '/config.php'));
		
		$assets = Yii::$app->getAssetManager()->publish(__DIR__.'/assets');//,['forceCopy'=>true]
		if (isset($assets[1])) {
			$this->assetsPath = $assets[1];
		}
		
		$this->modules = [
            'admin' => [
                'class' => 'app\modules\photo\modules\admin\Module',
            ],
        ];
	}
	
	public function createController($route)
    {
        // check valid routes
        $validRoutes  = [$this->defaultRoute, "admin", "album"];
        $isValidRoute = false;
        foreach ($validRoutes as $validRoute) {
            if (strpos($route, $validRoute) === 0) {
                $isValidRoute = true;
                break;
            }
        }

        return (empty($route) or $isValidRoute)
            ? parent::createController($route)
            : parent::createController("{$this->defaultRoute}/{$route}");
    }
}

?>
