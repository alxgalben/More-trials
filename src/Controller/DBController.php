<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Video;
use App\Services\GiftsService;
use App\Services\UserService;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use App\Form\VideoFormType;

class DBController extends AbstractController
{
    //--------------------------------------------------------------------------------------------------------
    /**
     * @Route({
     * "en" : "/database",
     * "ro" : "bazadedate"}, name="app_database")
     */
    public function index(GiftsService $gifts, Request $request) //SessionInterface $session //TranslatorInterface $translator
    {

        // $users = $this -> getDoctrine() -> getRepository(User::class) -> findAll();
        // $cache = new FilesystemAdapter();
        // $posts = $cache->getItem('database.get_posts');
        // if (!$posts->isHit()) {
        //     $posts_from_db = ['post1', 'post2', 'post3'];
        //     dump('cpnnected with database...');

        //     $posts -> set(serialize($posts_from_db));
        //     $posts->expiresAfter(5);
        //     $cache->save($posts);

        // if ($users) {
        //     throw $this -> createNotFoundException('The users does not exist.');
        // }

        //exit($request -> query -> get('page', 'default'));

        // //exit($request -> cookies -> get('PHPSESSID'));
        // $session -> set('name', 'session value');
        // //$session -> remove('name');
        // $session -> clear();
        // if($session->has('name')) {
        //     exit($session -> get('name'));
        //}

        // $this -> addFlash ('notice', 'Changes saved!');

        // $cookie = new Cookie (
        //     'my_cookie',
        //     'cookie value',
        //     time() + (2*365*24*60*60)
        // );

        // $res = new Response();
        // $res -> headers -> setCookie($cookie);
        // $res -> send();

        // $res = new Response();
        // $res -> headers -> clearCookie('my_cookie');
        // $res -> send();

        // $gifts = ['flowers', 'car' ,'money', 'piano'];
        // shuffle($gifts);

        // $entityManager = $this -> getDoctrine() -> getManager();
        // $user = new User;
        // $user -> setName('Alex');
        // $user2 = new User;
        // $user2 -> setName('Theo');
        // $user3 = new User;
        // $user3 -> setName('Sergiu');
        // $entityManager -> persist($user);
         //$entityManager -> persist($user2);
         //$entityManager -> persist($user3);
        // $entityManager -> flush();

        $entityManager = $this -> getDoctrine() -> getManager();
        $videos = $entityManager->getRepository(Video::class)->findAll();
        dump($videos);
        // $user4 = new User;
        // $user4 -> setName('Mihai');
        // $entityManager -> persist($user4);
        // $entityManager -> flush();

            $video = new Video();
            $video->setTitle('Write a blog post!');

            $form = $this->createForm(VideoFormType::class, $video);
            $file = $form->get('file')->getData();
            $fileName = sha1(random_bytes(14)).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('videos_directory'),
                $fileName
            );
            $video->setFile($fileName);
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()) {
                //dump($form->getData());
                //return $this->redirectToRoute('home');
                $entityManager->persist($video);
                $entityManager->flush();
            }

            $message = (new \Swift_Message('Hello Email'))
            ->setFrom('send@example.com')
            ->sendTo('recipient#example.com')
            ->setBody(
                $this->renderView(
                    'emails.registration.html.twig',
                    array('name' => 'Robert'),
                ),
                'text/html'
            );

            $mailer -> send($message);

            $translated -> $translator -> trans();
            dump($translated.getLocale());

        return $this->render('db/index.html.twig', [
            'controller_name' => 'DBController',
            'random_gift' => $gifts -> gifts,
            'form' => $form->createView()
        ]);
}}
    //--------------------------------------------------------------------------------------------------------
    /**
     * @Route("/blog/{page}", name="blog_list", requirements = {"page" = "\d+"})
     */

    //  public function index2() {
    //     return new Response ('test test 678');
    //  }

     //--------------------------------------------------------------------------------------------------------
     /**
     * @Route(
     *      "/articles/{_locale}/{year}/{slug}/{category}",
     *      defaults={"category": "computers"},
     *      requirements={
     *         "_locale": "en|fr", 
     *          "category": "computers|rtv",
     *          "year": "\d+"
     *      }    
     * )
     */
//     public function index3()
//     {
//         return new Response('An advanced route example');
//     }

//     //--------------------------------------------------------------------------------------------------------
//     /**
//      * @Route({
//      *  "nl" : "/over-ons",
//      *  "en" : "/about-us"
//      * }, name = "about us"       
//      * )
//      */

//      public function index4()
//     {
//         return new Response('translation');
//     }

//     //--------------------------------------------------------------------------------------------------------

//     public function mostPopularPosts($number = 3)
//     {
//         $posts = ['posts1', 'posts2', 'posts3'. 'posts4'];
//         return $this -> render('default/most_popular_posts.html.twig', [
//             'posts' -> $posts
//         ]);
//     }

//     public function reading (Request $request, User $user) {
//         //$repository = $this -> getDoctrine() -> getRepository (User::class);
//         //$user = $repository -> find(1);
//         //$user = $repository -> findOneBy(['name' => 'Robert']);
//         dump($user);

//         // $entityManager = $this -> getDoctrine() -> getManager();
//         // $conn = $entityManager -> getConnection();
//         // $sql = 'SELECT * FROM user u WHERE u.id > :id';
//         // $stmt = $conn -> prepare($sql);
//         // $stmt -> execute (['id' => 3]);
//         // dump($stmt -> fetchAll());
//             return $this -> render('default/index.html.twig', [
//             'controller_name' => 'DBController'
//         ]);
//     }

//     public function testIndex (Request $request) {
//         $entityManager = $this -> getDoctrine() -> getManager();
//         $user = new User();
//         $user -> setName('Robert');
//         for($i = 1; $i <= 3; $i++) {
//             $video = new Video();
//             $video->setTitle('Video title - ' . $i);
//             $user->addVideo($video);
//             $entityManager->persist($video);
//         }

//         $entityManager->persist($user);
//         $entityManager->flush();
//         dump('Created a video with the id of ' . $video->getId());

//     }



// }
