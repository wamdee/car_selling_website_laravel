<?php

namespace Database\Seeders;

use App\Models\CarImage;
use App\Models\Maker;
use App\Models\User;
use App\Models\CarType;
use App\Models\FuelType;
use App\Models\State;
use App\Models\City;
use App\Models\Model;
use App\Models\Car;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use illuminate\Database\Eloquent\Factories\Sequence;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       //Create car types with the following data using factories
       CarType::factory()
          ->sequence(
            ['name'=> 'Sedan'],
            ['name'=> 'Hatchback'],
            ['name'=> 'SUV'],
            ['name'=> 'Pickup Truck'],
            ['name'=> 'Minivan'],
            ['name'=> 'Jeep'],
            ['name'=> 'Coupe'],
            ['name'=> 'Crossover'],
            ['name'=> 'Sport Car'],
            )
          ->count(9)
          ->create();
       FuelType::factory()
            ->sequence(
                ['name'=> 'Gasoline'],
                ['name'=> 'Diesel'],
                ['name'=> 'Electric'],
                ['name'=> 'Hybrid'],

            )
            ->count(4)
            ->create();
        $states = [
            'California'=> ['Los Angeles','San Fransisco','San Diego', 'San Jose'],
            'Texas'=> ['Houston','San Antonio','Dallas', 'Austin', 'Fort Worth'],
            'Florida'=> ['Miami','Orlando','Tampa', 'Jacksonville','St. Petersburg'],
            'New York'=> ['New York City','Bufallo','Rochester', 'Yonkers', 'Syracuse'],
            'Illinois'=> ['Chicago','Aurora','Naperville', 'Joliet','Rockford'],
            'Pennysylania'=> ['Philadelphia','Pittsburgh','Allentown', 'Erie','Reading'],
            'Ohio'=> ['Columbus','Cleveland','Cincinnati', 'Toledo','Akron'],
            'Georgia'=> ['Atlanta','Augusta','Columbus', 'Savannah','Athens'],
            'North Carolina'=> ['Charlotte','Raleigh','Greensboro', 'Durham','Winston-Salem'],
            'Michigan'=> ['Detroit','Grand Rapids','Warren', 'Sterling Heights','Ann Arbor'],
            ];
        foreach ($states as $state => $cities) {
            State::factory()
                ->state(['name'=> $state])
                ->has(
                    City::factory()
                    ->count(count($cities))
                    ->sequence(...array_map(fn($city)=> ['name'=> $city], $cities))
                )
                ->create();
            }

        $makers =[
            'Toyota'=>['Camry','Corolla','Highlander','RAV4','Prius','4Runner'],
            'Ford'=>['F-150','Escape','Explorer','Mustang','Fusion','Ranger'],
            'Honda'=>['Civic','Accord','CR-V','Pilot','Odyssey','HR-V','Rivian'],
            'Chevrolet'=>['Silverado','Equinox','Malibu','Impala','Cruze','Alexa'],
            'Nissan'=>['Altima','Sentra','Rogue','Maxima','Murano','Pathfinder'],
            'Lexus'=>['RX400','RX450','RX350','ES350','LS500','IS300','GX400'],
        ];
        foreach ($makers as $maker => $models) {
            Maker::factory()
                ->state(['name'=> $maker])
                ->has(
                    Model::factory()
                    ->count(count($models))
                    ->sequence(...array_map(fn($model)=>['name'=>$model], $models))
                )
                ->create();
        }
        
        User::factory()
            ->count(3)
            ->create();

        User::factory()
            ->count(2)
            ->has(
                Car::factory()
                ->count(50)
                ->has(
                    CarImage::factory()
                    ->count(5)
                    ->sequence(fn (Sequence $sequence)=> 
                    ['position' => $sequence->index % 5 + 1]),
                    'images'
                )
                ->hasFeatures(),
                'favouriteCars'
            )
            ->create();



    }
}
