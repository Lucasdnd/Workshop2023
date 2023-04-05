<?php

namespace App\Models;

use App\Models\ContactActionComment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'comment', 'scheduled_at', 'contact_id', 'is_done'];
    protected $dates = ['scheduled_at'];


    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function comments()
    {
        return $this->hasMany(ContactActionComment::class)->orderByDesc('created_at');
    }
}
