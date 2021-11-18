<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function findProductId($article, $manufacturer) {
        $url = "https://superposuda.retailcrm.ru/api/v5/store/products";
        $params = [
            'filter[name]' => $article,
            'filter[manufacturer]' => $manufacturer,
        ];
        $apiKey = [
            'apiKey' => 'QlnRWTTWw9lv3kjxy1A8byjUmBQedYqb'
        ];
        $result = json_decode(
            file_get_contents($url .'?'. http_build_query($params).'&'.http_build_query($apiKey)),
            true
        );
        if (count($result['products']) < 1) return false;
        return $result['products'][0]['offers'][0]['id'];
    }

    public function create( Request $request) {
    $name = ($request->input('name'));
    $fullname = explode(' ', $name);
    $fullname = list($lastName, $firstName, $patronymic) = $fullname;
    $article = ($request->input('article'));
    $manufacturer =($request->input('manufacturer'));
    $comment = ($request->input('comment'));
    $product_id = $this->findProductId($article,$manufacturer);

    $order = [
        'status' => 'trouble',
        'type' => 'fizik',
        'site' => 'test',
        'orderMethod' => 'test',
        'number' => '24122001',
        'lastName' => $lastName,
        'firstName' => $firstName,
        'patronymic' => $patronymic,
        'customerComment' => $comment,
        'items' => [
            'offer' => [
                'id' => $product_id
            ]
        ]
    ];

    $order = json_encode($order);
    $order = ['order' => $order];

    $createURL = 'https://superposuda.retailcrm.ru/api/v5/orders/create?apiKey=QlnRWTTWw9lv3kjxy1A8byjUmBQedYqb';
    $curl = curl_init($createURL);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $order);
        $result = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($result, true);
    }


}
