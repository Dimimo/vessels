<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

/**
 * Class ProvincesTableSeeder
 */
class ProvincesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('provinces')->insert(['id' => '1', 'name' => 'Abra', 'slug' => 'abra']);
        DB::table('provinces')->insert(['id' => '2', 'name' => 'Agusan del Norte', 'slug' => 'agusan-del-norte']);
        DB::table('provinces')->insert(['id' => '3', 'name' => 'Agusan del Sur', 'slug' => 'agusan-del-sur']);
        DB::table('provinces')->insert(['id' => '4', 'name' => 'Aklan', 'slug' => 'aklan']);
        DB::table('provinces')->insert(['id' => '5', 'name' => 'Albay', 'slug' => 'albay']);
        DB::table('provinces')->insert(['id' => '6', 'name' => 'Antique', 'slug' => 'antique']);
        DB::table('provinces')->insert(['id' => '7', 'name' => 'Apayao', 'slug' => 'apayao']);
        DB::table('provinces')->insert(['id' => '8', 'name' => 'Aurora', 'slug' => 'aurora']);
        DB::table('provinces')->insert(['id' => '9', 'name' => 'Basilan', 'slug' => 'basilan']);
        DB::table('provinces')->insert(['id' => '10', 'name' => 'Bataan', 'slug' => 'bataan']);
        DB::table('provinces')->insert(['id' => '11', 'name' => 'Batanes', 'slug' => 'batanes']);
        DB::table('provinces')->insert(['id' => '12', 'name' => 'Batangas', 'slug' => 'batangas']);
        DB::table('provinces')->insert(['id' => '13', 'name' => 'Benguet', 'slug' => 'benguet']);
        DB::table('provinces')->insert(['id' => '14', 'name' => 'Biliran', 'slug' => 'biliran']);
        DB::table('provinces')->insert(['id' => '15', 'name' => 'Bohol', 'slug' => 'bohol']);
        DB::table('provinces')->insert(['id' => '16', 'name' => 'Bukidnon', 'slug' => 'bukidnon']);
        DB::table('provinces')->insert(['id' => '17', 'name' => 'Bulacan', 'slug' => 'bulacan']);
        DB::table('provinces')->insert(['id' => '18', 'name' => 'Cagayan', 'slug' => 'cagayan']);
        DB::table('provinces')->insert(['id' => '19', 'name' => 'Camarines Norte', 'slug' => 'camarines-norte']);
        DB::table('provinces')->insert(['id' => '20', 'name' => 'Camarines Sur', 'slug' => 'camarines-sur']);
        DB::table('provinces')->insert(['id' => '21', 'name' => 'Camiguin', 'slug' => 'camiguin']);
        DB::table('provinces')->insert(['id' => '22', 'name' => 'Capiz', 'slug' => 'capiz']);
        DB::table('provinces')->insert(['id' => '23', 'name' => 'Catanduanes', 'slug' => 'catanduanes']);
        DB::table('provinces')->insert(['id' => '24', 'name' => 'Cavite', 'slug' => 'cavite']);
        DB::table('provinces')->insert(['id' => '25', 'name' => 'Cebu', 'slug' => 'cebu']);
        DB::table('provinces')->insert(['id' => '26', 'name' => 'Compostela Valley', 'slug' => 'compostela-valley']);
        DB::table('provinces')->insert(['id' => '27', 'name' => 'Cotabato', 'slug' => 'cotabato']);
        DB::table('provinces')->insert(['id' => '28', 'name' => 'Davao del Norte', 'slug' => 'davao-del-norte']);
        DB::table('provinces')->insert(['id' => '29', 'name' => 'Davao del Sur', 'slug' => 'davao-del-sur']);
        DB::table('provinces')->insert(['id' => '30', 'name' => 'Davao Oriental', 'slug' => 'davao-oriental']);
        DB::table('provinces')->insert(['id' => '31', 'name' => 'Eastern Samar', 'slug' => 'eastern-samar']);
        DB::table('provinces')->insert(['id' => '32', 'name' => 'Guimaras', 'slug' => 'guimaras']);
        DB::table('provinces')->insert(['id' => '33', 'name' => 'Ifugao', 'slug' => 'ifugao']);
        DB::table('provinces')->insert(['id' => '34', 'name' => 'Ilocos Norte', 'slug' => 'ilocos-norte']);
        DB::table('provinces')->insert(['id' => '35', 'name' => 'Ilocos Sur', 'slug' => 'ilocos-sur']);
        DB::table('provinces')->insert(['id' => '36', 'name' => 'Iloilo', 'slug' => 'iloilo']);
        DB::table('provinces')->insert(['id' => '37', 'name' => 'Isabela', 'slug' => 'isabela']);
        DB::table('provinces')->insert(['id' => '38', 'name' => 'Kalinga', 'slug' => 'kalinga']);
        DB::table('provinces')->insert(['id' => '39', 'name' => 'La Union', 'slug' => 'la-union']);
        DB::table('provinces')->insert(['id' => '40', 'name' => 'Laguna', 'slug' => 'laguna']);
        DB::table('provinces')->insert(['id' => '41', 'name' => 'Lanao del Norte', 'slug' => 'lanao-del-norte']);
        DB::table('provinces')->insert(['id' => '42', 'name' => 'Lanao del Sur', 'slug' => 'lanao-del-sur']);
        DB::table('provinces')->insert(['id' => '43', 'name' => 'Leyte', 'slug' => 'leyte']);
        DB::table('provinces')->insert(['id' => '44', 'name' => 'Maguindanao', 'slug' => 'maguindanao']);
        DB::table('provinces')->insert(['id' => '45', 'name' => 'Marinduque', 'slug' => 'marinduque']);
        DB::table('provinces')->insert(['id' => '46', 'name' => 'Masbate', 'slug' => 'masbate']);
        DB::table('provinces')->insert(['id' => '47', 'name' => 'Metro Manila', 'slug' => 'metro-manila']);
        DB::table('provinces')->insert(['id' => '48', 'name' => 'Misamis Occidental', 'slug' => 'misamis-occidental']);
        DB::table('provinces')->insert(['id' => '49', 'name' => 'Misamis Oriental', 'slug' => 'misamis-oriental']);
        DB::table('provinces')->insert(['id' => '50', 'name' => 'Mountain Province', 'slug' => 'mountain-province']);
        DB::table('provinces')->insert(['id' => '51', 'name' => 'Negros Occidental', 'slug' => 'negros-occidental']);
        DB::table('provinces')->insert(['id' => '52', 'name' => 'Negros Oriental', 'slug' => 'negros-oriental']);
        DB::table('provinces')->insert(['id' => '53', 'name' => 'Northern Samar', 'slug' => 'northern-samar']);
        DB::table('provinces')->insert(['id' => '54', 'name' => 'Nueva Ecija', 'slug' => 'nueva-ecija']);
        DB::table('provinces')->insert(['id' => '55', 'name' => 'Nueva Vizcaya', 'slug' => 'nueva-vizcaya']);
        DB::table('provinces')->insert(['id' => '56', 'name' => 'Occidental Mindoro', 'slug' => 'occidental-mindoro']);
        DB::table('provinces')->insert(['id' => '57', 'name' => 'Oriental Mindoro', 'slug' => 'oriental-mindoro']);
        DB::table('provinces')->insert(['id' => '58', 'name' => 'Palawan', 'slug' => 'palawan']);
        DB::table('provinces')->insert(['id' => '59', 'name' => 'Pampanga', 'slug' => 'pampanga']);
        DB::table('provinces')->insert(['id' => '60', 'name' => 'Pangasinan', 'slug' => 'pangasinan']);
        DB::table('provinces')->insert(['id' => '61', 'name' => 'Quezon', 'slug' => 'quezon']);
        DB::table('provinces')->insert(['id' => '62', 'name' => 'Quirino', 'slug' => 'quirino']);
        DB::table('provinces')->insert(['id' => '63', 'name' => 'Rizal', 'slug' => 'rizal']);
        DB::table('provinces')->insert(['id' => '64', 'name' => 'Romblon', 'slug' => 'romblon']);
        DB::table('provinces')->insert(['id' => '65', 'name' => 'Samar', 'slug' => 'samar']);
        DB::table('provinces')->insert(['id' => '66', 'name' => 'Sarangani', 'slug' => 'sarangani']);
        DB::table('provinces')->insert(['id' => '67', 'name' => 'Siquijor', 'slug' => 'siquijor']);
        DB::table('provinces')->insert(['id' => '68', 'name' => 'Sorsogon', 'slug' => 'sorsogon']);
        DB::table('provinces')->insert(['id' => '69', 'name' => 'South Cotabato', 'slug' => 'south-cotabato']);
        DB::table('provinces')->insert(['id' => '70', 'name' => 'Southern Leyte', 'slug' => 'southern-leyte']);
        DB::table('provinces')->insert(['id' => '71', 'name' => 'Sultan Kudarat', 'slug' => 'sultan-kudarat']);
        DB::table('provinces')->insert(['id' => '72', 'name' => 'Sulu', 'slug' => 'sulu']);
        DB::table('provinces')->insert(['id' => '73', 'name' => 'Surigao del Norte', 'slug' => 'surigao-del-norte']);
        DB::table('provinces')->insert(['id' => '74', 'name' => 'Surigao del Sur', 'slug' => 'surigao-del-sur']);
        DB::table('provinces')->insert(['id' => '75', 'name' => 'Tarlac', 'slug' => 'tarlac']);
        DB::table('provinces')->insert(['id' => '76', 'name' => 'Tawi-Tawi', 'slug' => 'tawi-tawi']);
        DB::table('provinces')->insert(['id' => '77', 'name' => 'Zambales', 'slug' => 'zambales']);
        DB::table('provinces')->insert(['id' => '78', 'name' => 'Zamboanga del Norte', 'slug' => 'zamboanga-del-norte']);
        DB::table('provinces')->insert(['id' => '79', 'name' => 'Zamboanga del Sur', 'slug' => 'zamboanga-del-sur']);
        DB::table('provinces')->insert(['id' => '80', 'name' => 'Zamboanga Sibugay', 'slug' => 'zamboanga-sibugay']);
        DB::table('provinces')->insert(['id' => '81', 'name' => 'Davao Occidental', 'slug' => 'davao-occidental']);
        DB::table('provinces')->insert(['id' => '82', 'name' => 'North Totabato', 'slug' => 'north-cotabato']);

        Model::reguard();
    }
}