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
            // Check if phone column doesn't exist (it's called 'telephone')
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone', 20)->nullable()->after('email');
            }
            
            // Check if adress column doesn't exist
            if (!Schema::hasColumn('users', 'adress')) {
                $table->string('adress')->nullable()->after('phone');
            }
            
            // Check if ville column doesn't exist
            if (!Schema::hasColumn('users', 'ville')) {
                $table->string('ville', 100)->nullable()->after('adress');
            }
            
            // Check if code_postal column doesn't exist (it's called 'code_postale')
            if (!Schema::hasColumn('users', 'code_postal')) {
                $table->string('code_postal', 10)->nullable()->after('ville');
            }
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
