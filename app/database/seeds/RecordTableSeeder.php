<?php

use Faker\Factory as Faker;

class RecordTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create('en_CA');

        $priority = ['1', '2', '3', '4', '5'];

        $patients = Patient::all();
        $facilities = Facility::all();
        $users = User::where('type', 'doctor');

        foreach(range(1, 300) as $index)
        {
            $facility = Facility::orderByRaw("RAND()")->first();


            if($facility->type === 'clinic'){
                Record::create([
                    'patient_id' => Patient::orderByRaw("RAND()")->first()->id,
                    'facility_id' => $facility->id,
                    'user_id' => User::where('type', 'doctor')->orderByRaw("RAND()")->first()->id,

                    'priority' => '6',
                    'reg_datetime' => $faker->datetime,
                    'admit_datetime' => $faker->datetime,
                    'stated_compl' => $faker->text,
                    'chief_compl_code' => $faker->word,
                    'chief_compl' => $faker->sentence,
                    'arrival_mode' => $faker->word,
                    'subjective' => $faker->text,
                    'objective' => $faker->text,
                    'assessment' => $faker->text,
                    'prescription' => $faker->text,
                    'remarks' => $faker->text,
                    'plan' => $faker->text
                ]);
            }else{
                Record::create([
                    'patient_id' => Patient::orderByRaw("RAND()")->first()->id,
                    'facility_id' => $facility->id,
                    'user_id' => User::orderByRaw("RAND()")->first()->id,

                    'priority' => $faker->randomElement($priority),
                    'reg_datetime' => $faker->datetime,
                    'admit_datetime' => $faker->datetime,
                    'stated_compl' => $faker->text,
                    'chief_compl_code' => $faker->word,
                    'chief_compl' => $faker->sentence,
                    'arrival_mode' => $faker->word,
                    'subjective' => $faker->text,
                    'objective' => $faker->text,
                    'assessment' => $faker->text,
                    'prescription' => $faker->text,
                    'remarks' => $faker->text,
                    'plan' => $faker->text
                ]);

            }

        }
    }

}
