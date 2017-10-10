<?php
/**
 * Created by PhpStorm.
 * User: neil
 * Date: 09/10/2017
 * Time: 21:47
 */

namespace Solidsites\Controllers;

use Silex\Application;
use Solidsites\Models\Package;

class PackageController
{
    public function viewAction(Application $app)
    {
        $packages = Package::all();
        return $app['twig']->render('backend/packages.html.twig', array(
            'packages' => $packages,
        ));
    }

    public function editAction(Application $app, $slug)
    {
        $package = Package::where('slug', '=', $slug)->get();
        return $app['twig']->render('backend/packageDetails.html.twig', array(
            'package' => $package,
        ));
    }
}