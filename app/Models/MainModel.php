<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class MainModel extends Model
{
    public $timestamps = false;
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    protected $fieldSearchAccepted = [
        'id',
        'name',
    ];
    protected $itemNotAccepted = [
        '_token',
        'thumb_current',
    ];

    public function deleteThumb($Currentthumb){
        Storage::disk('zvn_images_upload')->delete($this->currentTable.'/'.$Currentthumb);
    }

    public function updateThumb($thumbnail){
            $thumbnailb = Str::random(10) .'.'. $thumbnail->getClientOriginalExtension();
            $thumbnail->storeAs('/slider', $thumbnailb,'zvn_images_upload');//lưu ảnh bên public/images/slider
            return $thumbnailb;
    }

    public function prepareParams($params){
        return array_diff_key($params, array_flip($this->itemNotAccepted));
    }

}
