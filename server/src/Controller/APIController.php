<?php


namespace App\Controller;


use App\Document\Configuration;
use App\Document\ContactMessage;
use App\Document\Section;
use App\Document\SocialLink;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class APIController extends AbstractController
{
    /**
     * @Route("/api/sections", name="api_get_sections")
     */
    public function getSections(DocumentManager $documentManager, SerializerInterface $serializer)
    {
        $data = $documentManager->getRepository(Section::class)->findAll();

        $response = $serializer->serialize($data, 'json');
        return new Response($response);
    }

    /**
     * @Route("/api/configuration", name="api_get_configuration")
     */
    public function getConfiguration(DocumentManager $documentManager, SerializerInterface $serializer)
    {
        $data = $documentManager->getRepository(Configuration::class)->findAll();
        $data = reset($data);

        $response = $serializer->serialize($data, 'json');
        return new Response($response);
    }

    /**
     * @Route("/api/links", name="api_get_social_links")
     */
    public function getSocialLinks(DocumentManager $documentManager, SerializerInterface $serializer)
    {
        $data = $documentManager->getRepository(SocialLink::class)->findAll();

        $response = $serializer->serialize($data, 'json');
        return new Response($response);
    }

    /**
     * @Route("/api/messages", name="api_post_contact_message", methods={"POST"})
     */
    public function createContactMessage(Request $request, DocumentManager $documentManager, SerializerInterface $serializer)
    {
        $data = json_decode($request->getContent(), true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return new JsonResponse('Bad Request', 400);
        }
        $isValid = true;
        if (array_key_exists('message', $data)) {
            if (!array_key_exists('name', $data['message']) || !$data['message']['name']) {
                $isValid = false;
            }
            if (!array_key_exists('title', $data['message']) || !$data['message']['title']) {
                $isValid = false;
            }
            if (!array_key_exists('email', $data['message']) || !$data['message']['email']) {
                $isValid = false;
            }
            if (!array_key_exists('content', $data['message']) || !$data['message']['content']) {
                $isValid = false;
            }
        } else {
            $isValid = false;
        }

        if (!$isValid) {
            return new JsonResponse('Bad Request', 400);
        }
        $contactMessage = $serializer->denormalize($data['message'], ContactMessage::class, 'json');
        $documentManager->persist($contactMessage);
        $documentManager->flush();
        return new JsonResponse('Created', 201);
    }
}