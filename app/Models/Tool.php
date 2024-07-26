<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    use HasFactory;

    protected $table = 'tools';
    protected $primaryKey = 'id';

    protected $guarded = ['id'];

    public function rent()
    {
        return $this->hasMany(Rent::class, 'tool_id');
    }

    public function calibrate()
    {
        return $this->hasMany(Calibrate::class, 'tool_id');
    }
}
