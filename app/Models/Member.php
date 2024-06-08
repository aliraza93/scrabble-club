<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'joined_at'];
    protected $appends = ['masked_phone'];

    public function games()
    {
        return $this->belongsToMany(Game::class)->withPivot('score')->withTimestamps();
    }

    // Accessor to format the phone number
    public function getMaskedPhoneAttribute()
    {
        // Format for 9-digit phone number
        if (strlen($this->phone) == 9) {
            return substr($this->phone, 0, 3) . '-' . substr($this->phone, 3, 3) . '-' . substr($this->phone, 6);
        }

        // Format for 10-digit phone number
        if (strlen($this->phone) == 10) {
            return substr($this->phone, 0, 3) . '-' . substr($this->phone, 3, 3) . '-' . substr($this->phone, 6);
        }

        // Format for 11-digit phone number
        if (strlen($this->phone) == 11) {
            return substr($this->phone, 0, 1) . '-' . substr($this->phone, 1, 3) . '-' . substr($this->phone, 4, 3) . '-' . substr($this->phone, 7);
        }

        // If the phone number has a different length, return it as is
        return $this->phone;
    }
}
