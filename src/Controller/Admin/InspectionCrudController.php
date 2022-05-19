<?php

namespace App\Controller\Admin;

use App\Entity\Inspection;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class InspectionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Inspection::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('car'),
            AssociationField::new('employee'),
            DateTimeField::new('start_date'),
            DateTimeField::new('end_date'),
            DateField::new('next_date'),
            TextField::new('result'),
            TextEditorField::new('description'),
        ];
    }

}
