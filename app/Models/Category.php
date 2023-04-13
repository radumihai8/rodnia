<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }

    //check if the category is empty ( no subcategories, or subcategories that are empty )
    public function isEmpty()
    {
        $subcategories = $this->subcategories;

        foreach ($subcategories as $subcategory) {
            if (!$subcategory->isEmpty()) {
                return false;
            }
        }
        return true;
    }
}
