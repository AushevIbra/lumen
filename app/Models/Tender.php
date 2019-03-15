<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Tender extends Model {
    protected $table = "tenders";
    public $timestamps = false;

    public static function add($data, $url) {
        $model = new Tender();
        $model->body = $data;
        $model->full_url = $url;
        $model->save();
        return isset($model->id) ? $model->id : false;

    }
}
