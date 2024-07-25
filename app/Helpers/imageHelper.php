<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;


class ImageHelper
{
    public static function addWatermarkAndSave($file,$storePath, $text = 'Faistroquer', $fontSize = 15, $fontColor = '#a0a0a0', $angle = 90)
    {
        // Create an image instance
        $image = Image::make($file->getPathname());
        
        $xPosition = $image->width() -10;
        $yPosition = $image->height() -130;
        
        // Add the text to the image
        $image->text($text, $xPosition, $yPosition, function($font) use ($fontSize, $fontColor, $angle) {
            $font->file(public_path('fonts/Arial-MT-Std-Black-Italic.ttf')); // Specify the path to the font file
            $font->size($fontSize); // Set the font size
            $font->color($fontColor); // Set the font color
            $font->align('right'); // Align the text horizontally
            $font->valign('middle'); // Align the text vertically
            $font->angle($angle); // Set the text angle
        });

        // Define the path where the image will be stored
       // $storePath = 'profile_pictures/' . $file->hashName();

        // Save the modified image to the desired path
        Storage::put($storePath, (string) $image->encode());

        return $storePath;
    }
}
