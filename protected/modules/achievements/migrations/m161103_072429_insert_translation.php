<?php

use yii\db\Migration;

class m161103_072429_insert_translation extends Migration
{
    public function up()
    {
        $this->insert('achievement_translations', [
            'id' => 1,
            'achievement_id' => 1,
            'title' => 'Enviadas 6 evidencias',
            'description' => 'Tienes que presentar 6 evidencias para desbloquear esta realización',
            'language_id' => 2,
            'created_at'  => date('Y-m-d H:i:s')
        ]);

        $this->insert('achievement_translations', [
            'id' => 2,
            'achievement_id' => 2,
            'title' => 'Enviadas 12 evidencias',
            'description' => 'Tienes que presentar 12 evidencias para desbloquear esta realización',
            'language_id' => 2,
            'created_at'  => date('Y-m-d H:i:s')
        ]);

        $this->insert('achievement_translations', [
            'id' => 3,
            'achievement_id' => 3,
            'title' => 'Enviadas 24 evidencias',
            'description' => 'Tienes que presentar 24 evidencias para desbloquear esta realización',
            'language_id' => 2,
            'created_at'  => date('Y-m-d H:i:s')
        ]);

        $this->insert('achievement_translations', [
            'id' => 4,
            'achievement_id' => 4,
            'title' => 'Enviadas 48 evidencias',
            'description' => 'Tienes que presentar 48 evidencias para desbloquear esta realización',
            'language_id' => 2,
            'created_at'  => date('Y-m-d H:i:s')
        ]);

        $this->insert('achievement_translations', [
            'id' => 5,
            'achievement_id' => 5,
            'title' => 'Votar en una evokation',
            'description' => 'Tienes que votar en una Evokation para desbloquear esta realización',
            'language_id' => 2,
            'created_at'  => date('Y-m-d H:i:s')
        ]);

        $this->insert('achievement_translations', [
            'id' => 6,
            'achievement_id' => 6,
            'title' => 'Hacer una evaluación de calidad',
            'description' => 'Tienes que hacer una evaluación de calidad para desbloquear esta realización',
            'language_id' => 2,
            'created_at'  => date('Y-m-d H:i:s')
        ]);
    }

    public function down()
    {
        echo "m161103_072429_insert_translation cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
