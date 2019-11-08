<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class SecurityController extends Controller
{
    /**
     * @Route("/inscription", name="security_registration")
     */
    public function registration(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $hash = $encoder->encodePassword($user, $user->getPassword());

            $user->setPassword($hash);

            $user->setCreateAt(new \DateTime());
            $manager->persist($user);
            $manager->flush();
        }
        

        return $this->render('security/registration.html.twig', [
            'form' => $form->createView(),
            //Permet d'afficher le nom du contrôlleur
            'controller_name' => 'HomeController',
            //Permet d'avoir le link de la navbar en active
            'current_menu' => 'home',
            //Variable pour le titre
            'title' => 'Home',
            //Titre de l'application
            'appName' => 'StarterKit Symfony 4'
        ]);
    }
}
