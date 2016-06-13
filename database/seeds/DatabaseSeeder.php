<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Hash;

use App\Models\Divisi;
use App\Models\Jabatan;
use App\Models\User;

use App\Models\Surat\Sifat;
use App\Models\Surat\Status;
use App\Models\Surat\Masuk;


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

        $this->call(MsSifatTableSeeder::class);
        $this->call(MsStatusTableSeeder::class);
        $this->call(MsMasukTableSeeder::class);

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

		$id_jabatan = Jabatan::where('name', '=', 'Kepala Kantor')->firstOrFail();
        User::create(array('name'=>'Administrator', 'email'=>'admin@ngantor.com', 'password'=>Hash::make('admin02'), 'id_jabatan'=>$id_jabatan->id));

		$id_divisi = Divisi::where('name', '=', 'Umum')->firstOrFail();
		$id_jabatan = Jabatan::where('name', '=', 'Staff')->firstOrFail();
        User::create(array('name'=>'Wirasto Karim', 'email'=>'wirasto@ngantor.com', 'password'=> Hash::make('wirasto'), 'id_divisi'=>$id_divisi->id, 'id_jabatan'=>$id_jabatan->id));
        User::create(array('name'=>'Lisa Kawaii', 'email'=>'lisa@ngantor.com', 'password'=> Hash::make('lisa02'), 'id_divisi'=>$id_divisi->id, 'id_jabatan'=>$id_jabatan->id));
    }
}


class MsSifatTableSeeder extends Seeder {

    public function run()
    {
        DB::table('ms_sifat')->delete();

        Sifat::create(array('name'=>'Umum'));
        Sifat::create(array('name'=>'Rahasia'));
        Sifat::create(array('name'=>'Edaran'));
    }
}


class MsStatusTableSeeder extends Seeder {

    public function run()
    {
        DB::table('ms_status')->delete();

        Status::create(array('name'=>'Baru Masuk', 'type'=> 1));
        Status::create(array('name'=>'Sedang Diproses', 'type'=> 0));
        Status::create(array('name'=>'Diarsipkan', 'type'=> 2));
        Status::create(array('name'=>'Diabaikan', 'type'=> 2));
    }
}

class MsMasukTableSeeder extends Seeder {

    public function run()
    {
        DB::table('ms_masuk')->delete();

		$id_sifat = Sifat::where('name', '=', 'Umum')->firstOrFail();
		$id_status = Status::where('type', '=', '1')->firstOrFail();
		$id_user = User::where('email', '=', 'admin@ngantor.com')->firstOrFail();

        Masuk::create(array(
			'nomor'=> 'S001',
			'id_sifat'=> $id_sifat->id,
			'perihal'=> 'Mencoba fitur surat masuk',
			'asal'=> 'Olongia IT Solution',
			'id_status'=> $id_status->id,
			'id_user'=> $id_user->id,
		));

		Masuk::create(array(
			'nomor'=> 'S002',
			'id_sifat'=> $id_sifat->id,
			'perihal'=> 'Tawaran Kerja Sama',
			'asal'=> 'Microsoft Antahberantah',
			'id_status'=> $id_status->id,
			'id_user'=> $id_user->id,
		));
    }
}
