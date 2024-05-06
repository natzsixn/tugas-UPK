<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mails extends Model
{
    use HasFactory;

    protected $fillable = ['mail_code', 'mail_to', 'mail_from', 'mail_date', 'mail_subject', 'description', 'mail_type_id', 'incoming_at', 'file_upload', 'user_id'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mailType()
    {
        return $this->belongsTo(MailType::class);
    }

    public function dispositions()
    {
        return $this->hasMany(Disposition::class);
    }
}
