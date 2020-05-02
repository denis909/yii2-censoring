<?php

namespace denis909\censoring\migrations;

/**
 * Class m180525_084543_censoring_length
 */
class m180525_084543_censoring_length extends \yii\db\Migration
{

    public $tableName = '{{%censoring}}';

     /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn($this->tableName, 'length', $this->integer()->unsigned());
    
        $this->createIndex('censoring_length_idx', $this->tableName, ['length'], false);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('censoring_length_idx', $this->tableName);

        $this->dropColumn($this->tableName, 'length');
    }

}