<?php

if (!function_exists('__t')) {
    /**
     * Get translation from database
     */
    function __t($key, $default = null, $languageCode = null)
    {
        return \App\Models\Translation::get($key, $languageCode, $default);
    }
}

if (!function_exists('set_translation')) {
    /**
     * Set translation in database
     */
    function set_translation($key, $value, $languageCode)
    {
        return \App\Models\Translation::set($key, $value, $languageCode);
    }
}

if (!function_exists('get_current_language')) {
    /**
     * Get current language
     */
    function get_current_language()
    {
        return \App\Models\Language::where('code', app()->getLocale())->first() ?? \App\Models\Language::getDefault();
    }
}

if (!function_exists('get_available_languages')) {
    /**
     * Get all active languages
     */
    function get_available_languages()
    {
        return \App\Models\Language::getActive();
    }
}
