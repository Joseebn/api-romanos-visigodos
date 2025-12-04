<?php

namespace App\Application\Actions\Site;

class PostAction
{
    protected $postRepository;

    public function __construct($postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getAllPosts()
    {
        return $this->postRepository->getAll();
    }

    public function getPostById($id)
    {
        return $this->postRepository->findById($id);
    }

    public function createPost($data)
    {
        return $this->postRepository->create($data);
    }

    public function updatePost($id, $data)
    {
        return $this->postRepository->update($id, $data);
    }

    public function deletePost($id)
    {
        return $this->postRepository->delete($id);
    }
}