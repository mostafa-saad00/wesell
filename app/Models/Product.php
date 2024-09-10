<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function generateSKU($countryName) {

        // Get current timestamp
        $timestamp = time();
        
        // Generate a random number to ensure uniqueness
        $randomNumber = rand(1000, 9999);
        
        // Combine elements to create SKU
        $sku = $countryName .  $timestamp . $randomNumber;
        
        return $sku;
    }

    public static function testFunc($email) 
    {
        if ($email)
        {
            $user = User::where('email', $email)->first();
            if($user)
            {
                return $user;
            }
            else 
            {
                return 0;
            }
        }
        else 
        {
            return redirect()->back()->with('failed', 'This user does not exist!'); 
        }
        
    }



    public static function getAssignedUserIfExist($email) 
    {

        $user = User::where('email', $email)->first();
        if($user)
        {
            return $user;
        }
        else
        {
            return redirect()->back()->with('failed', 'This user does not exist!');   
        }

    }

    public static function getIsPublishedBooleanNumber($is_published) 
    {
        if ($is_published == "Published")
        {
            return 1;
        }
        elseif ($is_published == "Draft")
        {
            return 0;
        }
        else
        {
            return redirect()->back()->with('failed', 'Wrong input!');
        }
    }



    public function users()
    {
        return $this->belongsToMany(User::class);
    }


}
