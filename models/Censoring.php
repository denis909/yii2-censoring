<?php

namespace denis909\censoring\models;

use Yii;
use denis909\censoring\helpers\CensoringHelper;
use yii\helpers\ArrayHelper;

class Censoring extends \yii\db\ActiveRecord
{

	const MODE_BOTH = 1;
	
    const MODE_LEFT = 2;
	
    const MODE_RIGHT = 3;
	
    const MODE_NONE = 4;

	public static function tableName()
	{
		return '{{%censoring}}';
	}

    public static function find()
    {
        return new CensoringQuery(get_called_class());
    }

    public function rules()
    {
        return [
            [['search_for', 'replace_with'], 'trim'],
            [['search_for', 'replace_with'], 'string', 'max' => 255],
            [['search_for'], 'unique'],
            [['mode'], 'in', 'range' => array_keys($this->modeItems)]
        ];
    }    

    public function afterDelete()
    {
   		parent::afterDelete();

   		if (Yii::$app->has('cache'))
    	{
   			Yii::$app->cache->offsetUnset(CensoringHelper::CACHE_ID);
   		}
    }

    public function beforeSave($insert)
    {
    	$this->length = mb_strlen($this->search_for);

    	return parent::beforeSave($insert);
    }

    public function afterSave($insert, $changedAttributes)
    {
    	parent::afterSave($insert, $changedAttributes);
    	
    	if (Yii::$app->has('cache'))
    	{
    		Yii::$app->cache->offsetUnset(CensoringHelper::CACHE_ID);
    	}	
    }

    public static function modeList()
    {
    	return [
    		static::MODE_BOTH => 'Слово целиком',
    		static::MODE_LEFT => 'Начало слова',
    		static::MODE_RIGHT => 'Конец слова',
    		static::MODE_NONE => 'Часть слова'
    	];
    }

    public function getModeList()
    {
        return static::modeList();
    }

   	public function getModeName()
   	{
   		return ArrayHelper::getValue($this->modeList, $this->mode);
   	}

    public function attributeLabels()
    {
    	return [
            'id' => 'Номер',
            'created' => 'Создано',
    		'search_for' => Yii::t('censoring', 'Censored word label'),
    		'replace_with' => Yii::t('censoring', 'Replacement label'),
    		'length' => 'Размер',
    		'mode' => 'Режим замены'
    	];
    }

}