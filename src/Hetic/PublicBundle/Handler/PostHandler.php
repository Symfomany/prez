<?php
namespace Hetic\PublicBundle\Handler;
use Doctrine\ORM\EntityManager;
use Hetic\PublicBundle\Entity\Post;
use Hetic\PublicBundle\Form\Type\PostType;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\RequestStack;


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
     * The current form
     * @var
     */
    protected $form;

    /**
     * The current post
     * @var
     */
    protected $post;

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
        $this->request = $request->getCurrentRequest();
    }

    /**
     * Processing validating
     * @return bool
     */
    public function process(){

        $this->form->handleRequest($this->request);

        if ($this->form->isValid()) {
            $this->store($this->post);
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
        if($post == null){
            $post = new Post();
        }
        $this->post = $post;
        $this->form =  $this->formFactory->create(new PostType(), $post, array(
            'method' => 'POST',
            'attr' => array('novalidate' => "novalidate"),
        ));

        return $this->form;
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

    /**
     * @return EntityManager
     */
    public function getEm()
    {
        return $this->em;
    }

    /**
     * @param EntityManager $em
     */
    public function setEm($em)
    {
        $this->em = $em;
    }

    /**
     * @return mixed
     */
    public function getFormFactory()
    {
        return $this->formFactory;
    }

    /**
     * @param mixed $formFactory
     */
    public function setFormFactory($formFactory)
    {
        $this->formFactory = $formFactory;
    }

    /**
     * @return mixed
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @param mixed $post
     */
    public function setPost($post)
    {
        $this->post = $post;
    }

    /**
     * @return mixed
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param mixed $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }




}