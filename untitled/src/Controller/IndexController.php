<?php

namespace App\Controller;

use App\Entity\Toilet;
use App\Form\AdminToiletFormType;
use App\Form\ToiletFormType;
use App\Repository\ToiletRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/index', name: 'app_index')]
    public function index(): Response
    {
        return $this->render('kezdolap.html.twig', [
            'controller_name' => 'IndexController',
        ]);

    }
    #[Route('/map', name: 'app_map')]
    public function map(): Response
    {
        return $this->render('index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
    #[Route('/admin', name: 'app_admin')]
    public function admin(Request $request, EntityManagerInterface $entityManager, ToiletRepository $repository): Response
    {
        $toilets = $repository->findBy([],["Isaccepted"=>"ASC"]);

        return $this->render('admin.html.twig', [
            'controller_name' => 'IndexController',
            'toilets' =>$toilets
        ]);
    }
    #[Route('/admin/edit/{id}',methods:['GET','POST'], name: 'app_admin_edit')]
    public function adminedit($id,Request $request, EntityManagerInterface $entityManager, ToiletRepository $repository): Response
    {

        $toilet = $repository->find($id);
        $form =$this->createForm(AdminToiletFormType::class,$toilet);
        $form->handleRequest($request);
        $toilet->setAddress($form->get("address")->getData()
        );
        $toilet->setGpsCoordinates(
            $form->get("gpscoordinates")->getData()
        );
        $toilet->setComments($form->get("comments")->getData());
        $toilet->setIsAccessible($form->get("isaccessible")->getData());
        $toilet->setOpeningTimes($form->get("openingtimes")->getData());
        $toilet->setPrice($form->get("price")->getData());
        $toilet->setType($form->get("type")->getData());
        $toilet->setIsaccepted($form->get("isaccepted")->getData());

        $entityManager->persist($toilet);
        $entityManager->flush();
        return $this->render('edit.html.twig', [
            'controller_name' => 'IndexController',
            'toilet' =>$toilet,
            'form'=>$form->createView()
        ]);
    }
    #[Route('/add', name: 'app_add')]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $toilet = new Toilet();

        $form = $this->createForm(ToiletFormType::class, $toilet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = array();
            $datastring = file_get_contents("http://api.positionstack.com/v1/forward?access_key=729730bff70d7ec3ac8d071aa376d31c&query=".$form->get("address")->getData());
            $data = json_decode($datastring,true);
            $dataarray = array();
            array_push($dataarray,$data["data"][0]["latitude"],$data["data"][0]["longitude"]);
            $toilet->setAddress($form->get("address")->getData()
            );
            $toilet->setGpsCoordinates(
                $dataarray
            );
            $toilet->setComments($form->get("comments")->getData());
            $toilet->setIsAccessible($form->get("isaccessible")->getData());
            $toilet->setOpeningTimes($form->get("openingtimes")->getData());
            $toilet->setPrice($form->get("price")->getData());
            $toilet->setType($form->get("type")->getData());
            $toilet->setIsaccepted(false);

            $entityManager->persist($toilet);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_index');
        }

        return $this->render('hozzaadas.html.twig', [
            'form' => $form->createView(),
        ])
        ;
    }

}
