<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\activity;
class Organization extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'regNo',
        'activity_id',
        'status',
    ];
    protected $hidden = [
        'password'
    ];


    public function activity()
    {
        return $this->belongsTo(activity::class);
    }
    public function setPasswordAttribute($password){
        $this->attributes['password'] = bcrypt($password);
    }
}
