<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create(['key' => 'enable_registration', 'value' => '1']);
        Setting::create(['key' => 'enable_redeem', 'value' => '1']);
        Setting::create(['key' => 'referral_active', 'value' => '1']);
        Setting::create(['key' => 'referral_reward', 'value' => '1']);
        Setting::create(['key' => 'referral_playtime', 'value' => '1']);
        Setting::create(['key' => 'youtube', 'value' => '1']);
        Setting::create(['key' => 'tiktok', 'value' => '1']);
        Setting::create(['key' => 'instagram', 'value' => '1']);
        Setting::create(['key' => 'facebook', 'value' => '1']);
        Setting::create(['key' => 'discord', 'value' => '1']);
        Setting::create(['key' => 'wiki', 'value' => '1']);
        Setting::create(['key' => 'community', 'value' => 'https://google.com']);
    }
}
