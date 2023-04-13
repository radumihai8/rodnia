<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function items()
    {
        return $this->hasMany(ShopItem::class);
    }

    //function that returns true if the category is empty ( no items, or items that have available_start and available_end set and current time between )
    public function isEmpty()
    {
        $items = $this->items;

        foreach ($items as $item) {
            if ($item->available_start == null && $item->available_end == null) {
                return false;
            } else {
                if(Carbon::now()->between($item->available_start, $item->available_end)) {
                    return false;
                }
            }
        }
        return true;
    }
}
