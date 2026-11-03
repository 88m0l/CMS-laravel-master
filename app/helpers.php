<?php

use Illuminate\Support\Str;

if (!function_exists('unique_slug'))
{
    function unique_slug(string $string, string $model, $column = 'slug', int $maxLength = 60): string
    {
        $slug = Str::substr(Str::slug($string, language: false), 0, $maxLength);
        $orignalSlug = $slug;
        $count = 1;
        while($model::where($column, $slug)->exists()){
            $slug = $orignalSlug . '-' . $count;
            $count++;
        }
        
        return $slug;
    }
}
