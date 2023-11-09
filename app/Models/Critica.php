<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Critica extends Model
{
    use HasFactory;

    protected $table = 'criticas';

    protected $fillable = [
        'critica',
        'user_id',
        'audiovisual_id'];

    //Relación uno a muchos (inversa):

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function audiovisual()
    {
        return $this->belongsTo(Audiovisual::class);
    }
}
