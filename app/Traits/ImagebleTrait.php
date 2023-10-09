<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait ImagebleTrait
{
    public static function bootImagebleTrait()
    {
        foreach (static::$imageble as $image) {
            static::retrieved(function ($model) use ($image) {
                $model->append($image.'_url');
            });
        }
    }

    public function __call($method, $parameters)
    {
        foreach (static::$imageble as $image) {
            if ($method == 'get'.Str::studly($image).'UrlAttribute') {
                if (empty($this->$image) || ! Storage::exists($this->$image)) {
                    return '';
                }

                return Storage::url($this->$image);
            }
        }

        return parent::__call($method, $parameters);
    }
}
