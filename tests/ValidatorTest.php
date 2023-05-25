<?php

final class ValidatorTest extends \PHPUnit\Framework\TestCase
{
    private function getColorValues(): array
    {
        return [
            '#fff' => 'hex',
            '#ffffff' => 'hex',
            'rgb(155,27,38)' => 'rgb',
            'rgba(150,93,99,0.2)' => 'rgba',
            'hsl(180, 50%, 50%)' => 'hsl',
            'hsla(180, 50%, 50%, 0.5)' => 'hsla',
            'rgb(973,20,105)' => 'invalid',
        ];
    }

    public function testColorValues(): void
    {
        $this->validateColors('isColor');
    }

    public function testHexValues(): void
    {
        $this->validateColors('isHexColor', 'hex');
    }

    public function testRgbValues(): void
    {
        $this->validateColors('isRgbColor', 'rgb');
    }

    public function testRgbaValues(): void
    {
        $this->validateColors('isRgbaColor', 'rgba');
    }

    public function testHslValues(): void
    {
        $this->validateColors('isHslColor', 'hsl');
    }

    public function testHslaValues(): void
    {
        $this->validateColors('isHslaColor', 'hsla');
    }

    private function validateColors(string $method, ?string $expectedType = null): void
    {
        foreach ($this->getColorValues() as $color => $type) {
            $isColor = \Audentio\LaravelColorValidator\ColorValidator::$method($color);
            if ($expectedType === null) {
                if ($type !== 'invalid') {
                    $this->assertTrue($isColor, 'Failed to validate that "' . $color . '" is a valid color');
                } else {
                    $this->assertFalse($isColor, 'Failed to validate that "' . $color . '" is NOT a valid color');
                }
            } else {
                if ($type === $expectedType) {
                    $this->assertTrue($isColor, 'Failed to validate that "' . $color . '" is a valid color');
                } else {
                    $this->assertFalse($isColor, 'Failed to validate that "' . $color . '" is NOT a valid color');
                }
            }
        }

    }
}