<?php
/**
 * Created by PhpStorm.
 * User: neil
 * Date: 09/10/2017
 * Time: 21:47
 */

namespace Solidsites\Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Solidsites\Forms\PackageType;
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

    public function viewPackageDetailsAction(Application $app, $slug)
    {
        $package = Package::where('slug', '=', $slug)->get();
        return $app['twig']->render('backend/packageDetails.html.twig', array(
            'package' => $package,
        ));
    }

    public function editAction(Request $request, Application $app, $slug)
    {
        $package = Package::where('slug', '=', $slug)->get();
        $data = array(
            'name' => $package->name,
            'description' => $package->description,
            'info' => $package->info,
            'created_at' => $package->created_at,
            'updates_at' => $package->updated_at,
            'slug' => $package->slug
        );
        $form = $app['form.factory']
            ->createBuilder(PackageType::class, $data)
            ->getForm();
        $form->handleRequest($request);
        if ($form->isValid()) {
            $data = $form->getData();

        }
        return $app['twig']->render('backend/forms/package.html.twig', array(
            'form' => $form->createView()
        ));
    }
}