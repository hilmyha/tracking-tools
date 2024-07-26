<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calibrate extends Model
{
    use HasFactory;

    protected $table = 'calibrates';
    protected $primaryKey = 'id';
    
    protected $guarded = ['id'];

    public function tool()
    {
        return $this->belongsTo(Tool::class, 'tool_id');
    }
}
