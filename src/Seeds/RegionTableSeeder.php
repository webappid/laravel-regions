<?php

namespace WebAppId\Region\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use WebAppId\Region\Repositories\RegionRepository;
use WebAppId\Region\Services\Params\RegionParam;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com>
 * Date: 2019-05-28
 * Time: 02:10
 * Class RegionTableSeeder
 * @package WebAppId\Region\Seeds
 */
class RegionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param RegionRepository $regionRepository
     * @return void
     */
    public function run(RegionRepository $regionRepository)
    {
        if(!strpos($_SERVER['SCRIPT_NAME'], 'phpunit')){
            $file = __DIR__ . '/../Resources/csv/regions.csv';
        }else{
            $file = __DIR__ . '/../Resources/csv/dummy/regions.csv';
        }

        $header = array('id', 'category_id', 'parent_id', 'name');

        $delimiter = ',';

        if ((file_exists($file) || is_readable($file)) && ($handle = fopen($file, 'r')) !== false) {
            DB::beginTransaction();
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                $data = array_combine($header, $row);
                $region = $this->container->call([$regionRepository, 'getByNameAndParentId'], ['name' => $data['name'], 'parentId' => (int)$data['parent_id']]);
                if ($region == null) {
                    $regionParam = new RegionParam();
                    $regionParam->setId((int)$data['id']);
                    $regionParam->setParentId((int)$data['parent_id']);
                    $regionParam->setCategoryId((int)$data['category_id']);
                    $regionParam->setName(ucwords(strtolower($data['name'])));
                    $this->container->call([$regionRepository, 'store'], ['regionParam' => $regionParam]);
                }
            }
            DB::commit();
            fclose($handle);
        }
    }
}
