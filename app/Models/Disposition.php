<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disposition extends Model
{
    use HasFactory;

    protected $fillable = [
        'disposition_at',
        'reply_at',
        'description',
        'mail_id',
        'user_id',
        'notification',
        'status'
    ];
    // Relasi dengan tabel 'users'
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan tabel 'mails'
    public function mail()
    {
        return $this->belongsTo(Mails::class);
    }
}
