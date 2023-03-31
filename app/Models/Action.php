<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'comment', 'scheduled_at', 'contact_id'];
    protected $dates = ['scheduled_at'];
    

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
