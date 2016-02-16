<?php

namespace app\modules\photo\models;

use Yii;

/**
 * This is the model class for table "albums".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $owner_id
 * @property integer $is_deleted
 * @property integer $is_published
 * @property integer $created_by
 * @property string $created_date
 * @property integer $modified_by
 * @property string $modified_date
 */
class Albums extends \app\models\AppModel
{
	public $uploadsPath = null;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'albums';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'owner_id', 'created_by', 'created_date', 'modified_by', 'modified_date'], 'required'],
            [['name', 'description'], 'string'],
            [['owner_id', 'is_deleted', 'is_published', 'created_by', 'modified_by'], 'integer'],
            [['created_date', 'modified_date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tytuł albumu',
            'description' => 'Krótki opis albumu',
            'owner_id' => 'Właściciel albumu',
            'is_deleted' => 'Usunięty',
            'is_published' => 'Opublikuj',
            'created_by' => 'Utworzony przez',
            'created_date' => 'Data utworzenia',
            'modified_by' => 'Zmodyfikowany przez',
            'modified_date' => 'Data modyfikacji',
        ];
    }
	
	public function beforeValidate() 
	{
		if (!Yii::$app->user->isGuest && $this->isNewRecord) {
			$this->owner_id = Yii::$app->user->identity->id;
		}
		return parent::beforeValidate();
	}
	
	public function afterSave($insert, $changedAttributes) 
	{
		$this->createAlbumPath();
		return parent::afterSave($insert, $changedAttributes);
	}

	private function createAlbumPath()
	{
		if (!file_exists($this->getPathToAlbum())) {
			mkdir($this->getPathToAlbum());
		}
	}
	
	public function getPathToAlbum () 
	{
		if (is_null($this->uploadsPath)) {
			throw new \app\components\exceptions\FormException('Brak skonfigurowanej ścieżki utworzenia katalogu dla albumu.');
		}
		return $this->uploadsPath.$this->getFolderName();
	}
	
	public function getFolderName () 
	{
		return $this->id;
	}

	public static function findMyAlbums()
	{
		if (Yii::$app->user->isGuest) {
			throw new \app\components\exceptions\FormException('Musisz być zalogowany aby wykonać tą operację.');
		}
		return self::find()->where('owner_id = :owner_id AND is_deleted = 0', [':owner_id'=>Yii::$app->user->identity->id]);
	}
	
	public static function searchMyAlbums() 
	{
		$provider = new \yii\data\ActiveDataProvider([
			'query' => self::findMyAlbums(),
			'pagination' => [
				'pageSize' => Yii::$app->params['pageSize'],
			],
		]);
		return $provider;
	}
	
	public function getIsPublishedStatus () 
	{
		$array = [
			0 => 'Nie',
			1 => 'Tak'
		];
		return $array[$this->is_published];
	}
	
	
	public function canEdit()
	{
		return !Yii::$app->user->isGuest && $this->owner_id==Yii::$app->user->identity->id;
	}
	
	public function findListOfPhotos()
	{
		return Photos::find()->where('album_id=:album_id AND is_deleted = 0',[':album_id'=>$this->id]);
	}
	
	public function searchListOfPhotos() 
	{
		$provider = new \yii\data\ActiveDataProvider([
			'query' => $this->findListOfPhotos(),
			'pagination' => [
				'pageSize' => Yii::$app->params['pageSize'],
			],
		]);
		return $provider;
	}
}
