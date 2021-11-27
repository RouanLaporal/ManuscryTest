<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Etabli la connexion à l'api, récupère les données, détermine la plus grosse croissance sur les dernières 24h et ajoute une trace de cette crypto dans la BD
     * @return view return la vue crypto et lui fourni les variables à afficher
     */
    public function apiWithKey(){
        $client = new Client;
        $url = "api.coincap.io/v2/assets";
        
        $headers = [
            'api-key' => '5f87c432-9344-4350-b91d-32999d89bf1d'
        ];

        $response = $client->request('GET', $url, [
            'headers' => $headers,
            'verify' => false,
        ]);

        $responseBody = json_decode($response->getBody());
        $maxGrowth =  floatval($responseBody->data[0]->changePercent24Hr);
        foreach ($responseBody->data as $response => $value){
            if(floatval($value->changePercent24Hr) > $maxGrowth){
                $maxGrowth = floatval($value->changePercent24Hr);
                $maxName = $value->name;
                $maxValue = floatval($value->priceUsd);
            }
        }
        $data = array('cryptoName' => $maxName, "price"=>$maxValue, "growth" => $maxGrowth);
        DB::table('cryptos')->insert($data);

        return view('crypto', compact([
            'maxName' => $maxName,
            'maxGrowth' => substr($maxGrowth,0,6),
            'maxValue' => substr($maxValue,0,8),
        ]));
    }
}
