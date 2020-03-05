<?php
namespace App;
use Jenssegers\Mongodb\Eloquent\Model;

class Filter extends Model
{
    protected $fillable = [
        'title',
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
        'gearbox',
        'condition',
        'isCleared'
    ];
}
