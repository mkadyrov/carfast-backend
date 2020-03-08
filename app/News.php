<?php
namespace App;
use Jenssegers\Mongodb\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'name',
        'text',
        'image',
        'create_at',
    ];
}
