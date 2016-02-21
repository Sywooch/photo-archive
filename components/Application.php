<?php
/**
 * Description of Application
 * test
 * @author mateusz
 */
class Application extends yii\web\Application{
	
	public function run() {
		
		try {
			return parent::run();
		} catch (Exception $exc) {
            Yii::error(print_r('RUN LOG:'.$exc,true));
			\app\helpers\Flash::setUndisplayError($exc->getMessage());
			header("location:/site/oooops");
		}
	}
}

?>
