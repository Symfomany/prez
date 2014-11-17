<?php
namespace Hetic\PublicBundle\Handler;
use Doctrine\ORM\EntityManager;
use Hetic\PublicBundle\Entity\Post;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class PostHandler
 * @package Hetic\PublicBundle\Handler
 */
class PostHandler{

    /**
     * Entity Manager
     * @var EntityManager
     */
    protected $em;

    /**
     * Form Factory
     * @var
     */
    protected $formFactory;

    /**
     * Request Stack
     * @var
     */
    protected $request;

    /**
     * Constructor
     * @param EntityManager $em
     * @param FormFactory $formFactory
     * @param RequestStack $request
     */
    public function __construct(EntityManager $em, FormFactory $formFactory, RequestStack $request){
        $this->em = $em;
        $this->formFactory = $formFactory;
        $this->request = $request;
    }

    /**
     * Processing validating
     * @param Post $post
     * @return bool
     */
    public function process(Post $post = null){
        if (!$post) {
            throw new NotFoundHttpException(
                'Aucun post trouvé pour cet id : '.$id
            );
        }

        $form = $this->getForm($post);

        $form->handleRequest($this->request);

        if ($form->isValid()) {

            return true;
        }

        return false;
    }

    /**
     * Get a form
     * @param Post $post
     * @return mixed
     */
    public function getForm(Post $post = null){
        return $this->formFactory->createForm(new PostType(), $post, array(
            'method' => 'POST',
            'attr' => array('novalidate' => "novalidate"),
        ));
    }

    /**
     * Get a repository
     * @return \Doctrine\ORM\EntityRepository
     */
    public function getRepository(){
        return $this->em->getRepository('HeticPublicBundle:Post');
    }

    /**
     * Storing a post
     * @param Post $post
     */
    public function store(Post $post){
        $this->em->persist($post);
        $this->em->flush();
    }

    /**
     * Remove a post
     * @param Post $post
     */
    public function remove(Post $post){
        $this->em->remove($post);
        $this->em->flush();
    }

    /**
     * Find a post
     * @param $id
     * @return null|object
     */
    public function find($id){
        return $this->getRepository()->find($id);
    }

    /**
     * Set visibility
     * @param $id
     * @param bool $visible
     */
    public function visible($id , $visible = true){
        $post = $this->find($id);
        $post->setVisible($visible);
        $this->store($post);
    }

    /**
     * Find some posts
     * @param array $criteria
     * @param array $order
     * @param int $limit
     * @return array
     */
    public function some($criteria = array(), $order = array(), $limit = 10){
        return $this->getRepository()->findBy($criteria, $order, $limit);
    }

}