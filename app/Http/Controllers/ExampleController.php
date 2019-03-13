<?php

namespace App\Http\Controllers;
use App\Models\Tender;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class ExampleController extends Controller
{

    public function index(){
        $tenders = DB::table('tenders')
            ->leftJoin('customers', 'tenders.id', '=', 'customers.id_tender')
            ->select('*')
            ->get();

        echo ("<a href='" . route('parse') . "'>Спарсить</a> <br /> <br>" );

        foreach ($tenders as $tender) {
            echo "Название: " . $tender->title_tender . "<br/>";
            echo "Краткое наименование закупки: " . $tender->short_description . "<br/>";
            echo "Дата окончания подачи заявок: " . $tender->date_deadline . "<br/>";
            echo "Дата подведения итогов: " . $tender->final_date . "<br/>";
            echo "Наименование: " . $tender->custname . "<br/>";
            echo "Адрес: " . $tender->custaddress . "<br/>";
            echo "Телефон: " . $tender->custphone . "<br/>";
            echo "Почта: " . $tender->custemail . "<br/>";
            echo "Имя: " . $tender->custperson . "<br/>";
            echo "Описание: " . $tender->purchfullname . "<br/>";
            echo "Стоимость: " . $tender->purchamount . "<br/>";
            echo "Место рассмотрения заявки: " . $tender->comisaddress . "<br/>";
            echo "Полная страница: <a href='https://www.sberbank.ru/ru/fpartners/purchase/notification?id=" . $tender->purchid . "'> Перейти </a>";
            echo "<hr />";
        }
    }
    public function parse(){
        $tenders = json_decode(file_get_contents("https://www.sberbank.ru/portalserver/proxy/?pipe=shortCachePipe&url=http%3A%2F%2Flocalhost%2Fsbt-services%2Fservices%2Frest%2Fast%2FgetPublicPurchaseList%3FpageNum%3D2%26hash%3D3023486277"));

        foreach ($tenders->purchase as $item) {
            $data = json_decode(file_get_contents("https://www.sberbank.ru/portalserver/proxy/?pipe=shortCachePipe&url=http%3A%2F%2Flocalhost%2Fsbt-services%2Fservices%2Frest%2Fast%2FgetPurchaseOpen/" . $item->purchID));
            $tender = Tender::add($data->purchase);
            $customer = Customer::add($tender, $data->purchase->customer);
        }
        return redirect('/');
    }
    //
}
