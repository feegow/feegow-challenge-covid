<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Schema;

class Employee extends Model
{
    use HasFactory;

    public static function getTableColumnsName()
    {
        $columns = Schema::getColumnListing((new static)->getTable());

        return collect($columns);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
