<?php

namespace denis909\censoring\migrations;

/**
 * Class m180525_084550_censoring_mode
 */
class m180525_084550_censoring_mode extends \yii\db\Migration
{

	public $tableName = '{{%censoring}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
    	$this->addColumn($this->tableName, 'mode', $this->integer(3)->unsigned()->notNull()->defaultValue(1));
    
    	$this->createIndex('censoring_mode_idx', $this->tableName, ['mode'], false);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    	$this->dropIndex('censoring_mode_idx', $this->tableName);

    	$this->dropColumn($this->tableName, 'mode');
    }

}