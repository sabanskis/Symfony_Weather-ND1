<?php

namespace App\Controller;

use App\GoogleApi\WeatherService;
use App\GoogleApi\Validator;
use App\Model\NullWeather;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WeatherController extends AbstractController
{
    public function index($day)
    {

        $dateValidator = new Validator();
        $ErrorMessage = '';
        if($day != null) {
            $ErrorAnswer = $dateValidator->DateValidator($day);
            if($ErrorAnswer !== true)
            {
                $ErrorMessage = $ErrorAnswer;
            }
        }
        if($ErrorMessage != '')
        {
            return $this->render('weather/errormessage.html.twig', [
                'error' => $ErrorMessage ]);
        }
        else {
        try {
            $fromGoogle = new WeatherService();
            $weather = $fromGoogle->getDay(new \DateTime($day));
        } catch (\Exception $exp) {
            $weather = new NullWeather();
        }

        return $this->render('weather/index.html.twig', [
            'weatherData' => [
                'date'      => $weather->getDate()->format('Y-m-d'),
                'dayTemp'   => $weather->getDayTemp(),
                'nightTemp' => $weather->getNightTemp(),
                'sky'       => $weather->getSky()
            ],
        ]);
    }
}}
