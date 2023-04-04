<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactActionComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'contact_id',
        'action_id',
        'user_id'
    ];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function action()
    {
        return $this->belongsTo(Action::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function canBeEditedOrDeletedByUser(User $user): bool
    {
        return $this->user_id === $user->id || $user->isAdmin();
    }
}
