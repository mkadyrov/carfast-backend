<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use App\Filter;

$router->get('/', function () use ($router) {
   $filter = Filter::create(
        [
            'title'=> 'Camry 2020' ,
    'brand'=> '(Бренд машины)',
    'model'=>'(Модель машины)',
    'priceStart'=>'(Минимальная стоимость)',
    'priceEnd'=>'(Максимальная стоимость)',
    'region'=> '(Название области)',
    'city'=>'(Название города на латинице)',
    'city_name'=> '(Название города)',
    'yearStart'=>'(Минимальный год выпуска машины)',
    'yearEnd'=>  '(Максимальный год выпуска машины)',
    'percent'=>'(Ниже 20 процентов) 0/-20',
    'gearbox'=>' (коробка передач)',
    'condition'=>'(аварийная / на ходу)',
    'isCleared'=>[
        'type'=> 'Boolean'
    ]
        ]
    );
   return $filter->brand;
});

$router->get('/init', function () use ($router) {
    $path = resource_path() . "/json/cars.json";

    $json = json_decode(file_get_contents($path), true);
    return $json;
});
