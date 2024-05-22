<?php

namespace App\Helpers;

use App\Library\ImageUpload\Image;
use Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
class ImageUploadingHelper
{

    private static $mainImgWidth = 700;
    private static $mainImgHeight = 700;
    private static $largeImgWidth = 750;
    private static $largeImgHeight = 400;
    private static $midImgWidth = 350;
    private static $midImgHeight = 300;
    private static $thumbImgWidth = 150;
    private static $thumbImgHeight = 150;
    private static $tinyMCEImgWidth = 500;
    private static $tinyMCEImgHeight = 500;
    private static $midFolder = '/mid';
    private static $largeFolder = '/large';
    private static $thumbFolder = '/thumb';

    public static function UploadImage($destinationPath, $field, $newName = '', $width = 0, $height = 0, $makeOtherSizesImages = true)
    {
        if ($width > 0 && $height > 0) {
            self::$mainImgWidth = $width;
            self::$mainImgHeight = $height;
        }
        $destinationPath = ImageUploadingHelper::real_public_path() . $destinationPath;
        $midImagePath = $destinationPath . self::$midFolder;
        $thumbImagePath = $destinationPath . self::$thumbFolder;
        $largeImagePath = $destinationPath . self::$largeFolder;
        $extension = $field->getClientOriginalExtension();
        $fileName = Str::slug($newName, '-') . '-' . time() . '-' . rand(1, 999) . '.' . $extension;
        $field->move($destinationPath, $fileName);
        /*         * **** Resizing Images ******** */
        $imageToResize = new Image($destinationPath . '/' . $fileName);

        $imageToResize->save($destinationPath . '/' . $fileName);
        if ($makeOtherSizesImages === true) {
//            large image
            $imageToResize = new Image($destinationPath . '/' . $fileName);
            $imageToResize->resize(self::$largeImgWidth, self::$largeImgHeight);
//            $imageToResize->resize(750, 400);
            $imageToResize->save($largeImagePath . '/' . $fileName);
//            mid image
            $imageToResize = new Image($destinationPath . '/' . $fileName);
            $imageToResize->resize(self::$midImgWidth, self::$midImgHeight);
            $imageToResize->save($midImagePath . '/' . $fileName);
//            thumb image
            $imageToResize = new Image($destinationPath . '/' . $fileName);
            $imageToResize->resize(self::$thumbImgWidth, self::$thumbImgHeight);
            $imageToResize->save($thumbImagePath . '/' . $fileName);
            /*             * **** End Resizing Images ******** */
        }
        return $fileName;
    }

    public static function UploadDoc($destinationPath, $field, $newName = '')
    {
        $destinationPath = ImageUploadingHelper::real_public_path() . $destinationPath;
        $extension = $field->getClientOriginalExtension();
        $fileName = Str::slug($newName, '-') . '-' . time() . '-' . rand(1, 999) . '.' . $extension;
        $field->move($destinationPath, $fileName);
        return $fileName;
    }

    public static function getFileName($fileName)
    {
        $fileName = Str::slug($fileName, '-');
        $fileName = (strlen($fileName) > 85) ? substr($fileName, 0, 85) : $fileName;
        return $fileName . '-' . rand(1, 999);
    }

    public static function MoveImage($fileName, $newFileName, $tempPath, $newPath)
    {
        $newFileName = self::getFileName($newFileName);
        $ret = false;
        $tempPath = ImageUploadingHelper::real_public_path() . $tempPath;
        $newPath = ImageUploadingHelper::real_public_path() . $newPath;
        $tempMidImagePath = $tempPath . self::$midFolder;
        $tempThumbImagePath = $tempPath . self::$thumbFolder;
        $newMidImagePath = $newPath . self::$midFolder;
        $newThumbImagePath = $newPath . self::$thumbFolder;
        if (file_exists($tempPath . '/' . $fileName)) {
            $ext = pathinfo($tempPath . '/' . $fileName, PATHINFO_EXTENSION);
            $newFileName = $newFileName . '.' . $ext;
            rename($tempPath . '/' . $fileName, $newPath . '/' . $newFileName);
            rename($tempMidImagePath . '/' . $fileName, $newMidImagePath . '/' . $newFileName);
            rename($tempThumbImagePath . '/' . $fileName, $newThumbImagePath . '/' . $newFileName);
            $ret = $newFileName;
        }
        return $ret;
    }

    public static function MoveDoc($fileName, $newFileName, $tempPath, $newPath)
    {
        $newFileName = self::getFileName($newFileName);
        $ret = false;
        $tempPath = ImageUploadingHelper::real_public_path() . $tempPath;
        $newPath = ImageUploadingHelper::real_public_path() . $newPath;
        if (file_exists($tempPath . '/' . $fileName)) {
            $ext = pathinfo($tempPath . '/' . $fileName, PATHINFO_EXTENSION);
            $newFileName = $newFileName . '.' . $ext;
            rename($tempPath . '/' . $fileName, $newPath . '/' . $newFileName);
            $ret = $newFileName;
        }
        return $ret;
    }

    public static function UploadImageTinyMce($destinationPath, $field, $newName = '')
    {
        $destinationPath = ImageUploadingHelper::real_public_path() . $destinationPath;

        $extension = $field->getClientOriginalExtension();
        $fileName = Str::slug($newName, '-') . '-' . time() . '-' . rand(1, 999) . '.' . $extension;
        $field->move($destinationPath, $fileName);
        /*         * **** Resizing Images ******** */
        $imageToResize = new Image($destinationPath . '/' . $fileName);

        $imageToResize->save($destinationPath . '/' . $fileName);

        /*         * **** End Resizing Images ******** */
        return $fileName;
    }

    public static function print_image($image_path, $width = 0, $height = 0, $default_image = '/admin_assets/no-image.png', $alt_title_txt = '')
    {
        echo self::get_image($image_path, $width, $height, $default_image, $alt_title_txt);
    }

    public static function print_doc($doc_path, $doc_title, $alt_title_txt = '')
    {
        echo self::get_doc($doc_path, $doc_title, $alt_title_txt);
    }

    public static function get_image($image_path, $width = 0, $height = 0, $default_image = '/admin_assets/no-image.png', $alt_title_txt = '')
    {
		$dimensions = '';
        if ($width > 0 && $height > 0) {
            $dimensions = 'style="max-width=' . $width . 'px; max-height:' . $height . 'px;"';
        } elseif ($width > 0 && $height == 0) {
            $dimensions = 'style="max-width=' . $width . 'px;"';
        } elseif ($width == 0 && $height > 0) {
            $dimensions = 'style="max-height:' . $height . 'px;"';
        }
		$image_src = self::print_image_src($image_path, $width, $height, $default_image, $alt_title_txt);
        return '<img src="' . $image_src . '" ' . $dimensions . ' alt="' . $alt_title_txt . '" title="' . $alt_title_txt . '">';
    }

	public static function print_image_src($image_path, $width = 0, $height = 0, $default_image = '/admin_assets/no-image.png', $alt_title_txt = '')
    {

        if (!empty($image_path) && file_exists(ImageUploadingHelper::real_public_path() . $image_path)) {
            return ImageUploadingHelper::public_path() . $image_path;
        } else {
            return asset($default_image);
        }
    }

    public static function get_doc($doc_path, $doc_title, $alt_title_txt = '')
    {
        if (!empty($doc_path) && file_exists(ImageUploadingHelper::real_public_path() . $doc_path)) {
            return '<a href="' . ImageUploadingHelper::public_path() . $doc_path . '" ' . ' alt="' . $alt_title_txt . '" title="' . $alt_title_txt . '">' . $doc_title . '</a>';
        } else {
            return 'No Doc Available';
        }
    }

    public static function print_image_relative($image_path, $width = 0, $height = 0, $default_image = '/admin_assets/no-image.png', $alt_title_txt = '')
    {
        $dimensions = '';
        if ($width > 0 && $height > 0) {
            $dimensions = 'style="max-width=' . $width . 'px; max-height:' . $height . 'px;"';
        } elseif ($width > 0 && $height == 0) {
            $dimensions = 'style="max-width=' . $width . 'px;"';
        } elseif ($width == 0 && $height > 0) {
            $dimensions = 'style="max-height:' . $height . 'px;"';
        }
        if (!empty($image_path)) {
            echo '<img src="' . $image_path . '" ' . $dimensions . ' alt="' . $alt_title_txt . '" title="' . $alt_title_txt . '">';
        } else {
            echo '<img src="' . asset($default_image) . '" ' . $dimensions . ' alt="' . $alt_title_txt . '" title="' . $alt_title_txt . '">';
        }
    }

    public static function public_path()
    {
        return url('/') . DIRECTORY_SEPARATOR;
    }

    public static function real_public_path()
    {
        return public_path() . DIRECTORY_SEPARATOR;
    }

}
