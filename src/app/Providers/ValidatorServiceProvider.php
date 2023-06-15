<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class ValidatorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Validator::extend('date_greater_than', function ($attribute, $value, $parameters, $validator) {
            $otherDate = $validator->getData()[$parameters[0]] ?? null;
            if ($otherDate && $value) {
                return \Carbon\Carbon::parse($value)->gt(\Carbon\Carbon::parse($otherDate));
            }
            return true;
        });
    }
}
