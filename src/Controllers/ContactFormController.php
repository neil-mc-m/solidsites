<?php
/**
 * Created by PhpStorm.
 * User: neil
 * Date: 27/10/2017
 * Time: 22:28
 */

namespace Solidsites\Controllers;


use Silex\Application;
use Solidsites\Forms\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;


class ContactFormController
{

    /**
     * Controller to send an email on submit of the contact form.
     * The controller sends a string back as a response as the form is submitted via AJAX.
     *
     * The email host is https://migadu.com
     *
     * @param Request $request
     * @param Application $app
     * @return string
     */
    public function sendContactFormAction(Request $request, Application $app)
    {
        $initialData = array();
        $form = $app['form.factory']
            ->createBuilder(ContactType::class, $initialData)
            ->getForm();
        $form = $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
//            $messageBody = $data['package'].'<br>'.$data['message'];
//            create the transport
            $transport = (new \Swift_SmtpTransport($app['config']['email']['host'], 587, 'tls'))
                ->setUsername($app['config']['email']['username'])
                ->setPassword($app['config']['email']['password'])
//                these options seem to be necessary to work with starttls, migadu's configuration requirement
                ->setStreamOptions(array('ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )))
                ->setAuthMode('plain');
//            important line here. doesnt seem to send without it.
            $transport->setLocalDomain('[127.0.0.1]');
//            inject the transport to the mailer class
            $mailer = new \Swift_Mailer($transport);
//            start building the message
            $message = (new \Swift_Message('Solidsites Contact form'))
                ->setFrom(array($app['config']['email']['username'] => 'contact form'))
                ->setTo(array($app['config']['email']['reciever'] => 'neil'))
                ->setReplyTo(array($data['email'] => $data['name']))
//                this renders an email template as the email body,
//                grabs the important variables from the form and
//                injects them into the template.
                ->setBody($app['twig']->render('frontend/partials/contactEmail.html.twig', array(
                        'package' => $data['package'],
                        'message' => $data['message'],
                        )), 'text/html');
//          result holds the number of successful recipients so we are looking for
//          anything but zero
            $result = $mailer->send($message);
//            $result === 0 ? $app['session']->getFlashbag()->add('message', 'Sorry, but that didnt send. Try again') : $app['session']->getFlashbag()->add('message', "Thanks! We'll be in touch very soon");
            if ($result === 0) {
                $response = 'That didnt send try again?';
                return $response;
            }else {
                $response = "Thanks for your interest. We'll be in touch over the next few days.";
                return $response;
            }

        };

    }

}