<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Hash;

use App\Divisi;
use App\Jabatan;
use App\User;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(DivisiTableSeeder::class);
        $this->call(JabatanTableSeeder::class);
        $this->call(UsersTableSeeder::class);

        Model::reguard();
    }
}


class DivisiTableSeeder extends Seeder {

    public function run()
    {
        DB::table('divisi')->delete();

        Divisi::create(array('name'=>'Umum'));
        Divisi::create(array('name'=>'Kepegawaian'));
        Divisi::create(array('name'=>'Keuangan'));
    }
}


class JabatanTableSeeder extends Seeder {

    public function run()
    {
        DB::table('jabatan')->delete();

        Jabatan::create(array('name'=>'Kepala Kantor'));
        Jabatan::create(array('name'=>'Kepala Bagian'));
        Jabatan::create(array('name'=>'Kepala Sub Bagian'));
        Jabatan::create(array('name'=>'Staff'));
    }
}


class UsersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create(array('name'=>'Administrator', 'email'=>'admin@ngantor.com', 'password'=> Hash::make('admin02')));
        User::create(array('name'=>'Wirasto Karim', 'email'=>'wirasto@ngantor.com', 'password'=> Hash::make('wirasto')));
        User::create(array('name'=>'Lisa Kawaii', 'email'=>'lisa@ngantor.com', 'password'=> Hash::make('lisa02')));
    }
}
