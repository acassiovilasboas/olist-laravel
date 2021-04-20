<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class InsertUserAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $email = env('ADMIN_EMAIL', 'admin@admin');
        $pass = bcrypt(env('ADMIN_PASSWORD', 'admin'));

        DB::table('users')->insert([
            'name' => 'Administrador',
            'email' => $email,
            'password' => $pass
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $email = env('ADMIN_EMAIL');
        DB::delete('DELETE FROM users WHERE email = ?', [$email]);
    }
}
