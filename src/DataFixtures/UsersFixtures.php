<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use Faker;

class UsersFixtures extends Fixture
{
    //private $counter = 1;
    public function __construct(
        private UserPasswordHasherInterface $passwordEncoder,
        private SluggerInterface $slugger
    ){}

    public function load(ObjectManager $manager): void
    {
        $admin = new Users();
        $admin->setEmail('admin@ecoit.fr');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword(
            $this->passwordEncoder->hashPassword($admin, 'admin')
        );
        $admin->setLastname('Gourdon');
        $admin->setFirstname('Cyril');       
        $admin->setPseudo('Flash');
         $admin->setIsVerified('1');
        $admin->setIsValidInstructor('1');      
        $admin->setDecription('JE suis l\'administrateur');        
        $manager->persist($admin);
        $faker = Faker\Factory::create('fr_FR');
        for($usr = 1; $usr <= 5; $usr++){
            $user = new Users();
                $user->setEmail($faker->email);
                $user->setRoles(['STUDENT']);
                $user->setPassword(
            $this->passwordEncoder->hashPassword($user, 'secret')
        );
            $user->setLastname($faker->lastName);
            $user->setFirstname($faker->firstName);
                         
                $user->setPseudo($faker->firstName);
                $user->setIsVerified(mt_rand(0, 1) == 1 ? true : false);
                $user->setIsValidInstructor(mt_rand(0, 1) == 1 ? true : false);
               
                
                
                $user->setDecription($faker->text(15));

                //On va chercher une référence user
                //$user=$this->getReference(rand(36,40));
                //$form->setUsers($user);
                $this->setReference($usr,$user);
                $manager->persist($user);
            }

        $manager->flush();
        //$this->addReference($this->counter,$user);
       // $this->counter++;
    }
}