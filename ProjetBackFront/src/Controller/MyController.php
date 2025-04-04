<?php

namespace App\Controller;

use App\Service\MongoDBManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use MongoDB\BSON\ObjectId;

class MyController extends AbstractController
{
    private $mongoDBManager;

    public function __construct(MongoDBManager $mongoDBManager)
    {
        $this->mongoDBManager = $mongoDBManager;
    }

    private function getCollection(string $collectionName)
    {
        $db = $this->mongoDBManager->getDatabase('mydatabase');
        return $db->selectCollection($collectionName);
    }

    /**
     * @Route("/", name="home", methods={"GET"})
     */
    public function home(): Response
    {
        $userCollection = $this->getCollection(collectionName: 'myCollection'); // Collection des utilisateurs
        $images = [];

        $users = $userCollection->find()->toArray(); // Récupère tous les utilisateurs
        foreach ($users as $user) {
            $userArray = (array)$user; // Convertit BSONDocument en tableau
            //dump($userArray);die;
            foreach ($userArray['images'] as $image) {
                //dump($image);die;
                $images[] = [
                    'path' => $image,
                    'user' => $userArray['name'] ?? 'Anonyme',
                    'city' => $userArray['city'] ?? 'Ville inconnue',
                    'likes' => $userArray['likes'] ?? 0,
                    //'comments' => $userArray['comments'] ?? 0,
                    ];
                }
            }
        //dump($images);die;
        return $this->render('home/index.html.twig', [
            'title' => 'OnlyMym',
            'images' => $images,
        ]);
    }

    /**
     * @Route("/login", name="user_login", methods={"GET", "POST"})
     */
    public function login(Request $request): JsonResponse
    {
        if ($request->isMethod('GET')) {
            // Retourner une réponse adaptée pour GET (par exemple, une vue pour se connecter)
            return new JsonResponse(['message' => 'Accès à la page de connexion']);
        }

        // Traitement des requêtes POST pour la connexion
        $data = json_decode($request->getContent(), true);
        $username = $data['username'] ?? null;
        $password = $data['password'] ?? null;

        if (!$username || !$password) {
            return new JsonResponse(['success' => false, 'message' => 'Tous les champs sont requis.'], 400);
        }

        $collection = $this->getCollection('users');
        $user = $collection->findOne(['username' => $username]);

        if ($user && password_verify($password, $user['password'])) {
            $request->getSession()->set('user', $user['username']);
            return new JsonResponse(['success' => true, 'message' => 'Connexion réussie.']);
        }

        return new JsonResponse(['success' => false, 'message' => 'Identifiants invalides.'], 401);
    }

    /**
     * @Route("/logout", name="user_logout", methods={"POST"})
     */
    public function logout(Request $request): JsonResponse
    {
        $request->getSession()->remove('user');
        return new JsonResponse(['success' => true, 'message' => 'Déconnexion réussie.']);
    }

    /**
     * @Route("/register", name="user_register", methods={"GET", "POST"})
     */
    public function register(Request $request): Response
    {
        if ($request->isMethod('GET')) {
            // Affiche le formulaire d'inscription pour les requêtes GET
            return $this->render('register.html.twig', [
                'title' => 'Inscription',
            ]);
        }

        // Traitement des données pour les requêtes POST
        $data = json_decode($request->getContent(), true);
        if (empty($data['username']) || empty($data['email']) || empty($data['password'])) {
            return new JsonResponse(['success' => false, 'message' => 'Tous les champs sont requis.'], 400);
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return new JsonResponse(['success' => false, 'message' => 'Email invalide.'], 400);
        }

        $collection = $this->getCollection('users');
        $existingUser = $collection->findOne(['email' => $data['email']]);

        if ($existingUser) {
            return new JsonResponse(['success' => false, 'message' => 'Cet email est déjà utilisé.'], 400);
        }

        $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);

        $collection->insertOne([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $hashedPassword,
            'createdAt' => date('Y-m-d H:i:s'),
        ]);

        return new JsonResponse(['success' => true, 'message' => 'Inscription réussie.']);
    }

    /**
     * @Route("/add-photo", name="add_photo", methods={"POST"})
     */
    public function addPhoto(Request $request): JsonResponse
    {
        $photoData = $request->files->get('photo');

        if (!$photoData) {
            return new JsonResponse(['success' => false, 'message' => 'Aucune photo reçue.'], 400);
        }

        $photoName = md5(uniqid()) . '.' . $photoData->guessExtension();
        $photoData->move(__DIR__ . '/../../public/uploads', $photoName);

        $collection = $this->getCollection('photos');
        $collection->insertOne([
            'path' => $photoName,
            'likes' => 0,
            'comments' => [],
            'createdAt' => date('Y-m-d H:i:s'),
        ]);

        return new JsonResponse(['success' => true, 'message' => 'Photo ajoutée avec succès.']);
    }

    /**
     * @Route("/image/{id}/like", name="like_image", methods={"POST"})
     */
    public function likeImage(string $id): JsonResponse
    {
        $collection = $this->getCollection('photos');

        try {
            $result = $collection->updateOne(['_id' => new ObjectId($id)], ['$inc' => ['likes' => 1]]);
            return new JsonResponse(['success' => $result->getModifiedCount() > 0]);
        } catch (\Exception $e) {
            return new JsonResponse(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * @Route("/image/{id}/comment", name="comment_image", methods={"POST"})
     */
    public function commentImage(string $id, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $comment = $data['comment'] ?? null;

        if (!$comment) {
            return new JsonResponse(['success' => false, 'message' => 'Le commentaire est requis.'], 400);
        }

        $collection = $this->getCollection('photos');

        try {
            $result = $collection->updateOne(['_id' => new ObjectId($id)], ['$push' => ['comments' => $comment]]);
            return new JsonResponse(['success' => $result->getModifiedCount() > 0]);
        } catch (\Exception $e) {
            return new JsonResponse(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}