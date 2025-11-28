<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
        'title','ingredients','instructions','category','prep_time','image_path','user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
