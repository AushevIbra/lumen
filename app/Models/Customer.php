<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model {
    protected $table = "customers";
    public $timestamps = false;

    public static function add($id_tender, $customer) {
        $model = new Customer();
        $model->id_tender = $id_tender;
        $model->body_customer = $customer;
        $model->save();
    }
}
