<?php

use Illuminate\Database\Seeder;
use App\Konselor;

class KonselorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $konselorList = [
            ['nip' => '505505505',
            'nama' => 'Rahil Jumiyani',
            'program_studi_id' => 24,
            'user_id' => 2,
            'tempat_lahir' => 'Aceh',
            'tanggal_lahir' => '1991-1-1',
            'gender' => 'L',
            'nomor_hp' => '081234567890',
            'email' => 'exampleone@gmail.com'],
        ];
        foreach ($konselorList as $konselor) {
            Konselor::create($konselor);
        }
    }
}
