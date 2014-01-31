<?php
/**
 * Handle image
 * Created by kimhwawoon.
 * Date: 14-1-24 上午11:04
 * mail: kimhwawoon@gmail.com 
 */

class Img
{
    /**
     * crop image
     * @param $source_path
     * @param $target_width
     * @param $target_height
     * @param $target_path
     * @return bool
     */
    public static function imagecropper($source_path, $target_width, $target_height, $target_path)
    {
        $source_info   = getimagesize($source_path);
        $source_width  = $source_info[0];
        $source_height = $source_info[1];
        $source_mime   = $source_info['mime'];
        $source_ratio  = $source_height / $source_width;
        $target_ratio  = $target_height / $target_width;

        // 源图过高
        if ($source_ratio > $target_ratio)
        {
            $cropped_width  = $source_width;
            $cropped_height = $source_width * $target_ratio;
            $source_x = 0;
            $source_y = ($source_height - $cropped_height) / 2;
        }
        // 源图过宽
        elseif ($source_ratio < $target_ratio)
        {
            $cropped_width  = $source_height / $target_ratio;
            $cropped_height = $source_height;
            $source_x = ($source_width - $cropped_width) / 2;
            $source_y = 0;
        }
        // 源图适中
        else
        {
            $cropped_width  = $source_width;
            $cropped_height = $source_height;
            $source_x = 0;
            $source_y = 0;
        }

        switch ($source_mime)
        {
            case 'image/gif':
                $source_image = imagecreatefromgif($source_path);
                break;

            case 'image/jpeg':
                $source_image = imagecreatefromjpeg($source_path);
                break;

            case 'image/png':
                $source_image = imagecreatefrompng($source_path);
                break;

            default:
                return false;
                break;
        }

        $target_image  = imagecreatetruecolor($target_width, $target_height);
        $cropped_image = imagecreatetruecolor($cropped_width, $cropped_height);

        // crop
        imagecopy($cropped_image, $source_image, 0, 0, $source_x, $source_y, $cropped_width, $cropped_height);
        // zoom
        imagecopyresampled($target_image, $cropped_image, 0, 0, 0, 0, $target_width, $target_height, $cropped_width, $cropped_height);

        imagedestroy($source_image);
        imagedestroy($cropped_image);

        $result = imagejpeg($target_image,$target_path);

        imagedestroy($target_image);

        return $result;
    }

    /**
     * resize image
     */
    public static function resizeImage($source_path, $target_width, $target_height, $target_path)
    {
        $source_info   = getimagesize($source_path);
        $source_width  = $source_info[0];
        $source_height = $source_info[1];
        $source_mime   = $source_info['mime'];
        $source_ratio  = $source_height / $source_width;
        $target_ratio  = $target_height / $target_width;

        // 源图过高
        if ($source_ratio > $target_ratio)
        {
            $resize_width  = $target_height / $source_ratio ;
            $resize_height = $target_height;
            $source_x = ($target_width - $resize_width) / 2;
            $source_y = 0;
        }
        // 源图过宽
        elseif ($source_ratio < $target_ratio)
        {
            $resize_width  = $target_width;
            $resize_height = $target_width * $source_ratio;
            $source_x = 0;
            $source_y = ($target_height - $resize_height) / 2;
        }
        // 源图适中
        else
        {
            $resize_width  = $target_width;
            $resize_height = $target_height;
            $source_x = 0;
            $source_y = 0;
        }

        switch ($source_mime)
        {
            case 'image/gif':
                $source_image = imagecreatefromgif($source_path);
                break;

            case 'image/jpeg':
                $source_image = imagecreatefromjpeg($source_path);
                break;

            case 'image/png':
                $source_image = imagecreatefrompng($source_path);
                break;

            default:
                return false;
                break;
        }

        $target_image  = imagecreatetruecolor($target_width, $target_height);

        //set back color
        $clr = imagecolorallocate($target_image, 255, 255, 255);
        imagefilledrectangle($target_image, 0, 0, $target_width, $target_height, $clr);

        // zoom
        imagecopyresampled($target_image, $source_image, $source_x, $source_y, 0, 0, $resize_width, $resize_height, $source_width, $source_height);

        imagedestroy($source_image);

        $result = imagejpeg($target_image,$target_path);

        imagedestroy($target_image);

        return $result;
    }
}