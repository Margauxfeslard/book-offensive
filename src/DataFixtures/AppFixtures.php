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
        // $product = new Product();
        // $manager->persist($product);

        UserFactory::createMany(40);
        BookFactory::createMany(60);

        

        ReviewFactory::createMany(20, [
            'book' => BookFactory::random(),
            'author' => UserFactory::random() 
        ]);

        PhysicalBookFactory::createMany(100, [
            'book' => BookFactory::random(),
            'owner' => UserFactory::random()
        ]);
        
        BorrowFactory::createMany(15, [
            'physicalBook' => PhysicalBookFactory::random(),
            'borrower' => UserFactory::random()
        ]);
        

        $manager->flush();
    }
}
