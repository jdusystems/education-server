<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Region::create(
            [
                "name" => "Andijon",
            ]
        );
        Region::create(
            [
                "name" => "Qashqadaryo",
            ]
        );
        Region::create(
            [
                "name" => "Samarqand",
            ]
        );
        Region::create(
            [
                "name" => "Toshkent viloyati",
            ]
        );
        Region::create(
            [
                "name" => "Farg‘ona ",
            ]
        );
        Region::create(
            [
                "name" => "Buxoro",
            ]
        );
        Region::create(
            [
                "name" => "Navoiy",
            ]
        );
        Region::create(
            [
                "name" => "Namangan",
            ]
        );
        Region::create(
            [
                "name" => "Surxondaryo",
            ]
        );
        Region::create(
            [
                "name" => "Xorazm",
            ]
        );
        Region::create(
            [
                "name" => "Jizzax",
            ]
        );
        Region::create(
            [
                "name" => "Sirdaryo",
            ]
        );
        Region::create(
            [
                "name" => "Toshkent shahri",
            ]
        );
    }
}
