<?php

namespace denis909\censoring\components;

use Yii;
use denis909\censoring\helpers\CensoringHelper;
use denis909\censoring\models\Censoring;

class CensoringComponent extends \yii\base\Component
{

    const CENSORING = Censoring::class;

    public $enableCache = false;

    public $cacheIndex = 'censoring';

    protected $_search_for;

    protected $_replace_with;

    /**
     * Generate the censoring cache PHP script
     */
    public function generateCensoringCache()
    {
        if (Yii::$app->has('cache'))
        {
            return Yii::$app->cache->getOrSet($this->cacheIndex, function()
            {
                $class = static::CENSORING;

                return $class::getCensoringCache();
            });
        }

        return static::get_censoring_cache();
    }    

    public function censorWords(string $text) : string
    {
        if ($this->_search_for === null)
        {
            list($this->_search_for, $this->_replace_with) = $this->generateCensoringCache();
        }

        $text = CensoringHelper::ucp_preg_replace($this->_search_for, $this->_replace_with, ' ' . $text . ' ');

        $text = substr($text, 1, -1);

        return $text;
    }

}