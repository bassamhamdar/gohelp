<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Organization;
class activity extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    
    public function organization()
    {
        return $this->hasOne(Organization::class);
    }
}

