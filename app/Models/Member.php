<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'joined_at'];

    public function games()
    {
        return $this->belongsToMany(Game::class)->withPivot('score')->withTimestamps();
    }

    // Accessor to format the phone number
    public function getPhoneAttribute($value)
    {
        // Format for 9-digit phone number
        if (strlen($value) == 9) {
            return substr($value, 0, 3) . '-' . substr($value, 3, 3) . '-' . substr($value, 6);
        }

        // Format for 10-digit phone number
        if (strlen($value) == 10) {
            return substr($value, 0, 3) . '-' . substr($value, 3, 3) . '-' . substr($value, 6);
        }

        // Format for 11-digit phone number
        if (strlen($value) == 11) {
            return substr($value, 0, 1) . '-' . substr($value, 1, 3) . '-' . substr($value, 4, 3) . '-' . substr($value, 7);
        }

        // If the phone number has a different length, return it as is
        return $value;
    }
}
