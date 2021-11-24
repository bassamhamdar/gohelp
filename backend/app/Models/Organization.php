<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\activity;
use App\Models\OrgProfile;
use App\Models\Address;
use App\Models\User;
use App\Models\UserRequest;
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
    
    public function OrgProfile(){
        return $this->hasOne(OrgProfile::class, 'org_id');
    }
    public function Address(){
        return $this->hasMany(Address::class,'org_id');
    }
    
    public function User(){
        return $this->belogsToMany(User::class);
    }

    public function Request(){
        return $this->hasMany(UserRequest::class, 'org_id');
    }
    public function setPasswordAttribute($password){
        $this->attributes['password'] = bcrypt($password);
    }
    
}
