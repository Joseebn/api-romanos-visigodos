<?php

namespace App\Application\Actions\Site;

class GalleryAction
{
    protected $galleryRepository;

    public function __construct($galleryRepository)
    {
        $this->galleryRepository = $galleryRepository;
    }

    public function getAllGalleries()
    {
        return $this->galleryRepository->getAll();
    }

    public function getGalleryById($id)
    {
        return $this->galleryRepository->findById($id);
    }

    public function createGallery($data)
    {
        return $this->galleryRepository->create($data);
    }

    public function updateGallery($id, $data)
    {
        return $this->galleryRepository->update($id, $data);
    }

    public function deleteGallery($id)
    {
        return $this->galleryRepository->delete($id);
    }
}