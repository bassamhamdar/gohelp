<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Organization;

class UserRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'org_id',
        'title',
        'description',
        'image',
        'isDonation',

    ];
    public function User(){
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function Organization(){
        return $this->belongsTo(Organization::class, 'user_id');
    }
}
