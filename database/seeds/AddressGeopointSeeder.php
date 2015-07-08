<?php

use Illuminate\Database\Seeder;

class AddressGeopointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("
            UPDATE addresses
            SET geopoint = GEOMFROMTEXT( CONCAT('POINT(',lat,' ',lng,')') )
            WHERE geopoint IS NULL OR TRIM(geopoint) = '';
        ");
    }
}
