<?php

namespace App\Application\Actions\Site;

use App\Models\GalleryImage;

class GalleryAction
{
    public function __invoke($request, $response, $args)
    {
        $galleryData = $this->getGallery();
        $response->getBody()->write(json_encode($galleryData));
        return $response->withStatus(200)
            ->withHeader('Content-Type', 'application/json');
    }

    private function getGallery(): array
    {
        $gallery = GalleryImage::all();

        $galleryData = [];
        foreach ($gallery as $image) {
            $galleryData[] = [
                'name' => $image->name,
                'description' => $image->description,
                'image_path' => $image->image_path,
                'image_id' => $image->image_id,
                'type' => $image->architectureType->name,
            ];
        }
        return $galleryData;
    }
}