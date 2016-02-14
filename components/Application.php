<?php
/**
 * Description of Application
 *
 * @author mateusz
 */
class Application extends yii\web\Application{
	
	public function run() {
		
		try {
			return parent::run();
		} catch (Exception $exc) {
			\app\helpers\Flash::setUndisplayError($exc->getMessage());
			header("location:/site/oooops");
		}
	}
}

?>
