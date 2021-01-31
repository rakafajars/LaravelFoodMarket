<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Food extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name_food', 'description', 'ingredients', 'price_food',
        'ratefood', 'type_food', 'picturePath'
    ];

    // asesor untuk mengubah field yang kita punya di database
    // dan akan keluar sesuai keinginan kita

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->timestamp;
    }

    public function UpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->timestamp;
    }

    public function toArray()
    {
        $toArray = parent::toArray();
        $toArray['picturePath'] = $this->picturePath;
        return $toArray;
    }

    // fungsi untuk mengubah nama field
    public function getPicturePathAttribute()
    {
        return url('') . Storage::url($this->attributes['picturePath ']);
    }
}
