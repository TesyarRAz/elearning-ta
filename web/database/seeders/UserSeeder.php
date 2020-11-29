<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->guru()->hasGuru()->create([
        	'email' => 'guru@localhost',
            'username' => 'guru'
        ]);

        User::factory()->siswa()->hasSiswa()->create([
            'email' => 'siswa@localhost',
            'username' => 'siswa'
        ]);

        User::factory()->admin()->create([
            'email' => 'admin@localhost',
            'username' => 'admin'
        ]);
    }
}
