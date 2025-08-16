<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class DbCreate extends Command
{
    protected $signature = 'db:create {name?}';
    protected $description = 'Create the configured MySQL database if it does not exist';

    public function handle()
    {
        $name = $this->argument('name') ?? Config::get('database.connections.mysql.database');
        $charset = Config::get('database.connections.mysql.charset', 'utf8mb4');
        $collation = Config::get('database.connections.mysql.collation', 'utf8mb4_unicode_ci');

        if (!$name) {
            $this->error('Nama database tidak ditemukan di .env');
            return self::FAILURE;
        }

        // Sementara kosongkan nama DB agar bisa connect ke server MySQL
        Config::set('database.connections.mysql.database', null);
        DB::purge('mysql');

        try {
            DB::statement("CREATE DATABASE IF NOT EXISTS `$name` CHARACTER SET $charset COLLATE $collation");
            $this->info("Database '$name' dibuat (atau sudah ada).");
        } catch (\Throwable $e) {
            $this->error($e->getMessage());
            return self::FAILURE;
        } finally {
            // Kembalikan nama DB agar koneksi normal lagi
            Config::set('database.connections.mysql.database', $name);
            DB::purge('mysql');
        }

        return self::SUCCESS;
    }
}
