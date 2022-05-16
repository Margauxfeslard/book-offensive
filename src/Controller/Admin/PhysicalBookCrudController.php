<?php

namespace App\Controller\Admin;

use App\Entity\PhysicalBook;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PhysicalBookCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PhysicalBook::class;
    }
}
