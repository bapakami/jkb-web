<?php

use App\Models\Setting;

if (! function_exists('jkb_setting')) {
    function jkb_setting(string $key, mixed $default = null): mixed
    {
        return Setting::get($key, $default);
    }
}

if (! function_exists('normalize_image_path')) {
    function normalize_image_path($value): string
    {
        if (is_array($value)) {
            return $value['gambar'] ?? $value['image'] ?? reset($value) ?? '';
        }

        return (string) $value;
    }
}

if (! function_exists('jkb_whatsapp_link')) {
    function jkb_whatsapp_link(string $message = ''): string
    {
        $number = preg_replace('/[^0-9]/', '', jkb_setting('whatsapp', '082000000000'));

        return 'https://wa.me/' . $number . '?text=' . rawurlencode($message);
    }
}