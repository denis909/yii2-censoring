<?php

/**
 * Copyright (C) 2018 denis909
 * based on FluxBB code copyright (C) 2008-2012 FluxBB
 * based on code by Rickard Andersson copyright (C) 2002-2008 PunBB
 * License: http://www.gnu.org/licenses/gpl.html GPL version 2 or higher
 */
namespace common\helpers;

use Yii;
use Exception;
use common\models\Censoring;
use yii\db\Query;

class CensoringHelper
{

	const CACHE_ID = 'censoring_cache';

	protected static $_search_for = null;

	protected static $_replace_with = null;

	//
	// Get the censoring cache PHP script
	//
	public static function get_censoring_cache()
	{
		$search_for = [];

		$replace_to = [];

		$query = (new Query)
			->select(['search_for', 'replace_with', 'mode'])
			->from(Censoring::tableName())
			->orderBy('length DESC');
 
		foreach ($query->each() as $row)
		{
			switch($row['mode'])
			{
				case Censoring::MODE_BOTH:

					$search_for[] = '%(?<=[^\p{L}\p{N}])(' . str_replace('\*', '[\p{L}\p{N}]*?', preg_quote($row['search_for'], '%')) . ')(?=[^\p{L}\p{N}])%iu';

					break;

				case Censoring::MODE_LEFT:

					$search_for[] = '%(?<=[^\p{L}\p{N}])(' . str_replace('\*', '[\p{L}\p{N}]*?', preg_quote($row['search_for'], '%')) . ')%iu';

					break;

				case Censoring::MODE_RIGHT:

					$search_for[] = '%(' . str_replace('\*', '[\p{L}\p{N}]*?', preg_quote($row['search_for'], '%')) . ')(?=[^\p{L}\p{N}])%iu';

					break;

				case Censoring::MODE_NONE:

					$search_for[] = '%(' . str_replace('\*', '[\p{L}\p{N}]*?', preg_quote($row['search_for'], '%')) . ')%iu';

					break;

				default: 

					throw new Exception('Unknown mode: ' . $row['mode']);
			}			

			if ($row['replace_with'])
			{
				$replace_to[] = $row['replace_with']; 
			}
			else
			{
				$replace_to[] = static::generate_replace_to($row['search_for'], '*');
			}
		}

		return [$search_for, $replace_to];	
	}	

	//
	// Generate the censoring cache PHP script
	//
	public static function generate_censoring_cache()
	{
		if (Yii::$app->has('cache'))
		{
			return Yii::$app->cache->getOrSet(static::CACHE_ID, function()
			{
				return static::get_censoring_cache();
			});			
		}

		return static::get_censoring_cache();
	}

	//
	// Replace string matching regular expression
	//
	// This function takes care of possibly disabled unicode properties in PCRE builds
	//
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

		// If preg_replace() returns false, this probably means unicode support is not built-in, so we need to modify the pattern a little
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

	public static function censor_words($text)
	{
		if (static::$_search_for === null)
		{
			list(static::$_search_for, static::$_replace_with) = static::generate_censoring_cache();
		}

		$text = static::ucp_preg_replace(static::$_search_for, static::$_replace_with, ' ' . $text . ' ');

		$text = substr($text, 1, -1);

		return $text;
	}

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

}