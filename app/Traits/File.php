<?php

namespace App\Traits;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use League\Glide\Server;
use Image;

trait File
{
    function getImageUrl($file, $folder, $width = 100, $height = null): string
    {
        // S3 Image Get Global
        $path = "{$folder}/{$file}";

        $isSVG = (strpos($path, '.svg') > -1);

        if (!$isSVG && $width) {
            $path .= "?w={$width}";
        }

        if (!$isSVG && $height) {
            if ($width) {
                $path .= "&?h={$height}";
            } else {
                $path .= "?h={$height}";
            }
        }
        return route('image.get', $path);
    }

    public function upload($file, $folder): array
    {
        // S3 Image Upload Global
        $fileName = $this->rename($file)->__toString();

        Storage::disk(config('filesystems.storage_type'))->put("public/uploads/{$folder}/{$fileName}", file_get_contents($file), 'public');

        return [
            'name' => $fileName,
            'original_name' => $file->getClientOriginalName(),
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
        ];
    }

    protected function rename($file): \Illuminate\Support\Stringable
    {
        // S3 Image Rename Global
        return Str::of(time())
            ->append('_')
            ->append(Str::random(10))
            ->append('.')
            ->append($file->getClientOriginalExtension());
    }

    /**
     * @param $file
     * @param $folder
     * @return bool
     */
    public function delete($file, $folder): bool
    {
        // S3 Image Delete Global
        if ($this->exists($file, $folder)) {
            $filePath = "public/uploads/{$folder}/{$file}";
            $server = App::make(Server::class);
            $server->deleteCache($filePath);
            return Storage::disk(config('filesystems.storage_type'))->delete($filePath);
            //return Storage::delete($filePath);
        }
        return false;
    }


    function resizeImage($image,$path)
{
   
      $image = $image;    
      $fileName = rand(111111,999999).time().'.'.$image->getClientOriginalExtension(); 
      $destinationPath = public_path($path);
      $img = Image::make($image->getRealPath());
      $img->resize(500, 500, function ($constraint) {
          $constraint->aspectRatio();
      })->save($destinationPath.'/'.$fileName);

      return $fileName;
 
    //   $destinationPath = public_path($path);
    //   $image->move($destinationPath, $input['imagename']);

}

    protected function exists($file, $folder): bool
    {
        return Storage::disk(config('filesystems.storage_type'))->exists("public/uploads/{$folder}/{$file}");
    }
}
