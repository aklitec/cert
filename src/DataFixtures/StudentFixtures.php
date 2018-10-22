<?php

namespace App\DataFixtures;

use App\Entity\Student;
use App\Entity\StudyLevel;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class StudentFixtures extends Fixture
{
    public function load(ObjectManager $manager) : void
    {
        $faker = Faker\Factory::create('ar_SA');

        for ($i=1; $i<$faker->numberBetween(5   , 10); $i++){
            $study_level = new StudyLevel();
            $study_level->setName(" المستوى $i");
            $manager->persist($study_level);

            for ($j=1; $j<$faker->numberBetween(10, 100); $j++){
                $student = new Student();
                $student
                    ->setCode($faker->randomNumber(8))
                    ->setFirstName($faker->firstName)
                    ->setLastName($faker->lastName)
                    ->setCne($faker->regexify('[A-Z]{2}[1-9][0-9]{5}'))
                    ->setBirthPlace($faker->city)
                    ->setBirthDate($faker->dateTimeThisDecade())
                    ->setStudyLevel($study_level)
                    ->setStopDate($faker->dateTimeThisDecade())
                    ->setComments($faker->text(50))
                ;
                $manager->persist($student);
            }

        }

        $manager->flush();
    }
}
