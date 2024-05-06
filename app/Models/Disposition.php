<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disposition extends Model
{
    use HasFactory;

    protected $fillable = ['disposition_at', 'reply_at', 'description', 'notification', 'ref_type_id', 'mail_id', 'user_id', 'status'];
    // Relasi dengan tabel 'users'
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan tabel 'mail_types'
    public function mailType()
    {
        return $this->belongsTo(MailType::class, 'ref_type_id');
    }

    // Relasi dengan tabel 'mails'
    public function mail()
    {
        return $this->belongsTo(Mails::class);
    }
}
