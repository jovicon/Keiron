<?php

use Illuminate\Database\Seeder;

class user_type_data extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Se crea perfil de admin si no existe y se crea un usuario
        if (DB::table('user_types')->where("name", "admin")->get()->count() == 0) {

            // insertando datos en tabla de perfil
            $user_type_admin_id = \DB::table('user_types')->insertGetId(array(
                'name' => "admin",
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ));

            // se crea usuario de administrador
            $user_admin_id = \DB::table('users')->insertGetId(array(
                'name' => "Master Admin",
                'email' => "master_admin@gmail.com",
                'password' => bcrypt("*1234qwer*"),
                'email_verified_at' => null,
                'user_type_id' => $user_type_admin_id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ));
        }

        // Se crea perfil de user si no existe y se crea un usuario
        if (DB::table('user_types')->where("name", "user")->get()->count() == 0) {

            // insertando datos en tabla de perfil
            $user_type_id = \DB::table('user_types')->insertGetId(array(
                'name' => "user",
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ));

            // se crea usuario de administrador
            $user_id = \DB::table('users')->insertGetId(array(
                'name' => "Basic User",
                'email' => "basic_user@gmail.com",
                'password' => bcrypt("*1234qwer*"),
                'email_verified_at' => null,
                'user_type_id' => $user_type_id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ));

        }
    }
}
