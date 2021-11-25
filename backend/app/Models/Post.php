<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Organization;
use App\Models\Donation;
class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'org_id',
        'title',
        'description',
        'image',
    ];
    public function Organization(){
        return $this->belongsTo(Organization::class);
    }
    
    public function Donation(){
        return $this->hasMany(Donation::class);
    }
}
