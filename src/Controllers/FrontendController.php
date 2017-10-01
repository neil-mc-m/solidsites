<?php
/**
 * Created by PhpStorm.
 * User: neil
 * Date: 18/09/2017
 * Time: 22:12
 */

namespace Solidsites\Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Contentful\Delivery\Client;
use Contentful\Delivery\Query;
class FrontendController
{
    public function HomeAction(Application $app)
    {
        $client = new Client('96cdfcd98dc251f36f78369503b8ef915a8f2b5289d5338f31229d860ed61e83', '3w17hontfq7i');
//        $content = $client->getContentType('packages');
//        $id = $content->getId();
//        var_dump($id);
//        $entry = $client->getEntry('10eB3cAND6SmYS60wi8qyc');
//        var_dump($entry);
//        return $app['twig']->render('home.html.twig', array(
//            'name' => $entry->getName(),
//            'description' => $entry->getDescription(),
//            'info' => $entry->getInfo(),
//            'featureHeading' => $entry->getFeatureHeading(),
//            'feature_1' => $entry->getFeature1(),
//            'feature_2' => $entry->getFeature2(),
//            'feature_3' => $entry->getFeature3()
//        ));
        $query = (new Query())
            ->setContentType('packages')
            ->orderBy('sys.createdAt')
        ;

        $entries = $client->getEntries($query);

        var_dump($entries);
        return $app['twig']->render('home.html.twig', array(
            'entries' => $entries
        ));
    }

    public function packageAction(Request $request, Application $app)
    {
        $client = new Client('96cdfcd98dc251f36f78369503b8ef915a8f2b5289d5338f31229d860ed61e83', '3w17hontfq7i');
        $id = $request->request->get('name');
        $entry = $client->getEntry($id);
        return $app['twig']->render('package.html.twig', array(
            'entry' => $entry
        ));

    }
}