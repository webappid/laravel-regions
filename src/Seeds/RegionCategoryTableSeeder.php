<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use WebAppId\Region\Repositories\RegionCategoryRepository;

class RegionCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param RegionCategoryRepository $regionCategoryRepository
     * @return void
     */
    public function run(RegionCategoryRepository $regionCategoryRepository)
    {
        //
        $file = __DIR__ . '/../migrations/csv/region_categories.csv';
        $header = array('name');

        $delimiter = ',';

        if ((file_exists($file) || is_readable($file)) && ($handle = fopen($file, 'r')) !== false) {
            DB::beginTransaction();
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                $data = array_combine($header, $row);
                $region = $this->container->call([$regionCategoryRepository, 'findByName'], ['name' => $data['name']]);
                if ($region == null) {
                    $this->container->call([$regionCategoryRepository, 'store'], ['name' => $data['name']]);
                }
            }
            DB::commit();
            fclose($handle);
        }
    }
}
