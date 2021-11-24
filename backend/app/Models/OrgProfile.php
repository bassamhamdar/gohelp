<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Organization;
class OrgProfile extends Model
{
    use HasFactory;
    protected $fillable = [
        'org_id',
        'about',
        'info',
        'image',
    ];
    
    public function Organization(){
        return $this->belongsTo(Organization::class);
    }
}
