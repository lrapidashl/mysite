<?php
declare(strict_types=1);

namespace App\Upload;

class UploadFiles
{
    public static function checkAvatarType(string $fileName): ?string
    {
        try {
            if (!isset($_FILES[$fileName]['error']) || is_array($_FILES[$fileName]['error'])) 
            {
                throw new \RuntimeException('Invalid parameters.');
            }
            switch ($_FILES[$fileName]['error']) 
            {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    return null;
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    throw new \RuntimeException('Exceeded filesize limit.');
                default:
                    throw new \RuntimeException('Unknown errors.');
            }
            $finfo = new \finfo();
            $ext = array_search(
                $finfo->file($_FILES[$fileName]['tmp_name'], FILEINFO_MIME_TYPE),
                array(
                    'jpg' => 'image/jpeg',
                    'png' => 'image/png',
                    'gif' => 'image/gif',
                ),
                true
            );
            if (!$ext) 
            {
                throw new \RuntimeException('Invalid file format.');
            }

            return sha1_file($_FILES[$fileName]['name']) . '.' . $ext;
        } 
        catch (\RuntimeException $err) 
        {
            echo $err->getMessage();
            return null;
        }
    }

    public static function uploadAvatar(string $fileName, string $avatarName): void
    {
        try
        {
            if (!move_uploaded_file($_FILES[$fileName]['tmp_name'], 'uploads/' . $avatarName)) 
            {
                throw new \RuntimeException('Failed to move uploaded file.');
            }
        }
        catch (\RuntimeException $err) 
        {
            echo $err->getMessage();
        }
    }
}