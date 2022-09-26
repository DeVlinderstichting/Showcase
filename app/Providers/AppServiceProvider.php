<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \DB::getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('geography','string');
        \DB::getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('geometry','string');

        Validator::extend('alpha_num_spaces', function ($attribute, $value) 
        {
            // This will only accept alpha and spaces. 
            // If you want to accept hyphens use: /^[\pL\s-]+$/u.
            return preg_match('/^[\pL\s\d]+$/u', $value); 
        });
        Validator::extend('alpha_num_spaces_minus', function ($attribute, $value) 
        {
            return preg_match('/^[\pL\s\d\-]+$/u', $value); 
        });
        Validator::extend('alpha_num_spaces_asterix', function ($attribute, $value) 
        {
            return preg_match('/^[\pL\s\d*\.]+$/u', $value); 
        });
        Validator::extend('alpha_num_spaces_asterix_minus', function ($attribute, $value) 
        {
            return preg_match('/^[\pL\s\-\'\d*\.]+$/u', $value); 
        });
        Validator::extend('alpha_num_spaces_period_dot_brackets', function ($attribute, $value) 
        {
            return preg_match('/^[\pL\s\d\.\,\?\:\;\(\)\-\+\!\\\\]+$/u', $value); 
        });
        Validator::extend('valid_timestamp', function ($attribute, $value) 
        {
            return preg_match('/[0-2]\d:[0-6]\d(:[0-6]\d)?+$/u', $value); 
        });
        Validator::extend('valid_datetimestamp', function ($attribute, $value) 
        {
            return preg_match('/[1,2]\d\d\d-[0,1]\d-[0-3]\d [0-2]\d:[0-6]\d(:[0-6]\d)?+/u', $value); 
        });
        Validator::extend('partial_email', function ($attribute, $value) 
        {
            return preg_match('/^[\pL\d\@\.\!\#\$\%\&\'\*\+\-\/\=\?\^\_\`\{\|\}\~]+$/u', $value); 
        });
        Validator::extend('valid_email', function ($attribute, $value)
        {
            return preg_match('/^[^0-9][_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/u', $value);
        });
        Validator::extend('alpha_num_underscore_minus', function ($attribute, $value) 
        {
            return preg_match('/^[\pL\d\_\-]+$/u', $value); 
        });
        Validator::extend('alpha_num_underscore_minus_dot', function ($attribute, $value) 
        {
            return preg_match('/^[\pL\d\_\.\-]+$/u', $value);
        });
        Validator::extend('alpha_num_underscore_minus_dot_at', function ($attribute, $value) 
        {
            return preg_match('/^[\pL\d\_\.\@\-]+$/u', $value);
        });
        Validator::extend('alpha_num_underscore_minus_dot_at_space', function ($attribute, $value) 
        {
            return preg_match('/^[\pL\d\_\.\s\@\-]+$/u', $value);
        });
        Validator::extend('alpha_num_underscore_minus_space', function ($attribute, $value) 
        {
            return preg_match('/^[\pL\d\_\+\s\-]+$/u', $value); 
        });
        Validator::extend('alpha_num_jsonarray', function ($attribute, $value) 
        {
            return preg_match('/^[\pL\d\_\-\+\=\:\{\}\(\)\"\'\,\.\[\]\s\?\!\\\\\/]+$/u', $value);  // /^[\pL\d\_\-\:\{\}\"\']+$/u
        });
        Validator::extend('alpha_num_eqOptionSelect', function ($attribute, $value) 
        {
            return preg_match('/^[\pL\d\_\-\:\<\>\{\}\(\)\'\=\,\.\[\]\s\\\\\/]+$/u', $value);  // /^[\pL\d\_\-\:\{\}\"\']+$/u
        });
        Validator::extend('alpha_num_exchars', function ($attribute, $value) 
        {
            return preg_match('/^[ a-zA-Z0-9.,\'"-]+$/u', $value);  // /^[\pL\d\_\-\:\{\}\"\']+$/u
        });
    }
}
