<?php

namespace App\Controller\Site;

use App\Aplication\Action\Site\GalleryAction;

class GalleryController
{
    public function index()
    {
        // Load the Gallery model
        $this->loadModel('Gallery');

        // Fetch all gallery items
        $items = $this->Gallery->find('all');

        // Pass the items to the view
        $this->set('items', $items);
    }
}