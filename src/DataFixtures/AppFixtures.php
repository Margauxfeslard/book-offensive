<?php

namespace App\DataFixtures;

use App\Factory\BookFactory;
use App\Factory\BorrowFactory;
use App\Factory\CategoryFactory;
use App\Factory\PhysicalBookFactory;
use App\Factory\ReviewFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        CategoryFactory::createMany(15);

        UserFactory::createMany(40);

        BookFactory::createMany(100, function () {
            return [
                'categories' => CategoryFactory::randomRange(1, 4),
            ];
        });

        PhysicalBookFactory::createMany(150);

        ReviewFactory::createMany(30);

        BorrowFactory::createMany(50);

        $manager->flush();
    }
}
