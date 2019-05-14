<?php

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
        $file = basename($file_path);
        $newfile_path = $dest_path."/".$file;

        if (!copy($file_path, $newfile_path))
                console_log("failed to copy $file...\n");
        return($dest_path."/".$file);
}

function        isDirEmpty($path) {
        if ($files = glob($path . "/*"))
                return (false);
        else
                return (true);
}

?>