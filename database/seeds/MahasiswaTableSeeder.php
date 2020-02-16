<?php

use Illuminate\Database\Seeder;
use App\Mahasiswa;

class MahasiswaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mahasiswa = [
            ['nim' => '171511019',
            'nama' => 'Muhamad Wahyu Maulana Akbar',
            'program_studi_id' => 24,
            'user_id' => 3,
            'tempat_lahir' => 'Cirebon',
            'tanggal_lahir' => '1999-6-25',
            'gender' => 'L',
            'semester' => 1,
            'alamat' => 'Durajaya Kec. Greged',
            'kota' => 'Cirebon',
            'kode_pos' => '45172',
            'nomor_hp' => '087712345678',
            'email' => 'mahasiswasatu@polban.ac.id',
            'angkatan' =>2017],

            ['nim' => '171511026',
            'nama' => 'Rifqi Oktabhiar Erawan',
            'program_studi_id' => 24,
            'user_id' => 4,
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '1998-10-28',
            'gender' => 'L',
            'semester' => 1,
            'alamat' => 'Bandung',
            'kota' => 'Bandung',
            'kode_pos' => '45175',
            'nomor_hp' => '081567890916',
            'email' => 'mahasiswadua@polban.ac.id',
            'angkatan' =>2017],
        ];
        foreach ($mahasiswa as $mahasiswaItem) {
            Mahasiswa::create($mahasiswaItem);
        }
    }
}
