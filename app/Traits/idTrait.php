<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

trait idTrait
{
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = static::generateUserId();
        });
    }

    /**
     * Generate a new user ID.
     *
     * @return string
     */
    public static function generateUserId()
    {
        $date = Carbon::now()->format('dmY'); // Format tanggal saat ini
        $lastId = static::where('id', 'LIKE', "{$date}%")
                        ->orderBy('id', 'desc')
                        ->value('id');
        
        if ($lastId) {
            $lastNumber = (int) substr($lastId, 8);
        } else {
            $lastNumber = 0;
        }

        $nextNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

        return $date . $nextNumber;
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}