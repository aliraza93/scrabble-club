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

    // Define an accessor for the phone attribute
    public function getPhoneAttribute($value)
    {
        // Check if the phone number is provided and has at least 8 digits
        if ($value && strlen($value) >= 8) {
            // Format the phone number as "(##) ####-####"
            return preg_replace('/^(\d{2})(\d{4})(\d{4})$/', '($1) $2-$3', $value);
        } else {
            // Return the original phone number if it doesn't meet the conditions
            return $value;
        }
    }
}
