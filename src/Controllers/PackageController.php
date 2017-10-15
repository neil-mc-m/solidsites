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

    public function packageDetailsAction(Application $app, $slug)
    {
        $package = Package::where('slug', '=', $slug)->get();
        return $app['twig']->render('backend/packageDetails.html.twig', array(
            'package' => $package,
        ));
    }

    public function editAction(Request $request, Application $app, $slug)
    {
        $package = Package::where('slug', $slug)->firstOrFail();
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
//            get the form data
            $formData = $form->getData();
//            assign the model attributes to the correct form data
            $package->name = $formData['name'];
            $package->description = $formData['description'];
            $package->info = $formData['info'];
            $package->slug = $formData['slug'];
            if ($package->save()) {
                $app['session']->getFlashbag()->add('message', 'You just successfully edited a package');
            } else {
                $app['session']->getFlashbag()->add('message', 'That didnt successfully edit');
            }

        }
        return $app['twig']->render('backend/package.html.twig', array(
            'form' => $form->createView()
        ));
    }
}