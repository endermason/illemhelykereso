<?php

namespace App\Controller;

use App\Repository\ToiletRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class MapApiController extends AbstractController
{
    #[Route('/api/geojson', name: 'app_api_geojson')]
    public function index(ToiletRepository $repo): JsonResponse
    {
        $geojson = array(
            'type'      => 'FeatureCollection',
            'features'  => array()
        );
        $toilets = $repo->findAll();

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
        }
        return $this->json($geojson);
    }
}
