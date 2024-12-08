<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Vaccine extends Model
{
    use HasFactory;

    public static function getTableColumnsName()
    {
        $columns = Schema::getColumnListing((new static)->getTable());

        return collect($columns);
    }
}
