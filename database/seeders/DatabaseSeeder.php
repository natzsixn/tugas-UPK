<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\MailType;
use App\Models\disposisi;
use App\Models\Mails;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'username' => 'Natanael',
            'password' => bcrypt('admin'),
            'fullname' => 'Natanael Ben Iriyanto',
            'level' => 'Admin'
        ]);
        User::create([
            'username' => 'chika',
            'password' => bcrypt('user1'),
            'fullname' => 'chika',
            'level' => 'user'
        ]);
        User::create([
            'username' => 'layla',
            'password' => bcrypt('user2'),
            'fullname' => 'layla b',
            'level' => 'user'
        ]);

        // mail type
        MailType::create([
            'type' => 'Surat pribadi'
        ]);
        MailType::create([
            'type' => 'Surat dinas'
        ]);
        MailType::create([
            'type' => 'Surat niaga'
        ]);
        MailType::create([
            'type' => 'Surat sosial'
        ]);
        MailType::create([
            'type' => 'Surat edaran'
        ]);
        MailType::create([
            'type' => 'Surat keputusan'
        ]);
        MailType::create([
            'type' => 'Surat pengumuman'
        ]);
        MailType::create([
            'type' => 'Surat perjanjian'
        ]);
    }
}
