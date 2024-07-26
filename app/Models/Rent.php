<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    use HasFactory;

    protected $table = 'rents';
    protected $primaryKey = 'id';

    protected $guarded = ['id'];

    public function tool()
    {
        return $this->belongsTo(Tool::class, 'tool_id');
    }

    // public function borrowTools()
    // {
    //     $this->rental_status = 'Rented';
    //     $this->rental_date = now();
    //     $this->save();

    //     $tools = $this->tool;
    //     $tools->tool_status = 'Rented';
    //     $tools->save();
    // }

    // public function returnTools()
    // {
    //     $this->rental_status = 'Returned';
    //     $this->return_date = now();
    //     $this->save();

    //     $tools = $this->tool;
    //     $tools->tool_status = 'Available';
    //     $tools->save();
    // }
}
