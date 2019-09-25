<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Food;
use App\Repository\FoodRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Booking;
use App\Form\BookingType;
use App\Form\ContactType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;

class FrontendController extends AbstractController
{
    /**
     * @Route("/{_locale}",
     *     defaults={"_locale": "es"},
     *     requirements={"_locale": "en|es|fr"},
     *     name="frontend")
     * @Cache(expires="+24 hour", maxage=15, public=true, mustRevalidate=false)
     */
    public function index($_locale, FoodRepository $foodRepository)
    {

        $featuresFoodList = $foodRepository->findAll();

//        $form = $this->createForm(ContactType::class,
//            new Contact(),
//            ['action'=> $this->generateUrl('contact'),
//            'method'=>'POST',
//            ]);


        return $this->render('frontend/index.html.twig', [
//            'form' => $form->createView(),
                'featuresFoodList' => $featuresFoodList,
                '_locale' => $_locale,
        ]);
    }

    /**
     * @Route("/booking", name="booking")
     */
    public function booking(Request $request)
    {
        return $this->json(['status'=>'success']);
    }

    /**
     * @Route("/cf", name="createFood")
     */
    public function createFood()
    {
        $em = $this->getDoctrine()->getManager();

        for ($i = 0; $i<5; $i++)
        {
            $food = new Food();
            $food->setName(['en'=>"Food {$i}", 'es'=> "Comida {$i}"])
                ->setIngredients(['en'=>"many things {$i}", 'es'=> "muchas cosas {$i}"]);
            if($i%2)
                $food->setPrice(rand(1000,1500)/100);
            $em->persist($food);

        }

        $em->flush();
    }
}
