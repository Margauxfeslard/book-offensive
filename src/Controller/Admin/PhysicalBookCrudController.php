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

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
