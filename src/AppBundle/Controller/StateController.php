<?php
// src/AppBundle/Controller/StateController.php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use AppBundle\Controller\Contract\PageInitInterface;

class StateController extends Controller implements PageInitInterface
{
    /**
     * @Method({"GET"})
     * @Route(
     *      "/",
     *      name="index",
     *      host="{domain}",
     *      defaults={"_locale" = "%locale%", "domain" = "%domain%"},
     *      requirements={"domain" = "%domain%"}
     * )
     */
    public function indexAction()
    {
        $_manager = $this->getDoctrine()->getManager();

        $content = [
            'mainSlide'       => $_manager->getRepository('AppBundle:MainSlide')->findAll()[0],
            'forumNumbers'    => $_manager->getRepository('AppBundle:ForumNumber')->findAll(),
            'programmeItems'  => $_manager->getRepository('AppBundle:ProgrammeItem')->findBy(['isMain' => TRUE]),
            'experts'         => $_manager->getRepository('AppBundle:Expert')->findAll(),
            'expertsThoughts' => $_manager->getRepository('AppBundle:ExpertThought')->findAll(),
            'sponsors'        => $_manager->getRepository('AppBundle:Sponsor')->findAll()
        ];

        return $this->render('AppBundle:State:index.html.twig', [
            'metadata' => $this->get('app.metadata')->getCurrentMetadata(),
        ] + $content);
    }

    /**
     * @Method({"GET"})
     * @Route(
     *      "/programme",
     *      name="programme",
     *      host="{domain}",
     *      defaults={"_locale" = "%locale%", "domain" = "%domain%"},
     *      requirements={"domain" = "%domain%"}
     * )
     */
    public function programmeAction()
    {
        $programmeItems = $this->getDoctrine()->getManager()->getRepository('AppBundle:ProgrammeItem')->findAll();

        return $this->render('AppBundle:State:programme.html.twig', [
            'metadata'       => $this->get('app.metadata')->getCurrentMetadata(),
            'programmeItems' => $programmeItems
        ]);
    }

    /**
     * @Method({"GET"})
     * @Route(
     *      "/experts",
     *      name="experts",
     *      host="{domain}",
     *      defaults={"_locale" = "%locale%", "domain" = "%domain%"},
     *      requirements={"domain" = "%domain%"}
     * )
     */
    public function expertsAction()
    {
        $experts = $this->getDoctrine()->getManager()->getRepository('AppBundle:Expert')->findAll();

        return $this->render('AppBundle:State:experts.html.twig', [
            'metadata' => $this->get('app.metadata')->getCurrentMetadata(),
            'experts'  => $experts
        ]);
    }

    /**
     * @Method({"GET"})
     * @Route(
     *      "/cases/{slug}",
     *      name="cases",
     *      host="{domain}",
     *      defaults={"_locale" = "%locale%", "domain" = "%domain%", "slug" = null},
     *      requirements={"domain" = "%domain%", "slug" = "[a-z0-9_]+"}
     * )
     */
    public function casesAction($slug)
    {
        $_manager = $this->getDoctrine()->getManager();

        $forumCasesCategories = $_manager->getRepository('AppBundle:ForumCaseCategory')->findAll();

        if( $slug ) {
            // I was bored and decided to write a closure here
            // Practically it's -1 request to Doctrine
            $getCategoryBySlug = function($forumCasesCategories, $slug)
            {
                foreach($forumCasesCategories as $object) {
                    if( $object->getSlug() === $slug )
                        return $object;
                }

                return FALSE;
            };

            if( !($forumCasesCategory = $getCategoryBySlug($forumCasesCategories, $slug)) ) {
                throw $this->createNotFoundException();
            }

            $forumCases = $_manager->getRepository('AppBundle:ForumCase')->findBy(['forumCaseCategory' => $forumCasesCategory]);
        } else {
            $forumCases = $_manager->getRepository('AppBundle:ForumCase')->findAll();
        }

        return $this->render('AppBundle:State:cases.html.twig', [
            'metadata'             => $this->get('app.metadata')->getCurrentMetadata(),
            'slug'                 => $slug,
            'forumCasesCategories' => $forumCasesCategories,
            'forumCases'           => $forumCases
        ]);
    }

    /**
     * @Method({"GET"})
     * @Route(
     *      "/cases/{id}/{slug}",
     *      name="case",
     *      host="{domain}",
     *      defaults={"_locale" = "%locale%", "domain" = "%domain%"},
     *      requirements={"domain" = "%domain%", "id" = "\d+", "slug" = "[a-z0-9_]+"}
     * )
     */
    public function caseAction($id)
    {
        $_manager = $this->getDoctrine()->getManager();

        $forumCase = $_manager->getRepository('AppBundle:ForumCase')->find($id);

        if( !$forumCase ) {
            throw $this->createNotFoundException();
        }

        $metadata = $this->get('app.metadata')
            ->getCurrentMetadata()
            ->setTitle($forumCase->getTitle())
            ->setDescription($forumCase->getDescription())
        ;

        return $this->render('AppBundle:State:case.html.twig', [
            'metadata'  => $metadata,
            'forumCase' => $forumCase
        ]);
    }

    /**
     * @Method({"GET"})
     * @Route(
     *      "/contacts",
     *      name="contacts",
     *      host="{domain}",
     *      defaults={"_locale" = "%locale%", "domain" = "%domain%"},
     *      requirements={"domain" = "%domain%"}
     * )
     */
    public function contactsAction()
    {
        $staffContacts = $this->getDoctrine()->getManager()->getRepository('AppBundle:StaffContact')->findAll();

        return $this->render('AppBundle:State:contacts.html.twig', [
            'metadata'      => $this->get('app.metadata')->getCurrentMetadata(),
            'staffContacts' => $staffContacts
        ]);
    }
    /**
     * @Method({"GET"})
     * @Route(
     *      "/tickets",
     *      name="tickets",
     *      host="{domain}",
     *      defaults={"_locale" = "%locale%", "domain" = "%domain%"},
     *      requirements={"domain" = "%domain%"}
     * )
     */
    public function ticketsAction()
    {
        return $this->render('AppBundle:State:tickets.html.twig', [
            'metadata' => $this->get('app.metadata')->getCurrentMetadata(),
        ]);
    }
}