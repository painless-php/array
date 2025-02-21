<?php

namespace PainlessPHP\Array\Internal;

class StringHelpers
{
    /**
     * Functionality borrowed from Illuminate/Support/Str 11.x
     */
    public static function replaceFirst(string $subject, string $search, string $replace) : string
    {
        $search = (string) $search;

        if ($search === '') {
            return $subject;
        }

        $position = strpos($subject, $search);

        if ($position !== false) {
            return substr_replace($subject, $replace, $position, strlen($search));
        }

        return $subject;
    }
}
