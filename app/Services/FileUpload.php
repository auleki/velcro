<?php
namespace App\Services;

use Illuminate\Support\Facades\Storage;
use League\Flysystem\Filesystem;

class FileUpload {
  public static function uploadImage($picture, $folder)
  {
    // create unique name for picture
    $name = time() . $picture->getClientOriginalName();
    
    // file path the file is stored
    $filePath = $folder . '/' .  $name;
    
    // store file to aws s3
    Storage::disk('public')->put($filePath, file_get_contents($picture));
    // Set file visibility to public
    Storage::disk('public')->setVisibility($filePath, 'public');

    // url of the stored file from s3
    // $url = 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/' . $filePath;
    $url = config('app.url') . '/storage/'.$filePath;
    // dd($url);
    return $url;
  }

  public static function uploadExcel($excel, $folder)
  {
    // create unique name for excel
    $name = time() . $excel->getClientOriginalName();
    
    // file path the file is stored
    $filePath = $folder . '/' .  $name;
    
    // store file to aws s3
    Storage::disk('public')->put($filePath, file_get_contents($excel));
    // Set file visibility to public
    Storage::disk('public')->setVisibility($filePath, 'public');

    // url of the stored file from s3
    // $url = 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/' . $filePath;
    $url = config('app.url') . '/storage/'.$filePath;
    // dd($url);
    return $url;
  }
}

?>