<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'upload_max_size',
                'value' => json_encode(10000000),
                'tag' => 'upload',
            ],
            [
                'key' => 'upload_mimes',
                'value' => json_encode([
                    'pdf',
                ]),
                'tag' => 'upload',
            ],
            [
                'key' => 'upload_base_path',
                'value' => json_encode('/uploads/'),
                'tag' => 'upload',
            ],
        ];
        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
