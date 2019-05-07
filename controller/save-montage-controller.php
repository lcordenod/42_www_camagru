<?php
require_once "files-directories-management-controller.php";
require_once "../config/connect.php";
require_once "debug.php";
session_start();

$content = trim(file_get_contents("php://input"));
$decoded = json_decode($content, true);
$file_tmp_path = $decoded['file_tmp_path'];

function        createUserMontageDir($user_id)
{
        $dir_path = "../sources/gallery/user-".$user_id;
        @mkdir($dir_path);
        return ($dir_path);
}

function        saveMontageToDb($user_id, $montage_path)
{
        $date = date('Y-m-d H:i:s');
        $save = db_connect()->prepare("INSERT INTO image (img_user, img_path, img_time)
        VALUES ('$user_id', '$montage_path', '$date')");
        $save->execute();
}

function        saveMontage($user_id, $file_tmp_path)
{
        $dest_path = createUserMontageDir($user_id);
        if ($montage_path = copyFileToDir($file_tmp_path, $dest_path) !== -1)
        {
                $file_tmp_dir = dirname($file_tmp_path);
                deleteFilesFromDir(dirname($file_tmp_path));
                saveMontageToDb($user_id, $montage_path);
        }
        else
                return (-1);
}

/* if (isset($file_tmp_path))
{
        if (saveMontage($_SESSION['auth']->user_id, $file_tmp_path) !== -1)
        {
                echo "Montage saved";
                echo "{\"status\": \"success\"}";
        }
        else
                echo "{\"status\": \"failed\"}";
} */

?>