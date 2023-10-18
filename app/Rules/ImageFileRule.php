<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ImageFileRule implements Rule
{
    public function passes($attribute, $value)
    {
        foreach ($value as $file) {
            $extension = $file->getClientOriginalExtension();
            if ($extension != 'jpg' && $extension != 'png') {
                return false;
            }
        }
        return true;
    }

    public function message()
    {
        return 'Les fichiers téléchargés doivent être au format jpg ou png.';
    }
}
