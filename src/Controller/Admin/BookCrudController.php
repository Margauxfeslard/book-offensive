<?php

namespace App\Controller\Admin;

use App\Entity\Book;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BookCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Book::class;
    }
<<<<<<< HEAD
=======

>>>>>>> 9ed74ce (fixtures written and small crudController config)
}
