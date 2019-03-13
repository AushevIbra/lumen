<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model {
    protected $table = "customers";
    public $timestamps = false;

    public static function add($id_tender, $customer) {
        $model = new Customer();
        $model->id_tender = $id_tender;
        $model->custname = $customer->custname;
        $model->custaddress = $customer->custaddress;
        $model->custphone = $customer->custphone;
        $model->custemail = $customer->custemail;
        $model->custperson = $customer->custperson;
        $model->save();
    }
}
