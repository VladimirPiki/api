<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class PretvoriValutaController extends Controller
{
    public function pretvori(Request $request) //PRIMER SO METODA GET
    {
        $vrednost = $request->input('vrednost'); // vrednost od input vo evra 

        //Kod od dokumnetacijata https://exchangeratesapi.io/documentation/
        // set API Endpoint and API key
        $endpoint = 'latest';
        $access_key = '97908c6d7f78c855990eb27cbbd041dd';

        // Initialize CURL:
        $ch = curl_init('http://api.exchangeratesapi.io/v1/' . $endpoint . '?access_key=' . $access_key . '');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Store the data:
        $json = curl_exec($ch);
        curl_close($ch);

        // Decode JSON response:
        $exchangeRates = json_decode($json, true);
        //Kod od dokumnetacijata https://exchangeratesapi.io/documentation/

        if ($exchangeRates['success'] == 1) { //ako e uspesno zapisi true ako ne e zapisi false
            $success = "true";
        } else {
            $success = "false";
        }

        $drzavi = ['USD', 'AUD', 'CAD', 'CHF', 'MKD', 'JPY'];
        $sostojba = array();
        foreach ($drzavi as $d) {
            $sostojba[$d] = round($exchangeRates['rates'][$d] * $vrednost, 2); //round zaokruzuvam na dve cifri posle zapirkata
        }

        $jsonData = array( //pravam nov json samo za USD, AUD, CAD, CHF, MKD, and JPY
            "success" => $success,
            "data" => $sostojba
        );

        $novJson = json_encode($jsonData); //pravam nov json samo za USD, AUD, CAD, CHF, MKD, and JPY
        $pretvoreniVrednosti = json_decode($novJson, true);

        return view('welcome', ['pretvoreniVrednosti' => $pretvoreniVrednosti]); //gi nosam na pocetna strana
    }

    public function convert(Request $request) //PRIMER SO METODA POST
    {
        $vrednost = $request->input('vrednost'); // vrednost od input vo evra 

        //Kod od dokumnetacijata https://exchangeratesapi.io/documentation/
        // set API Endpoint and API key
        $endpoint = 'latest';
        $access_key = '97908c6d7f78c855990eb27cbbd041dd';

        // Initialize CURL:
        $ch = curl_init('http://api.exchangeratesapi.io/v1/' . $endpoint . '?access_key=' . $access_key . '');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Store the data:
        $json = curl_exec($ch);
        curl_close($ch);

        // Decode JSON response:
        $exchangeRates = json_decode($json, true);
        //Kod od dokumnetacijata https://exchangeratesapi.io/documentation/

        if ($exchangeRates['success'] == 1) {  //ako e uspesno zapisi true ako ne e zapisi false
            $success = "true";
            $success = "true";
        } else {
            $success = "false";
        }

        $drzavi = ['USD', 'AUD', 'CAD', 'CHF', 'MKD', 'JPY'];
        $sostojba = array();
        foreach ($drzavi as $d) {
            $sostojba[$d] = round($exchangeRates['rates'][$d] * $vrednost, 2); //round zaokruzuvam na dve cifri posle zapirkata
        }

        $jsonData = array( //pravam nov json samo za USD, AUD, CAD, CHF, MKD, and JPY
            "success" => $success,
            "data" => $sostojba
        );

        $novJson = json_encode($jsonData); //pravam nov json samo za USD, AUD, CAD, CHF, MKD, and JPY
        $pretvoreniVrednostiPost = json_decode($novJson, true);

        return view('welcome', ['pretvoreniVrednostiPost' => $pretvoreniVrednostiPost]); //gi nosam na pocetna strana
    }


    public function selektiranaValuta(Request $request)
    {
        $selektiranaValuta = $request->input('valuta');
        $vrednost = $request->input('vrednost'); // vrednost od input vo evra 

        //Kod od dokumnetacijata https://exchangeratesapi.io/documentation/
        // set API Endpoint and API key
        $endpoint = 'latest';
        $access_key = '97908c6d7f78c855990eb27cbbd041dd';

        // Initialize CURL:
        $ch = curl_init('http://api.exchangeratesapi.io/v1/' . $endpoint . '?access_key=' . $access_key . '');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Store the data:
        $json = curl_exec($ch);
        curl_close($ch);

        // Decode JSON response:
        $exchangeRates = json_decode($json, true);
        //Kod od dokumnetacijata https://exchangeratesapi.io/documentation/

        if ($exchangeRates['success'] == 1) {  //ako e uspesno zapisi true ako ne e zapisi false
            $success = "true";
            $success = "true";
        } else {
            $success = "false";
        }

        $sostojba = array();
        $sostojba[$selektiranaValuta] = round($exchangeRates['rates'][$selektiranaValuta] * $vrednost, 2); //round zaokruzuvam na dve cifri posle zapirkata

        $jsonData = array( //pravam nov json samo za USD, AUD, CAD, CHF, MKD, and JPY
            "success" => $success,
            "data" => $sostojba
        );

        $novJson = json_encode($jsonData); //pravam nov json samo za USD, AUD, CAD, CHF, MKD, and JPY
        $selektiranaValuta = json_decode($novJson, true);

        return view('welcome', ['selektiranaValuta' => $selektiranaValuta]); //gi nosam na pocetna strana
    }

    public function sitePodatoci() // primer od dokumentacija na Laravel oficijalna strana, ne e potrebno
    {
        $response = Http::get('http://api.exchangeratesapi.io/v1/latest?access_key=97908c6d7f78c855990eb27cbbd041dd');
        $jsonData = $response->body();
        dd($jsonData);
    }
}
