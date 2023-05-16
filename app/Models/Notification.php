<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function friend()
    {
        return $this->belongsTo(Friend::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function fileUpload()
    {
        return $this->belongsTo(FileUpload::class);
    }

    public function userMessage()
    {
        return $this->belongsTo(userMessage::class);
    }
}
