<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

class Vaccine extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'batch', 'expiry'];

    public static function getTableColumnsName()
    {
        $columns = Schema::getColumnListing((new static)->getTable());

        return collect($columns);
    }

    protected function expiryFormatted(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->expiry)->format('m/d/Y'),
        );
    }
}
