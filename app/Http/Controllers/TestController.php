<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

/* BASE API TEST */
class TestController extends Controller
{
    // How to connect and consume a simple API request
    // Here you can test
    public function index()
    {
        // Marca Laser API Token
        //teste
        $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIyMzgzMjc3MyIsIm5hbWUiOiJNYXJjYUxhc2VyIiwiaWF0IjoxNTE2MjM5MDIyfQ.-2XQw_TDJBVXznc_Z-Z2DLAZCezBHT6IK-9nPgjx_Zg';

        // API Base - env file
        //$client = new Client(['base_uri' => env('API_MARCALASER')]);
        $client = new Client(['base_uri' => 'http://api-marcalaser.valordistributions.com/api/']);


        // Connection params
        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept'        => 'application/json',
        ];

        /** SEARCH CATEGORIES EXAMPLE */
        // Query params
        $params = [
            'category' => 'Black'
        ];

        // Request API (Category)
        $response = $client->request('GET', 'category', [
                'headers' => $headers,
                'query' => $params
        ]);

        // Result
        // var_dump($response->getBody()->getContents());
        return ($response->getBody()->getContents());


        /** SEARCH PRODUCTS EXAMPLE */
        // Query params
        $params = [
            'category' => 'Black',
            'product_title' => 'Caderno'
        ];

        // Request API (Product)
        $response = $client->request('GET', 'product', [
                'headers' => $headers,
                'query' => $params
        ]);

        // Result
        var_dump($response->getBody()->getContents());


    }

}
