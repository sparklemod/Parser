<?php

namespace App\Controllers;

use App\Services\DataBase\Doctrine;
use App\Services\SessionPHP;
use Doctrine\ORM\EntityManager;
use Jenssegers\Blade\Blade;

class BaseController
{
    private Blade $template;
    protected EntityManager $em;

    public function __construct()
    {
        $this->template = new Blade(__DIR__ . '/../Views', __DIR__ . '/../Views/Cache');
        $this->em = Doctrine::getEntityManager();
    }

    protected function getRepository(string $class){
        return $this->em->getRepository($class);
    }

    public function render(string $template, array $data)
    {
        echo $this->template->render($template, $data);

    }

    public function getCurl(string $url): string
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $html = curl_exec($curl);
        curl_close($curl);
        return $html;
    }


}