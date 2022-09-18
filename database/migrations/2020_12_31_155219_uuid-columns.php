<?php

use Illuminate\Database\Migrations\Migration;
use \Illuminate\Support\Facades\Schema;
use \Illuminate\Support\Facades\DB;

class UuidColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $tables = DB::select('SHOW TABLES');

        foreach($tables as $table)
        {
            $tableName = array_values((array) $table)[0];

            if (stripos($tableName, 'oauth') === false && stripos($tableName, 'tele') === false) {

                if (Schema::hasColumn($tableName, 'id') && !Schema::hasColumn($tableName, 'uuid')) {
                    Schema::table($tableName, function($table) {
                        $table->uuid('uuid')->nullable()->unique('uuid_unique')->after('id');
                    });

                    DB::statement("UPDATE " . $tableName . " SET uuid=id");
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tables = DB::select('SHOW TABLES');

        foreach($tables as $table)
        {
            $tableName = array_values((array) $table)[0];

            if (stripos($tableName, 'tele') === false && stripos($tableName, 'oauth') === false) {

                if (Schema::hasColumn($tableName, 'uuid')) {
                    Schema::table($tableName, function($table) {
                        $table->dropUnique('uuid_unique');
                        $table->dropColumn('uuid');
                    });
                }

            }
        }
    }
}
