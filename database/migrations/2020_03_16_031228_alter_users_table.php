<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $driver = Schema::connection($this->getConnection())->getConnection()->getDriverName();

            if ($driver === 'sqlite') {
                $table->string('first_name', 30)->default('');
                $table->string('last_name', 30)->default('');;
            } else {
                $table->string('first_name', 30)->after('id');
                $table->string('last_name', 30)->after('first_name');
            }
        });


        // splitting into another migration as dropping and adding cols in single migration is not supported by sqlite
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
