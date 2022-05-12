<?php

namespace App\DataFixtures;

use App\Factory\BookFactory;
use App\Factory\BorrowFactory;
use App\Factory\PhysicalBookFactory;
use App\Factory\ReviewFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        UserFactory::createMany(40);

        BookFactory::createMany(100);

        PhysicalBookFactory::createMany(150);

        ReviewFactory::createMany(30);

        BorrowFactory::createMany(50);
        
        
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
