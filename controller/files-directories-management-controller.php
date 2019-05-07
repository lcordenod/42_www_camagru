<?php
require_once "debug.php";

function deleteFilesFromDir($dir_path)
{
        $files = glob($dir_path."/*");

        foreach($files as $file)
        {
                if (is_file($file))
                        unlink($file);
        }
}

function    copyFileToDir($file_path, $dest_path)
{
        $file = preg_match('/\/([a-zA-Z]+\.[a-zA-Z]+)/', $file_path);
        $file = preg_replace('\\', '');
        console_log($file_path);
        console_log($file);
        $newfile_path = $dest_path.$file;

        if (!copy($file, $newfile_path))
                console_log("failed to copy $file...\n");
        return($dest_path.$file);
}

?>