<?php
/**
 * Copyright (C) 2018 denis909
 * based on FluxBB code copyright (C) 2008-2012 FluxBB
 * based on code by Rickard Andersson copyright (C) 2002-2008 PunBB
 * License: http://www.gnu.org/licenses/gpl.html GPL version 2 or higher
 */
namespace denis909\censoring\helpers;

class CensoringHelper
{

    public static function mb_str_pad($input, $pad_length, $pad_string = ' ', $pad_type = STR_PAD_RIGHT, $encoding = null)
    {
        if (!$encoding)
        {
            $diff = strlen($input) - mb_strlen($input);
        }
        else
        {
            $diff = strlen($input) - mb_strlen($input, $encoding);
        }

        return str_pad($input, $pad_length + $diff, $pad_string, $pad_type);
    }   

    public static function generate_replace_to($search_for, $symbol = '*')
    {
        return static::mb_str_pad('', mb_strlen($search_for), $symbol);
    }

    /**
     * Replace string matching regular expression
     *
     * This function takes care of possibly disabled unicode properties in PCRE builds.
     */
    public static function ucp_preg_replace($pattern, $replace, $subject, $callback = false)
    {
        if ($callback)
        {   
            $replaced = preg_replace_callback(
                $pattern, 
                create_function('$matches', 'return ' . $replace . ';'), 
                $subject
            );
        }
        else
        {   
            $replaced = preg_replace($pattern, $replace, $subject);
        }

        // If preg_replace() returns false, this probably means unicode support is not built-in

        if ($replaced === false)
        {
            if (is_array($pattern))
            {
                foreach ($pattern as $cur_key => $cur_pattern)
                {
                    $pattern[$cur_key] = str_replace('\p{L}\p{N}', '\w', $cur_pattern);
                }

                $replaced = preg_replace($pattern, $replace, $subject);
            }
            else
            {   
                $replaced = preg_replace(str_replace('\p{L}\p{N}', '\w', $pattern), $replace, $subject);
            }
        }

        return $replaced;
    }

    public static function mode_none_regexp(string $value) : string
    {
        return '%(' . str_replace('\*', '[\p{L}\p{N}]*?', preg_quote($value, '%')) . ')%iu';
    }

    public static function mode_left_regexp(string $value) : string
    {
        return '%(?<=[^\p{L}\p{N}])(' . str_replace('\*', '[\p{L}\p{N}]*?', preg_quote($value, '%')) . ')%iu';
    }

    public static function mode_right_regexp(string $value) : string
    {
        return '%(' . str_replace('\*', '[\p{L}\p{N}]*?', preg_quote($value, '%')) . ')(?=[^\p{L}\p{N}])%iu';
    }

    public static function mode_both_regexp(string $value) : string
    {
        return '%(?<=[^\p{L}\p{N}])(' . str_replace('\*', '[\p{L}\p{N}]*?', preg_quote($value, '%')) . ')(?=[^\p{L}\p{N}])%iu';
    }        

}