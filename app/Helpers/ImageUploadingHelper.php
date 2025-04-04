<?php

namespace App\Helpers;

//use App\Library\ImageUpload\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

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



    public static function UploadImage($destPath, $field, $newName = '', $width = 0, $height = 0, $makeOtherSizesImages = true)
    {
        try {
            // Set main image dimensions if provided
            if ($width > 0 && $height > 0) {
                self::$mainImgWidth = $width;
                self::$mainImgHeight = $height;
            }

            // Define Folder Paths
            $destinationPath = public_path($destPath);
            $midImagePath = public_path($destPath . self::$midFolder);
            $thumbImagePath = public_path($destPath . self::$thumbFolder);
            $largeImagePath = public_path($destPath . self::$largeFolder);

            // Ensure Directories Exist
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            if (!File::exists($midImagePath)) {
                File::makeDirectory($midImagePath, 0777, true, true);
            }
            if (!File::exists($thumbImagePath)) {
                File::makeDirectory($thumbImagePath, 0777, true, true);
            }
            if (!File::exists($largeImagePath)) {
                File::makeDirectory($largeImagePath, 0777, true, true);
            }

            // Get file extension
            $extension = $field->getClientOriginalExtension();

            // Create a unique file name
            $fileName = Str::slug($newName, '-') . '-' . time() . '-' . rand(1, 999) . '.' . $extension;

            // Move the original file to the destination folder
            $field->move($destinationPath, $fileName);

            // Verify the file has been moved
            if (!file_exists($destinationPath . '/' . $fileName)) {
                \Log::error("UploadImage: File move failed for $fileName.");
                return false;
            }

            // Log success
            \Log::info("UploadImage: File uploaded successfully to $destinationPath/$fileName");

            // Create and save images using Intervention Image
            $imageToResize = Image::make($destinationPath . '/' . $fileName);
            $imageToResize->save($destinationPath . '/' . $fileName);

            if ($makeOtherSizesImages) {
                // Large image
                $imageToResize->resize(self::$largeImgWidth, self::$largeImgHeight)->save($largeImagePath . '/' . $fileName);
                \Log::info("UploadImage: Large image created at $largeImagePath/$fileName");

                // Mid image
                $imageToResize->resize(self::$midImgWidth, self::$midImgHeight)->save($midImagePath . '/' . $fileName);
                \Log::info("UploadImage: Mid image created at $midImagePath/$fileName");

                // Thumbnail image
                $imageToResize->resize(self::$thumbImgWidth, self::$thumbImgHeight)->save($thumbImagePath . '/' . $fileName);
                \Log::info("UploadImage: Thumbnail image created at $thumbImagePath/$fileName");
            }

            return $fileName;

        } catch (\Exception $e) {
            \Log::error("UploadImage Error: " . $e->getMessage());
            return false;
        }
    }

    public static function UploadImagebk($destPath, $field, $newName = '', $width = 0, $height = 0, $makeOtherSizesImages = true)
    {
        if ($width > 0 && $height > 0) {
            self::$mainImgWidth = $width;
            self::$mainImgHeight = $height;
        }
        $destinationPath = ImageUploadingHelper::real_public_path() . $destPath;
        $midImagePath = $destinationPath . self::$midFolder;
        $thumbImagePath = $destinationPath . self::$thumbFolder;
        $largeImagePath = $destinationPath . self::$largeFolder;

        if (!Storage::disk('public')->exists($destPath.self::$midFolder)) {
            File::makeDirectory(public_path($destPath.self::$midFolder), 0777, true, true);
        }

        if (!Storage::disk('public')->exists($destPath.self::$thumbFolder)) {
            File::makeDirectory(public_path($destPath.self::$thumbFolder), 0777, true, true);
        }

        if (!Storage::disk('public')->exists($destPath.self::$largeFolder   )) {
            File::makeDirectory(public_path($destPath.self::$largeFolder), 0777, true, true);
        }

        $extension = $field->getClientOriginalExtension();
        $fileName = Str::slug($newName, '-') . '-' . time() . '-' . rand(1, 999) . '.' . $extension;
        $field->move($destinationPath, $fileName);

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
