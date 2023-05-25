<?php

namespace Audentio\LaravelColorValidator;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Illuminate\Validation\Validator;

class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {
        $this->app->resolving('validator', function ($factory, $app) {
            /** @var \Illuminate\Validation\Factory $factory */
            $factory->extend('color', function (string $attribute, mixed $value, array $parameters, Validator $validator) {
                $validatorType = $parameters[0] ?? 'all';

                return match ($validatorType) {
                    'hex' => ColorValidator::isHexColor($value),
                    'rgb' => ColorValidator::isRgbColor($value),
                    'rgba' => ColorValidator::isRgbaColor($value),
                    'hsl' => ColorValidator::isHslColor($value),
                    'hsla' => ColorValidator::isHslaColor($value),
                    default => ColorValidator::isColor($value),
                };
            });
        });
    }
}