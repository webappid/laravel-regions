<?php
namespace WebAppId\Region\Seeds;

use Illuminate\Database\Seeder;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com>
 * Date: 2019-05-28
 * Time: 02:10
 * Class DatabaseSeeder
 * @package WebAppId\Region\Seeds
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RegionCategoryTableSeeder::class);
        $this->call(RegionTableSeeder::class);
    }
}
