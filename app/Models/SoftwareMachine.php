<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoftwareMachine extends Model
{
    use HasFactory;
    protected $table = 'software_machines';
    protected $fillable = [
        'id_software','id_machine'
    ];
    public function softwares(){
        return $this->belongsTo(Software::class,'id_software');
    }
    public function machines(){
        return $this->belongsTo(Machine::class,'id_machine');
    }
}
