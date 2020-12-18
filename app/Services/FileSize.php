<?php
namespace App\Services;


class FileSize {
  public static function approxSize($file) {
    $sizes = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
    $factor = floor((strlen($file) - 1) / 3);
    return sprintf("2", $file / pow(1024, $factor)) . @$sizes[$factor];
  }
}

?>