<?php

namespace App\Services\Https;

class DynamicUrl
{
    private $url;
    private $dynamic;

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getDyn()
    {
        return $this->dynamic;
    }

    public function SetDyn($dynamic)
    {
        $this->dynamic = $dynamic;
    }
    public function check_url(string $url): string
    {
        if (str_contains($url, '{') && str_contains($url, '}')) {
            $req = explode('/', Request::query('q'));
            $curr_page_url = $req[0]; //profile
            $curr_dyn_part = $req[1] ?? null;
            $page_url = explode('/', $url)[1];
            $dyn_part = explode('/', $url)[2];

            if ($curr_page_url == $page_url && $dyn_part != '') {
                return "/" . $page_url . "/" . $curr_dyn_part;
            } else {
                return $url;
            }
        } else {
            return $url;
        }
    }
}
