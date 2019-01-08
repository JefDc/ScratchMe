<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Image;
use App\Entity\Localisation;
use App\Entity\Product;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        $nameCategory = [
            'Deep House',
            'House',
            'Tech House',
            'Techno',
            'Hard Techno'
        ];

        for ($i = 0; $i < 50; $i++) {
            $image = new Image();
            $image->setUrl($faker->imageUrl('300'));

            $manager->persist($image);
            $this->addReference('image'.$i, $image);
        }

        for ($i = 0; $i < 5; $i++) {
            $category = new Category();
            $category->setName($nameCategory[array_rand($nameCategory)]);

            $manager->persist($category);
            $this->addReference('category'.$i, $category);
        }

        for ($i = 0; $i < 51; $i++) {
            $location = new Localisation();
            $location->setAddress($faker->address);
            $location->setLatitude($faker->latitude);
            $location->setLongitude($faker->longitude);

            $manager->persist($location);
            $this->addReference('location'.$i, $location);
        }

        for ($i = 0; $i < 1; $i++) {
            $user = new User();
            $user->setLogin('JefDc');
            $user->setPassword('claude05');
            $user->setEmail('jefdc05@gmail.com');
            $user->setPhone('0685777092');
            $user->setRoles(["ROLE_ADMIN"]);
            $user->setImageId($this->getReference('image'.rand(0, 49)));
            $user->setLocalisationId($this->getReference('location50'));

            $manager->persist($user);
            $this->addReference('JefDc', $user);
        }

        for ($i = 0; $i < 50; $i++) {
            $product = new Product();
            $product->setTitle($faker->title);
            $product->setDescription($faker->text);
            $product->setPrice($faker->randomFloat());
            $product->setUser($this->getReference('JefDc'));
            $product->setCategory($this->getReference('category'.rand(0, 4)));
            $product->setLocation($this->getReference('location'.rand(0, 49)));
            $product->addImage($this->getReference('image'.rand(0, 49)));

            $manager->persist($product);
        }

        $manager->flush();
    }
}
