<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;
use Carbon\Carbon;

class EventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::create([
            'name' => 'Laravel Meetup',
            'description' => ' A meetup for Laravel developers',
            'date' => Carbon::now() + 25,
            'max_attendees' => 100,
            'location' => 'Nairobi',
            'price' => 100,
        ]);
    }
}
