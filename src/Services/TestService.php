<?php

namespace AreaWeb\LaravelPackage\Services;

use Illuminate\Support\Facades\Hash;

class TestService
{
    public function getAnotherText(): string
    {
        return fake()->text;
    }

    public function hashString(string $string): string
    {
        return Hash::make($string);
    }

    public function sum(int $a, int $b)
    {
        return $a + $b;
    }

    public function getUrl()
    {
        return config('laravel-package.url');
    }

    public function getSecret()
    {
        return config('laravel-package.secret');
    }
}