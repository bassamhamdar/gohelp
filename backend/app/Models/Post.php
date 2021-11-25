<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Organization;
class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'org_id',
        'title',
        'description'
    ];
    public function Organization(){
        return $this->belongsTo(Organization::class);
    }
}
