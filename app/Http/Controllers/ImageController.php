<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use League\Glide\Server;

class ImageController extends Controller
{
    public function show(Server $server, $path, Response $response)
    {
        if (strpos($path, '.svg') > -1) {
            $response->header('Content-Type', 'image/svg+xml');
            $response->setContent(file_get_contents(public_path("storage/uploads/{$path}")));
            return $response;
        }

        return $server->getImageResponse("public/uploads/{$path}", request()->all());
    }
}