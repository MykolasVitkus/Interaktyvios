<?php


namespace App\Controller;


use App\Document\Configuration;
use App\Document\ContactMessage;
use App\Document\Section;
use App\Document\SocialLink;
use App\Form\ConfigurationType;
use App\Form\SectionType;
use App\Form\SocialLinkType;
use App\Repository\ContactMessageRepository;
use Doctrine\ODM\MongoDB\DocumentManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        return $this->redirectToRoute('admin_statistics');
    }

    /**
     * @Route("/admin/statistics", name="admin_statistics")
     */
    public function statistics(DocumentManager $documentManager)
    {
        $latestMessages = $documentManager->getRepository(ContactMessage::class)->findLatestMessages();
        $configuration = $documentManager->getRepository(Configuration::class)->findAll();
        $configuration = reset($configuration);
        $lastMonthMessagesCount = $documentManager->getRepository(ContactMessage::class)->getLastMonthCount();
        $messagesCount = $documentManager->getRepository(ContactMessage::class)->getCount();
        return $this->render('admin/statistics/index.html.twig', [
            'messages' => $latestMessages,
            'configuration' => $configuration,
            'lastMonthMessagesCount' => $lastMonthMessagesCount,
            'messagesCount' => $messagesCount
        ]);
    }

    /**
     * @Route("/admin/configuration", name="admin_configuration")
     */
    public function configuration(Request $request, DocumentManager $documentManager)
    {
        $configuration = $documentManager->getRepository(Configuration::class)->findAll();
        $configuration = reset($configuration);
        $form = $this->createForm(ConfigurationType::class, $configuration);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $documentManager->flush();
            $this->addFlash(
                'success',
                'Configuration succesfully updated'
            );
        }
        return $this->render('admin/configuration/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/messages", name="admin_messages")
     */
    public function messages(DocumentManager $documentManager, PaginatorInterface $paginator, Request $request)
    {
        $messages = $documentManager->getRepository(ContactMessage::class)->findAllDescending();

        $pagination = $paginator->paginate(
            $messages,
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('admin/contact-messages/index.html.twig', [
            'messages' => $pagination
        ]);
    }

    /**
     * @Route("/admin/messages/{id}", name="admin_message")
     */
    public function message($id, DocumentManager $documentManager)
    {
        /** @var ContactMessage $message */
        $message = $documentManager->getRepository(ContactMessage::class)->findOneBy(['id' => $id]);
        $message->setIsRead(true);
        $documentManager->flush();
        return $this->render('admin/contact-messages/view.html.twig', [
            'message' => $message
        ]);
    }

    /**
     * @Route("/admin/links", name="admin_links")
     */
    public function links(DocumentManager $documentManager)
    {
        $links = $documentManager->getRepository(SocialLink::class)->findAll();
        return $this->render('admin/links/index.html.twig', [
            'links' => $links
        ]);
    }

    /**
     * @Route("/admin/links/add", name="admin_link_add")
     */
    public function addSocialLink(Request $request, DocumentManager $documentManager)
    {
        $link = new SocialLink();
        $form = $this->createForm(SocialLinkType::class, $link);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $documentManager->persist($link);
            $documentManager->flush();
            return $this->redirectToRoute('admin_links');
        }
        return $this->render('admin/links/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/links/delete/{id}", name="admin_link_delete")
     */
    public function deleteSocialLink($id, DocumentManager $documentManager)
    {
        $link = $documentManager->getRepository(SocialLink::class)->findOneBy(['id' => $id]);
        $documentManager->remove($link);
        $documentManager->flush();
        return $this->redirectToRoute('admin_links');
    }

    /**
     * @Route("/admin/sections", name="admin_sections")
     */
    public function segments(DocumentManager $documentManager)
    {
        $sections = $documentManager->getRepository(Section::class)->findAll();
        return $this->render('admin/sections/index.html.twig', [
            'sections' => $sections
        ]);
    }

    /**
     * @Route("/admin/sections/add", name="admin_sections_add")
     */
    public function addSegment(Request $request, DocumentManager $documentManager)
    {
        $section = new Section();
        $form = $this->createForm(SectionType::class, $section);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $documentManager->persist($section);
            $documentManager->flush();
            return $this->redirectToRoute('admin_sections');
        }
        return $this->render('admin/sections/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/sections/edit/{id}", name="admin_sections_edit")
     */
    public function editSection($id, Request $request, DocumentManager $documentManager)
    {
        $section = $documentManager->getRepository(Section::class)->findOneBy(['id' => $id]);
        $form = $this->createForm(SectionType::class, $section);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $documentManager->flush();
            return $this->redirectToRoute('admin_sections');
        }
        return $this->render('admin/sections/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/sections/delete/{id}", name="admin_sections_delete")
     */
    public function deleteSection($id, DocumentManager $documentManager)
    {
        $section = $documentManager->getRepository(Section::class)->findOneBy(['id' => $id]);
        $documentManager->remove($section);
        $documentManager->flush();
        return $this->redirectToRoute('admin_sections');
    }

}