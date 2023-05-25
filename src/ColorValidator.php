<?php

namespace Audentio\LaravelColorValidator;

use Spatie\Color\Exceptions\InvalidColorValue;
use Spatie\Color\Hex;
use Spatie\Color\Hsl;
use Spatie\Color\Hsla;
use Spatie\Color\Rgb;
use Spatie\Color\Rgba;

class ColorValidator
{
    public static function isColor(string $color): bool
    {
        return static::isHexColor($color) ||
            static::isRgbColor($color) ||
            static::isRgbaColor($color) ||
            static::isHslColor($color) ||
            static::isHslaColor($color);
    }

    public static function isHexColor(string $color): bool
    {
        return static::validateColor(Hex::class, $color);
    }

    public static function isRgbColor(string $color): bool
    {
        return static::validateColor(Rgb::class, $color);
    }

    public static function isRgbaColor(string $color): bool
    {
        return static::validateColor(Rgba::class, $color);
    }

    public static function isHslColor(string $color): bool
    {
        return static::validateColor(Hsl::class, $color);
    }

    public static function isHslaColor(string $color): bool
    {
        return static::validateColor(Hsla::class, $color);
    }

    private static function validateColor(string $class, string $color): bool
    {
        try {
            $class::fromString($color);
        } catch (InvalidColorValue $e) {
            return false;
        }

        return true;
    }
}