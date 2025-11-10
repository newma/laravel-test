<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DataDumpSeeder extends Seeder
{
    public function run(): void
    {
        $sqlPath = database_path('seeders/rawsql/datadump.sql');

        // Safety: disable FKs while bulk loading
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::unprepared(File::get($sqlPath)); // inserts properties, certificates, notes from your dump
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}

