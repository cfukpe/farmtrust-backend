<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonData = $this->loadJsonData('json/banks_data.json');

        foreach ($jsonData['data'] as $data) {
            Bank::firstOrCreate([
                'name' => $data['name'],
                'slug' => $data['slug'],
                'code' => $data['code'],
                'longcode' => $data['longcode'],
                'gateway' => $data['gateway'],
                'pay_with_bank' => $data['pay_with_bank'],
                'active' => $data['active'],
                'country' => $data['country'],
                'currency' => $data['currency'],
                'type' => $data['type'],
                'is_deleted' => $data['is_deleted'],
            ]);
        }
    }


    private function loadJsonData(string $filePath)
    {
        $jsonContents = file_get_contents(storage_path($filePath));
        return json_decode($jsonContents, true);
    }
}