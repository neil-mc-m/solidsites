<?php
/**
 * Created by PhpStorm.
 * User: neil
 * Date: 18/09/2017
 * Time: 22:12
 */

namespace Solidsites\Controllers;

use Silex\Application;
use Solidsites\Forms\ContactType;
use Solidsites\Models\Package;
use Solidsites\Models\Post;

class FrontendController
{
    public function homeAction(Application $app)
    {
        $packages = Package::all();
        return $app['twig']->render('frontend/home.html.twig', array(
            'packages' => $packages
        ));
    }

    public function servicesAction(Application $app)
    {
        return $app['twig']->render('frontend/services.html.twig', array());
    }

    public function viewAllBlogPostsAction(Application $app)
    {
        $posts = Post::all();
        return $app['twig']->render('frontend/blog.html.twig', array(
            'posts' => $posts
        ));
    }
    public function contactFormAction(Application $app)
    {
        $data = array();
        $form = $app['form.factory']
            ->createBuilder(ContactType::class, $data)
            ->getForm();

        return $app['twig']->render('frontend/partials/contactForm.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function viewPackageAction(Application $app, $slug)
    {
        $package = Package::where('slug', $slug)->firstOrFail();

        return $app['twig']->render('frontend/packageFeatures.html.twig', array(
            'package' => $package
        ));
    }

    public function navbarAction(Application $app)
    {
        $packages = Package::all();
        return $app['twig']->render('frontend/partials/dropdownNav.html.twig', array(
            'packages' => $packages
        ));
    }

}
