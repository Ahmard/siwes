<?php

use App\Helpers\Core\Alert;
use App\Helpers\Resp;
use App\Models\Person;
use JetBrains\PhpStorm\Pure;

if (!function_exists('person')) {

    /**
     * This function will return current person
     *
     * @param string|void identifier
     * @return Person
     */
    function person($personId = null): Person
    {
        if ($personId) {
            return App::make('wise.person')->find($personId);
        }

        return App::make('wise.person');
    }
}

if (!function_exists('resp')) {
    /**
     * A helper around responder api helper
     * @param void
     * @rerurn responder()
     * @return Resp
     */
    #[Pure] function resp(): Resp
    {
        return new Resp();
    }
}

if(! function_exists('person_image')){
    /**
     * Person image
     * @var null|string
     * @return string
     */
    function person_image($url): string
    {
        return url(config('sysconf.url.person_images') . $url);
    }
}
