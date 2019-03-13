<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Tender extends Model {
    protected $table = "tenders";
    public $timestamps = false;

    public static function add($data) {
       // dd($data);
        $model = new Tender();
        $model->title_tender = $data->purchname;
        $model->purchaddress = $data->purchaddress;
        $model->short_description = $data->purchname;
        $model->purchfullname = $data->purchfullname;
        $model->purchaddress = $data->purchaddress;
        $model->purchamount = $data->purchamount;
        $model->purchcurrency = $data->purchcurrency;
        $model->reqacceptdate = date("Y-m-d", strtotime($data->reqacceptdate));
        $model->comisaddress = $data->comisaddress;
        $model->purchdochref = $data->purchdochref;
        $model->purchid = $data->purchid;
        $model->date_deadline = date("Y-m-d", strtotime($data->reqdate));
        $model->final_date = date("Y-m-d", strtotime($data->finaldate));
        $model->save();
        return isset($model->id) ? $model->id : false;

    }
}
