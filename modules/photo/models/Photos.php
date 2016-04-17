<?php

namespace app\modules\photo\models;

use Yii;

/**
 * This is the model class for table "photos".
 *
 * @property integer $id
 * @property integer $is_deleted
 * @property integer $album_id
 * @property string $file_orig_name
 * @property string $file_sys_name
 * @property string $file_ext
 * @property string $title
 * @property string $description
 * @property integer $owner_id
 * @property integer $created_by
 * @property string $created_date
 * @property integer $modified_by
 * @property string $modified_date
 */
class Photos extends \app\models\AppModel
{
	public $imageFile;
	public $albumPath;
	
	static $fileTempName = 'tmp';
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'photos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_deleted', 'album_id', 'owner_id', 'created_by', 'modified_by'], 'integer'],
            [['album_id', 'file_orig_name', 'file_sys_name', 'file_ext', 'owner_id', 'created_by', 'created_date', 'modified_by', 'modified_date'], 'required'],
            [['file_orig_name', 'file_sys_name', 'file_ext', 'title', 'description'], 'string'],
            [['created_date', 'modified_date', 'title', 'description'], 'safe'],
			[['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, JPG, PNG'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'is_deleted' => 'Is Deleted',
            'album_id' => 'Album ID',
            'file_orig_name' => 'File Orig Name',
            'file_sys_name' => 'File Sys Name',
            'file_ext' => 'File Ext',
            'title' => 'Title',
            'description' => 'Description',
            'owner_id' => 'Owner ID',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
            'modified_by' => 'Modified By',
            'modified_date' => 'Modified Date',
        ];
    }
	
	public function beforeValidate() {
		if ($this->isNewRecord) {
			$this->file_orig_name = $this->imageFile->name;
			$this->file_ext = $this->imageFile->extension;
			$this->title = $this->imageFile->name;
			$this->file_sys_name = self::$fileTempName;
			$this->description = 'To zdjęcie nie ma jeszcze opisu.';
			if (!Yii::$app->user->isGuest) {
				$this->owner_id = Yii::$app->user->identity->id;
			} else {
				throw new \app\components\exceptions\FormException('Musisz być zalogowany by wgrać plik.');
			}
		}
		return parent::beforeValidate();
	}
	
	public function afterSave($insert, $changedAttributes) {
		if ($this->file_sys_name == self::$fileTempName) {
			$this->createSysName();
			$this->save();
		}
		return parent::afterSave($insert, $changedAttributes);
	}
	
	public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs($this->getFilePath());
            return true;
        } else {
            return false;
        }
    }
	
	public function getFilePath () 
	{
		return $this->albumPath.DIRECTORY_SEPARATOR.$this->file_sys_name;
	}
	
	public function createAlbumPath($path)
	{
		$this->albumPath = $path.$this->album_id.DIRECTORY_SEPARATOR;
	}
	
	private function createSysName () 
	{
		$this->file_sys_name = (String)$this->id;
	}
    
    static public function findNext($id)
    {
        $photo = self::find()->where('id=:id', [':id'=>$id])->one();
        $next = self::find()->where('album_id=:album_id AND id>:id',[':album_id'=>$photo->album_id,':id'=>$id])->orderBy('id')->one();
        if (is_object($next)) {
            return $next;
        }
        return $photo;
    }
    
    static public function findPrevious($id)
    {
        $photo = self::find()->where('id=:id', [':id'=>$id])->one();
        $previous = self::find()->where('album_id=:album_id AND id<:id',[':album_id'=>$photo->album_id,':id'=>$id])->orderBy('id DESC')->one();
        if (is_object($previous)) {
            return $previous;
        }
        return $photo;
    }
}
