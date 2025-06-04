<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PostCrudController extends AbstractCrudController
{

    public static function getEntityFqcn(): string
    {
        return Post::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', '📰 All posts')
            ->setEntityLabelInSingular('Post')
            ->setEntityLabelInPlural('Posts')
            ->setSearchFields(['title', 'content'])
            ->setDefaultSort(['id' => 'DESC'])
            ->setPaginatorPageSize(10)
            ->setFormOptions(['validation_groups' => ['Default', 'post']])
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title')
                ->setLabel('📰 Title')
                ->setHelp('Set the title of the post'),
            TextEditorField::new('content')
                ->setLabel('📝 Content')
                ->setHelp('Write the content of the post'),
            ImageField::new('image')
                ->setLabel('📷 Image')
                ->setUploadDir('public/images')
                ->setBasePath('images')
                ->setRequired(false)
                ->setHelp('Choose an image for the post')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if ($entityInstance instanceof Post && $entityInstance->getImage() instanceof UploadedFile) {
            $file = $entityInstance->getImage();
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move('public/images', $fileName);
            $entityInstance->setImage($fileName);
        }

        parent::persistEntity($entityManager, $entityInstance);
    }
}
