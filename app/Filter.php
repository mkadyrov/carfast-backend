<?php
namespace App;
use Jenssegers\Mongodb\Eloquent\Model;

class Filter extends Model
{
    protected $fillable = [
        'title',
        'isActive', // New Key
        'brand',
        'model',
        'priceStart',
        'priceEnd',
        'region',
        'city',
        'city_name',
        'yearStart',
        'yearEnd',
        'percent',
        'telegram_user_id',
        'gearbox',
        'condition',
        'isCleared',
        'needsPremium',  // New Key
    ];
}
