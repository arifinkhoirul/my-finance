<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KritikDanSaran extends Model
{
    use SoftDeletes, HasFactory;

    protected  $table = 'kritik_dan_saran';
    protected $fillable = [
        'user_id',
        'nama_samaran',
        'description'
    ];




    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
