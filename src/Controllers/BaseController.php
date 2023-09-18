<?php

namespace App\Controllers;

use App\Services\DataBase\Doctrine;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Jenssegers\Blade\Blade;

class BaseController
{
    private Blade $template;
    private EntityManager $em;

    public function __construct()
    {
        $this->template = new Blade(__DIR__ . '/../Views', __DIR__ . '/../Views/Cache');
        $this->em = Doctrine::getEntityManager();
    }

    protected function getRepository(string $class): EntityRepository
    {
        return $this->em->getRepository($class);
    }

    public function render(string $template, array $data)
    {
        echo $this->template->render($template, $data);
    }

    protected function getFileFromCurl(string $url, string $filename): string
    {
        $filePath = __DIR__ . '/../Files/' . $filename . '.html';
        file_put_contents($filePath, $this->getCurl($url));
        return $filePath;
    }

    protected function getCurl(string $url): string
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