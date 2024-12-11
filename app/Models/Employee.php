<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'cpf', 'birthday', 'comorbidity'];

    public static function getTableColumnsName()
    {
        $columns = Schema::getColumnListing((new static)->getTable());

        return collect($columns);
    }

    protected function birthdayFormatted(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->birthday)->format('m/d/Y'),
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
