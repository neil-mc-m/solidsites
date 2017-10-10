<?php
/**
 * Created by PhpStorm.
 * User: neil
 * Date: 18/09/2017
 * Time: 22:12
 */

namespace Solidsites\Controllers;

use Silex\Application;
use Solidsites\Models\Package;

class FrontendController
{
    public function HomeAction(Application $app)
    {
        $entries = Package::all();
        return $app['twig']->render('home.html.twig', array(
            'entries' => $entries
        ));
    }

}