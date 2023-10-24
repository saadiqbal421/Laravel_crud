<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class insert_user extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'age', 'email', 'password', 'image', 'number', 'subject', 'address', 'fees', 'user_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
