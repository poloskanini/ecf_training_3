<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Partner;
use App\Entity\Structure;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $orangeUser1 = new User();
        $orangeUser2 = new User();
        $orangePartner1 = new Partner();
        $orangeStructure1 = new Structure();

        $admin
            ->setEmail('admin@admin.fr')
            ->setPassword('admin')
            ->setName('ADMIN')
            ->setRoles(['ROLE_ADMIN']);

       

        $orangeUser1
            ->setEmail('orangebleuedunkerque@direction.fr')
            ->setPassword('dunkerque')
            ->setName('Directeur Orange Bleue Dunkerque')
            ->setRoles(['ROLE_PARTENAIRE'])
            ->setPartner($orangePartner1)
            ;

        $orangeUser2
            ->setEmail('ruetartuffe@orangebleue.fr')
            ->setPassword('Tartuffe')
            ->setName('Gérant Structure Dunkerque tartuffe')
            ->setRoles(['ROLE_STRUCTURE'])
            ;


        //PARTNER 1
        $orangePartner1
            ->setName('L\'orange Bleue Dunkerque')
            ->setUser($orangeUser1)
            ->setPermissions([
                ['planning' => '0'],
                ['newsletter' => '0'],
                ['boissons' => '1'],
                ['sms' => '1'],
                ['concours' => '0'],
            ])
            ;
        
        //STRUCTURE 1
        $orangeStructure1
                ->setPostalAdress('3 rue tartuffe')
                ->setUser($orangeUser2)
                ->setPartner($orangePartner1)
                ;

        $manager->persist($admin);
        $manager->persist($orangeUser1);
        $manager->persist($orangeUser2);
        $manager->persist($orangePartner1);
        $manager->persist($orangeStructure1);

        $manager->flush();
    }
}
