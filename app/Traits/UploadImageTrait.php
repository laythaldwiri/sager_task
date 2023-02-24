<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

trait  UploadImageTrait
{
    // ================================================================
    // ================= Save File In Folder Function =================
    // ================================================================
    function saveFile($orginal_image, $upload_location)
    {
        $name_gen = hexdec(uniqid());
        $img_ext = $orginal_image->getClientOriginalExtension();
        $img_name = $name_gen . '.' . $img_ext;
        $last_image = $upload_location . $img_name;
        $orginal_image->move($upload_location, $img_name);
        return $last_image;
    }


    // ================================================================
    // ================ Save Image In Folder Function =================
    // ================================================================
    function saveImage($file, $folder)
    {

        if (!file_exists($folder)) {
            File::makeDirectory($folder, $mode = 0777, true, true);
        }
        $file_extension = $file->getClientOriginalExtension();
        $file_base_64 = base64_encode(file_get_contents($file->path()));
        $file_decoded = base64_decode($file_base_64);
        $imagejpg = imagecreatefromstring($file_decoded);
        $file_name = $folder . '/' . time() . rand();
        $image = imagewebp($imagejpg, $file_name . '.webp');
        return $file_name . '.webp';
    }


    // ================================================================
    // ============ Save File With Original Name Function =============
    // ================================================================
    function saveFileWithOriginalName($table_name, $table_column, $orginal_image, $original_name, $upload_location)
    {
        if (!file_exists($upload_location)) {
            File::makeDirectory($upload_location, $mode = 0777, true, true);
        }
        $img_ext_firstsearch = $orginal_image->getClientOriginalExtension();
        $img_ext_tosearch = '.' . $img_ext_firstsearch;
        $img_search_name = str_replace($img_ext_tosearch, '', $original_name);
        $check_old = DB::table($table_name)->where($table_column, 'like', '%' . $img_search_name . '%')->get();
        $counter = $check_old->count();
        if ($counter > 0) {
            $img_name = $img_search_name . '(' . $counter . ')';
        } else {
            $img_name = $img_search_name;
        }
        $file_type = exif_imagetype($orginal_image);
        switch ($file_type) {
            case '1': //IMAGETYPE_GIF
                $imagejpg = imagecreatefromgif($orginal_image);
                break;
            case '2': //IMAGETYPE_JPEG
                $imagejpg = imagecreatefromjpeg($orginal_image);
                break;
            case '3': //IMAGETYPE_PNG
                $imagejpg = imagecreatefrompng($orginal_image);
                imagepalettetotruecolor($imagejpg);
                imagealphablending($imagejpg, true);
                imagesavealpha($imagejpg, true);
                break;
            case '6': // IMAGETYPE_BMP
                $imagejpg = imagecreatefrombmp($orginal_image);
                break;
            case '15': //IMAGETYPE_Webp

                $imagejpg = imagecreatefromwebp($orginal_image);
                break;
            case '16': //IMAGETYPE_XBM
                $imagejpg = imagecreatefromxbm($orginal_image);
                break;
            default:
                $file_base_64 = base64_encode(file_get_contents($orginal_image->path()));
                $file_decoded = base64_decode($file_base_64);
                $imagejpg = imagecreatefromstring($file_decoded);
        }
        $file_name = $img_name;
        $image = imagewebp($imagejpg, $upload_location . $file_name . '.webp');
        return $upload_location . $file_name . '.webp';
    }

    // ================================================================
    // ============= Save File With Compression Function ==============
    // ================================================================
    function saveFileWithCompression($table_name, $table_column, $orginal_image, $original_name, $upload_location)
    {
        if (!file_exists($upload_location)) {
            File::makeDirectory($upload_location, $mode = 0777, true, true);
        }
        $img_ext_firstsearch = $orginal_image->getClientOriginalExtension();
        $img_ext_tosearch = '.' . $img_ext_firstsearch;
        $img_search_name = str_replace($img_ext_tosearch, '', $original_name);
        $check_old = DB::table($table_name)->where($table_column, 'like', '%' . $img_search_name . '%')->get();
        $counter = $check_old->count();
        if ($counter > 0) {
            $img_name = $img_search_name . '(' . $counter . ')';
        } else {
            $img_name = $img_search_name;
        }
        $quality = 50;
        $file_type = exif_imagetype($orginal_image);
        switch ($file_type) {
            case '1': //IMAGETYPE_GIF
                $imagejpg = imagecreatefromgif($orginal_image);
                $quality = 30;
                break;
            case '2': //IMAGETYPE_JPEG
                $imagejpg = imagecreatefromjpeg($orginal_image);
                break;
            case '3': //IMAGETYPE_PNG
                $imagejpg = imagecreatefrompng($orginal_image);
                imagepalettetotruecolor($imagejpg);
                imagealphablending($imagejpg, true);
                imagesavealpha($imagejpg, true);

                $quality = 6;
                break;
            case '6': // IMAGETYPE_BMP
                $imagejpg = imagecreatefrombmp($orginal_image);
                $quality = 30;
                break;
            case '15': //IMAGETYPE_Webp

                $imagejpg = imagecreatefromwebp($orginal_image);
                $quality = 30;
                break;
            case '16': //IMAGETYPE_XBM
                $imagejpg = imagecreatefromxbm($orginal_image);
                $quality = 30;
                break;
            default:

                $file_base_64 = base64_encode(file_get_contents($orginal_image->path()));
                $file_decoded = base64_decode($file_base_64);
                $imagejpg = imagecreatefromstring($file_decoded);

                $quality = 30;
        }
        $file_name = $img_name;
        $image = imagewebp($imagejpg, $upload_location . $file_name . '.webp', $quality);
        return $upload_location . $file_name . '.webp';
    }


    // ================================================================
    // ================= Update Images Sizes Function =================
    // ================================================================
    function updateImagesSizes($tale_name, $table_column, $orginal_image, $original_name, $upload_location)
    {
        if (!file_exists($upload_location)) {
            File::makeDirectory($upload_location, $mode = 0777, true, true);
        }

        $img_ext_firstsearch = $orginal_image->getClientOriginalExtension();
        $img_ext_tosearch = '.' . $img_ext_firstsearch;
        $img_search_name = str_replace($img_ext_tosearch, '', $original_name);

        $img_name = $img_search_name;
        $quality = 10;


        $file_type = exif_imagetype($orginal_image);
        switch ($file_type) {
            case '1': //IMAGETYPE_GIF
                $imagejpg = imagecreatefromgif($orginal_image);

                break;
            case '2': //IMAGETYPE_JPEG
                $imagejpg = imagecreatefromjpeg($orginal_image);
                break;
            case '3': //IMAGETYPE_PNG
                $imagejpg = imagecreatefrompng($orginal_image);
                imagepalettetotruecolor($imagejpg);
                imagealphablending($imagejpg, true);
                imagesavealpha($imagejpg, true);

                $quality = 6;
                break;
            case '6': // IMAGETYPE_BMP
                $imagejpg = imagecreatefrombmp($orginal_image);

                break;
            case '15': //IMAGETYPE_Webp

                $imagejpg = imagecreatefromwebp($orginal_image);

                break;
            case '16': //IMAGETYPE_XBM
                $imagejpg = imagecreatefromxbm($orginal_image);

                break;
            default:

                $file_base_64 = base64_encode(file_get_contents($orginal_image->path()));
                $file_decoded = base64_decode($file_base_64);
                $imagejpg = imagecreatefromstring($file_decoded);
        }



        $file_name = $img_name;



        // File::delete($upload_location.$original_name);

        $image = imagewebp($imagejpg, $upload_location . $file_name . '.webp', 0.25);

        return $upload_location . $file_name . '.webp';
    }
}