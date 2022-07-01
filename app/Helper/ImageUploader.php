<?php
namespace App\Helper;

Trait ImageUploader{

    public function storeImage($file,$path='image'){

        $path = public_path('uploads');

        if ( ! file_exists($path) ) {
            mkdir($path, 0777, true);
        }

        $fileName = uniqid() . '_' . trim($file->getClientOriginalName());
        $file->move($path, $fileName);

        return $fileName;

    }
}


?>
