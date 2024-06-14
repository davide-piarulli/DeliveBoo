<?php

namespace App\Functions;

use Illuminate\Support\Str;

class Helper{
    public static function generateSlug($string, $model){

        $slug = Str::slug($string, '-');
        $original_slug = $slug;

        $exixts = $model::where('slug', $slug)->first();
        $c=1;

        while($exixts){
            $slug = $original_slug . '-' . $c;
            $exixts = $model::where('slug', $slug)->first();
            $c++;
        }

        return $slug;
    }
}
