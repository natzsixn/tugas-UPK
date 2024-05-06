<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailType extends Model
{
    use HasFactory;

    protected $fillable = ['type'];

    public function mails()
    {
        return $this->hasMany(Mails::class);
    }
    public function disposition()
    {
        return $this->hasMany(disposisi::class);
    }
}
