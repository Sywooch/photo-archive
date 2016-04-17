<?php
namespace app\modules\photo\components;
class Image
{
	private $photo;
	private $ext;
	private $height = 'a';
	private $width = 'a';
	
	private $filenameOrig;
	private $filename;
	private $resolution;
	
	private $image;
	private $image_info;
	private $image_type;
	
	private $availableResolutions = [
		'axa',
		'ax400',
        'ax200',
		'400x400',
        'ax800'
	];
	
	public function __construct($photo,$resolution) {
		
		if (!in_array($resolution, $this->availableResolutions)) {
			return;
		}
		
		$this->photo = $photo;
		$this->filenameOrig = $photo->getFilePath();
		$this->ext = $photo->file_ext;
		$this->resolution = $resolution;
		$this->setResolution($resolution);
		$this->setFileName();
		return $this;
	}
	
	public function get()
	{
		if (file_exists($this->filename)) {
			$this->getImage();
		} else {
			$newFileName = $this->filename;
			$this->filename = $this->filenameOrig;
			$this->getImage();
			$this->filename = $newFileName;
			$this->create();
		}
		
		return $this;
	}
	
	private function getImage()
	{
		$this->image_info = getimagesize($this->filename);
		$this->image_type = $this->image_info[2];
		switch($this->image_type){
			case IMAGETYPE_JPEG:
				$this->image = imagecreatefromjpeg($this->filename);
				break;
			case IMAGETYPE_GIF:
				$this->image = imagecreatefromgif($this->filename);
				break;
			case IMAGETYPE_PNG:
				$this->image = imagecreatefrompng($this->filename);
				break;
			case IMAGETYPE_BMP:
				$this->image = imagecreatefrombmp($this->filename);
				break;
		}
	}
	
	public function render()
	{
		header('Content-Type: image/jpeg');
		switch($this->image_type){
			case IMAGETYPE_JPEG:
				imagejpeg($this->image);
				break;
			case IMAGETYPE_GIF:
				imagegif($this->image);
				break;
			case IMAGETYPE_PNG:
				imagepng($this->image);
				break;
			case IMAGETYPE_BMP:
				/* nie obsługiwany */
				break;
		}
	}
	
	private function create()
	{
		if ($this->width=='a' && $this->height=='a') {
			$this->filename = $this->filenameOrig;
		} else if ($this->width=='a'){
			$this->resizeToHeight($this->height);
		} else if ($this->height=='a'){
			$this->resizeToWidth($this->width);
		} else {
			$this->resize($this->width, $this->height);
		}
		$this->save();
		return $this;
	}
	
	private function setResolution($resolution)
	{
		list($this->width,$this->height) = explode('x', $resolution);
	}
	
	private function setFileName()
	{
		$this->filename = $this->filenameOrig.'_'.$this->resolution;
        $this->filename = str_replace('//', '/', $this->filename);
	}
	
	/**
	* zmiana rozmiaru obrazu
	* @param type $width
	* @param type $height
	* @param type $dist_x
	* @param type $dist_y
	* @param type $src_x
	* @param type $src_y
	* @param type $width2
	* @param type $height2 
	*/
	private function resize($width,$height, $dist_x = 0, $dist_y = 0, $src_x = 0, $src_y = 0, $width2 = 0, $height2 = 0 )
	{
		$new_image = imagecreatetruecolor($width, $height);
		if($width2 == 0) $width2 = $width;
		if($height2 == 0) $height2 = $height;
		imagecopyresampled($new_image, $this->image, $dist_x, $dist_y, $src_x, $src_y, $width2, $height2, $this->getWidth(), $this->getHeight());
		$this->image = $new_image;
	}
	
	private function resizeToWidth($width) 
	{
		$ratio = $width / $this->getWidth();
		$height = $this->getheight() * $ratio;
		$this->resize($width,$height);
	}
	
	private function resizeToHeight($height) 
	{

		$ratio = $height / $this->getHeight();
		$width = $this->getWidth() * $ratio;
		$this->resize($width,$height);
	}
	
	 /**
	* pobranie szerokości obrazu
	* @return type 
	*/
	private function getWidth() 
	{

		return imagesx($this->image);
	}
	 
	 /**
	* pobranie wysokości obrazu
	* @return type 
	*/
	private function getHeight() 
	{

		return imagesy($this->image);
	}
	
	private function save($filename = '', $image_type='', $compression=75, $permissions=null) 
	{
		if($filename == '') $filename = $this->filename;
		if($image_type == '') $image_type = $this->image_type;
                switch($image_type){
                    case IMAGETYPE_JPEG:
                        imagejpeg($this->image,$filename,$compression);
                        break;
                     case IMAGETYPE_GIF :
                        $index = imagecolorexact($this->image, 0, 0, 0);
                        imagegif($this->image,$filename);
                        break;
                     case IMAGETYPE_PNG:
                        $index = imagecolorexact($this->image, 0, 0, 0);
                        imagecolortransparent($this->image, $index); 
                        imagepng($this->image,$filename);
                        break;
                     case IMAGETYPE_BMP:
                         imagebmp($this->image,$filename);
                        break;
                }
		if( $permissions != null) {

			chmod($filename,$permissions);
		}
	}
}