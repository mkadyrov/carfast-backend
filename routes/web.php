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
use App\News;
use App\Stocks;
use App\User;
use Illuminate\Http\Request;

define('tokenBase', '123');

header("Access-Control-Allow-Origin: http://localhost:3000");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Methods: POST, GET');

$router->post('/api/filter/save', function (Request $request) use ($router) {
    $json = json_decode($request->getContent(), true);
    if (tokenBase === $json["token"] && isset($json["user"])) {
        $tarif = 1;
        $needsPremium = false;
        if ($tarif == 0) {
            $needsPremium = true;
        }
        if ($tarif === 1) {
            $filters = Filter::all();
            if (count($filters) > 3) {
                $needsPremium = true;
            }
            if ($json['region'] === '' || $json['brand'] === '' || $json['model'] === '') {
                $needsPremium = true;
            }
            if ($json['condition'] !== '' || $json['gearbox'] !== '' || $json['isCleared'] !== null) {
                $needsPremium = true;
            }
            if ($json['region'] === '' && $json['brand'] === '' && $json['model'] === null) {
                $needsPremium = true;
            }
        }
        if ($tarif === 2) {
            if ($json['condition'] !== '' || $json['gearbox'] !== '' || $json['isCleared'] !== null) {
                $needsPremium = true;
            }
        }
        if ($json["_id"] === 0) {
        $filter = Filter::create(
            [
                'title' => $json['brand'] . ' ' .$json['model'],
                'isActive' => false,
                'brand' => $json['brand'],
                'model' => $json['model'],
                'priceStart' => $json['priceStart'],
                'priceEnd' => $json['priceEnd'],
                'region' => $json['region'],
                'city' =>$json['city'],
                'city_name' =>$json['city_name'],
                'yearStart' => $json['yearStart'],
                'yearEnd' => $json['yearEnd'],
                'gearbox' => $json['gearbox'],
                'telegram_user_id' => $json['user'],
                'condition' => $json['condition'],
                'isCleared' => ['type' => $json['isCleared']],
                'needsPremium' => $needsPremium,
            ]);
        }
        else{
            $filter = Filter::find($json["_id"])->update(
                [
                    'title' => $json['brand'] . ' ' .$json['model'],
                    'isActive' => false,
                    'brand' => $json['brand'],
                    'model' => $json['model'],
                    'priceStart' => $json['priceStart'],
                    'priceEnd' => $json['priceEnd'],
                    'region' => $json['region'],
                    'city' =>$json['city'],
                    'city_name' =>$json['city_name'],
                    'yearStart' => $json['yearStart'],
                    'yearEnd' => $json['yearEnd'],
                    'gearbox' => $json['gearbox'],
                    'telegram_user_id' => $json['user'],
                    'condition' => $json['condition'],
                    'isCleared' => ['type' => $json['isCleared']],
                    'needsPremium' => $needsPremium,
                ]);

        }
    }
    return $json;
});

// Remove Filter (MongoDB)
$router->post('/api/delete', function (Request $request) use ($router) {
    $json = json_decode($request->getContent(), true);
    if (tokenBase === $json["token"] && isset($json["user"])) {
        Filter::find($json['id'])->delete();
    }
    return $json;
});

// Get Filters (MongoDB)
$router->get('/api/filter', function (Request $request) use ($router) {
    $filters = Filter::where("telegram_user_id",$request->get("telegram_user_id"))->orderBy('created_at', 'desc')->get();
    return $filters;
});

// Get User (MongoDB)
$router->get('/api/user/{token}', function ($token = null) use ($router) {
    $user = "";
    if ($user !== null) {
        $user = User::where('_id', $token)->get();
    }
    return $user;
});

// Get News (MongoDB)
$router->get('/api/news', function () use ($router) {
    $news = News::take(3)->get();
    return $news;
});

// Get Stocks (MongoDB)
$router->get('/api/stocks', function () use ($router) {
    $stocks = Stocks::all();
    return $stocks;
});

// Get Brands & Models Auto (FileJSON)
$router->get('/api/brands', function () use ($router) {
    $path = resource_path() . "/json/cars.json";
    $json = json_decode(file_get_contents($path), true);

    $result = [];
    foreach ($json as $item) {
        $brands = [];
        $brands['name'] = $item['brand'];
        $brands['popular'] = false;
        if (array_key_exists('popular', $item)) {
            $brands['popular'] = $item['popular'];
        }
        foreach ($item['model'] as $models) {
            $model = [];
            if (is_array($models)) {
                $model['name'] = $models['name'];
                $model['popular'] = false;
                if (array_key_exists('popular', $models)) {
                    $model['popular'] = $models['popular'];
                }
            } else {
                $model['name'] = $models;
                $model['popular'] = false;
            }
            $brands['model'][] = $model;
        }
        $result[] = $brands;
    }
    return $result;
});

// Get Regions & Cities (FileJSON)
$router->get('/api/regions', function () use ($router) {
    $path = resource_path() . "/json/regions.json";
    $json = json_decode(file_get_contents($path), true);

    $result = [];
    foreach ($json as $item) {
        $region = [];
        $region['name'] = $item['name'];
        if (!array_key_exists('popular', $item)) {
            $region['popular'] = false;
        } else {
            $region['popular'] = $item['popular'];
        }
        foreach ($item['cities'] as $cityes) {
            $city = [];
            $city['name'] = $cityes['name'];
            $city['city'] = isset($cityes['city']) ? $cityes['city'] : $cityes['name'];
            if (!array_key_exists('popular', $cityes)) {
                $city['popular'] = false;
            } else {
                $city['popular'] = $cityes['popular'];
            }
            $region['cities'][] = $city;
        }
        $result[] = $region;
    }
    return $result;
});
