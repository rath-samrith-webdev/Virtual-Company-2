<?php
namespace App\Traits;

trait uploadImage{

    function saveImage($image, $path)
    {
        $imageName = time().'_'.$image->getClientOriginalName();

        $image->move($path, $imageName);

        // $image->storeAs($path,$imageName,'public');
        return $imageName;
    }
}
