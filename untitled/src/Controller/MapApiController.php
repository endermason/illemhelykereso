<?php

namespace App\Controller;

use App\Repository\ToiletRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MapApiController extends AbstractController
{
    #[Route('/api/geojson', name: 'app_api_geojson')]
    public function index(ToiletRepository $repo): Response
    {
        $geojson = array(
            'type'      => 'FeatureCollection',
            'features'  => array()
        );
        $toilets = $repo->findBy(["Isaccepted"=>true]);

        foreach($toilets as $toilet) {
            $feature = array(
                'type' => 'Feature',
                'geometry' => array(
                    'type' => 'Point',
                    'coordinates' => array($toilet->getGpsCoordinates()[0], $toilet->getGpsCoordinates()[1])
                ),
                'properties' => array(
                    'Address' => $toilet->getAddress(),
                    'Open' => $toilet->getOpeningTimes(),
                    'Price' => $toilet->getPrice(),
                    'Fordis' => $toilet->isIsAccessible(),
                    'Comment' => $toilet->getComments(),
                    'Type' => $toilet->getType(),
                )
            );
            $geojson['features'][] = $feature;
            $response = new Response(json_encode($geojson));
            $response->headers->set('Content-Type', 'application/json');
            $response->headers->set('Access-Control-Allow-Origin', '*');

            return $response;
        }
    }
}
