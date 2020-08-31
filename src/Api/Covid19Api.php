<?php

namespace App\Api;

class Covid19Api extends AbstractApi
{
    public function baseUrl()
    {
        return 'https://data.covid19.go.id';
    }

    public function getConfirmedCaseToday()
    {
        return $this->get('/public/api/update.json');
    }
}