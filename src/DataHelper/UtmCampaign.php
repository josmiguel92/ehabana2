<?php


namespace App\DataHelper;
use Symfony\Component\HttpFoundation\Request;


class UtmCampaign
{
    private $utm_source;
    private $utm_medium;
    private $utm_campaign;

    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->fillData();
    }

    private function fillData(){
        $this->utm_source = $this->request->get('utm_source');
        $this->utm_medium = $this->request->get('utm_medium');
        $this->utm_campaign = $this->request->get('utm_campaign');
    }

    public function getContent()
    {
        $tmp = $this->utm_campaign;
        if($this->utm_medium)
            $tmp .=  " | medium: ".$this->utm_medium;
        if($this->utm_source)
            $tmp .=  " | source: ".$this->utm_source;

        return $tmp;
    }
}