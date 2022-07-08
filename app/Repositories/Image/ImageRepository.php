<?php

namespace App\Repositories\Image;

use App\Models\Image;
use App\Repositories\BaseRepository;

class ImageRepository extends BaseRepository implements ImageRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return Image::class;
    }

    public function getImage($id)
    {
        return $this->model->findOrFail($id);
    }
}
