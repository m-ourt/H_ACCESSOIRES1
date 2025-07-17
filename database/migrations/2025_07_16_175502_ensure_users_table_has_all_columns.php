<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('users', function (Blueprint $table) {
        $table->string('phone', 20)->nullable()->after('email');
        $table->string('adress')->nullable()->after('phone');
        $table->string('ville', 100)->nullable()->after('adress');
        $table->string('code_postal', 10)->nullable()->after('ville');
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['phone', 'adress', 'ville', 'code_postal']);
    });
}
};
