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
            echo <<<HTML
            <div style="display: flex; justify-content: space-around;">
                <div>
                    Извещение: <br />
                    $tender->body
                </div>
                <div>
                    Заказчик: <br />
                    $tender->body_customer
                    <hr>
                    Полный адрес: <br/>
                    <a href="$tender->full_url">Перейти</a>
                </div>
            </div>

HTML;

            echo "<hr />";
        }
    }
    public function parse(){
        $data = json_decode(file_get_contents("http://localhost:3000/"));

        foreach ($data->ids as $temp) {
            //sleep(5);
            $id = preg_replace("/[^,.0-9]/", '', $temp);
            $response = json_decode(file_get_contents("http://localhost:3000/parse/" . $id));
            $tender = Tender::add($response->html, "https://www.sberbank.ru/ru/fpartners/purchase/notification" . $temp);
            $customer = Customer::add($tender, $response->customer);
        }
        return redirect('/');
    }
    //
}
