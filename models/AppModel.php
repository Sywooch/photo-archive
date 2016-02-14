<?php
namespace app\models;

use \Yii;
/**
 * Description of AppModel
 *
 * @author mateusz
 */
class AppModel extends \yii\db\ActiveRecord
{
	
	public function beforeValidate() 
	{
		$this->setDefaultValues();
		return parent::beforeValidate();
	}
	
	public function setDefaultValues () 
	{
		/* Dane dotyczące utworzenia */
		if ($this->isNewRecord) {
			if (!Yii::$app->user->isGuest && $this->hasAttribute('created_by')) {
				$this->created_by = Yii::$app->user->identity->id;
			}
			if ($this->hasAttribute('created_date')) {
				$this->created_date = \app\helpers\DateTime::now();
			}
		}
		/* Dane dotyczące ostatniej modyfikacji */
		if (!Yii::$app->user->isGuest && $this->hasAttribute('modified_by')) {
			$this->modified_by = Yii::$app->user->identity->id;
		}
		if ($this->hasAttribute('modified_date')) {
			$this->modified_date = \app\helpers\DateTime::now();
		}
	}
	
}

?>
