<?php

namespace App\Application\Actions\Site;

class MonumentAction
{
    protected $monumentRepository;

    public function __construct(MonumentRepository $monumentRepository)
    {
        $this->monumentRepository = $monumentRepository;
    }

    public function getAllMonuments()
    {
        return $this->monumentRepository->getAll();
    }

    public function getMonumentById($id)
    {
        return $this->monumentRepository->findById($id);
    }

    public function createMonument($data)
    {
        return $this->monumentRepository->create($data);
    }

    public function updateMonument($id, $data)
    {
        return $this->monumentRepository->update($id, $data);
    }

    public function deleteMonument($id)
    {
        return $this->monumentRepository->delete($id);
    }
}