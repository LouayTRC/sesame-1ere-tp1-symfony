<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Entity\Category;

class CategoryValidationTest extends KernelTestCase
{
    public function testDuplicateCategoryIsInvalid(): void
    {
        self::bootKernel();
        $container = static::getContainer();
        $em = $container->get('doctrine')->getManager();
        $validator = $container->get('validator');

        // create and persist first category
        $c1 = new Category();
        $c1->setLibelle('UniqueTest');
        $em->persist($c1);
        $em->flush();

        // create second category with same libelle
        $c2 = new Category();
        $c2->setLibelle('UniqueTest');

        $errors = $validator->validate($c2);

        $this->assertGreaterThan(0, count($errors), 'La validation devrait détecter une violation d\'unicité.');

        // cleanup
        $em->remove($c1);
        $em->flush();
    }
}
