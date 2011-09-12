<?php

class GalleryController extends Controller
{
    public $defaultAction = 'admin';
	public $layout='column2';

    public function actionAdmin()
    {
        $this->checkAccess('user');

        $images = $this->findImages();

        $this->render('admin', array(
            'images'=>$images,
        ));
    }

    public function actionUpload()
    {
        $this->checkAccess('createImage');

        $model = new GalleryForm;

        if (isset($_POST['GalleryForm'])) {
            $model->attributes = $_POST['GalleryForm'];
            $model->image = CUploadedFile::getInstance($model, 'image');
            $this->checkUploadFactor($model->image);
            $model->image->saveAs($this->uploadsDir.DIRECTORY_SEPARATOR.urlencode($model->image->name));
            Yii::app()->user->setFlash('success', $model->image->name.' uploaded.');
        }

        $this->render('upload', array(
            'model'=>$model,
        ));
    }

    public function actionDelete()
    {
        $this->checkAccess('deleteImage');

        $name = isset($_GET['name']) ? $_GET['name'] : null;
        $path = null === $name ? null : $this->uploadsDir.DIRECTORY_SEPARATOR.$name;

        if (null !== $path && file_exists($path)) {
            if (!unlink($path)) {
                throw new CHttpException(412, Yii::t('gallery', 'Failed deleting the image.'));
            }
        }
    }

    public function checkUploadFactor($img)
    {
        if (!is_object($img) || get_class($img)!=='CUploadedFile') {
            throw new CHttpException(406, Yii::t('gallery', 'Not an instance of CUploadedFile.'));
        }

        if (!is_writable($this->uploadsDir)) {
            throw new CHttpException(412, Yii::t('gallery', 'Uploads storage path not found or unwritable.'));
        }

        if (file_exists($this->uploadsDir.DIRECTORY_SEPARATOR.urlencode($img->name))) {
            throw new CHttpException(412, Yii::t('gallery', 'Another file with the same name exists.'));
        }
    }

    public function findImages()
    {
        $images = array();
        $uploadDir = $this->uploadsDir;
        $id = 0;

        if (is_dir($uploadDir)) {
            $dir = opendir($uploadDir);
            while (false !== ($file = readdir($dir))) {
                $fullPath = $uploadDir.DIRECTORY_SEPARATOR.$file;
                if (is_file($fullPath)) {
                    $id++;
                    $img['id'] = $id;
                    $img['name'] = urldecode($file);
                    $img['thumbnail'] = $file;
                    $img['filename'] = $file;
                    $img['url'] = $this->getUploadsUrl(urlencode($file));
                    $images[] = $img;
                }
            }
            closedir($dir);
        }

        return $images;
    }

    public function getUploadsDir()
    {
        return Yii::app()->params['uploads'];
    }

    public function getUploadsUrl($fileName=null)
    {
        if (null === $fileName) {
            return Yii::app()->createUrl('').'/'.basename($this->uploadsDir);
        } else {
            return Yii::app()->createUrl('').'/'.basename($this->uploadsDir).'/'.$fileName;
        }
    }
}
