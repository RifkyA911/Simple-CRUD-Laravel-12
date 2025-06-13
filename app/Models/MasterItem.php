<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterItem extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function kategoriItems(): BelongsToMany
    {
        return $this->belongsToMany(KategoriItem::class, 'item_kategori', 'master_item_id', 'kategori_item_id');
    }
}
