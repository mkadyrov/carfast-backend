<?php
namespace App;
use Jenssegers\Mongodb\Eloquent\Model;

class Stocks extends Model
{
    protected $fillable = [
        'title',
        'text',
        'social',
        'promo',
        'create_at',
    ];
}
