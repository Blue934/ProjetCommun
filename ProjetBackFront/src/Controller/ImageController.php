<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// Le contrôleur "ImageController" permet de servir des images au client,
// tout en incluant des mécanismes de sécurité et des vérifications.
class ImageController extends AbstractController {
    /**
     * @Route("/image/{filename}", name="serve_image")
     */
    // Cette méthode "serveImage" est associée à la route "/image/{filename}".
    // Elle prend le nom d'un fichier en paramètre et retourne une réponse HTTP contenant l'image.
    public function serveImage(string $filename): Response {
        // Chemin complet vers l'image dans le dossier "uploads" du répertoire "public".
        $path = $this->getParameter('kernel.project_dir') . '/public/uploads/' . $filename;

        // **Validation du chemin** :
        // On utilise une expression régulière pour s'assurer que le nom de fichier ne contient que
        // des caractères autorisés (alphanumériques, traits d'union, underscores).
        // On vérifie également que le fichier n'accède pas à des répertoires parents ("../").
        if (!preg_match('/^[a-zA-Z0-9_\-.]+$/', $filename) || strpos($filename, '..') !== false) {
            // Si le nom est invalide, une exception est levée avec un message d'erreur.
            throw $this->createNotFoundException("Nom de fichier ou chemin invalide.");
        }

        // **Gestion des fichiers inexistants** :
        // Si le fichier demandé n'existe pas, on renvoie une image par défaut ("default.jpg").
        if (!file_exists($path)) {
            $path = $this->getParameter('kernel.project_dir') . '/public/uploads/default.jpg';
        }

        // **Validation du type MIME** :
        // On détermine le type MIME du fichier (par ex., "image/jpeg", "image/png").
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif']; // Types autorisés.
        $mimeType = mime_content_type($path);

        // Si le type MIME du fichier ne fait pas partie des types autorisés, une erreur est levée.
        if (!in_array($mimeType, $allowedTypes)) {
            throw $this->createNotFoundException("Type de fichier non autorisé.");
        }

        // **Construction de la réponse HTTP** :
        // On crée une réponse avec des en-têtes HTTP configurés, notamment pour indiquer le type MIME
        // et activer la mise en cache côté client (valable 3600 secondes).
        $response = new Response();
        $response->headers->set('Content-Type', $mimeType); // Définit le type MIME dans l'en-tête.
        $response->headers->set('Cache-Control', 'public, max-age=3600'); // Active le cache HTTP.
        $response->sendHeaders();

        // **Envoi du fichier au client** :
        // La fonction "readfile" lit le fichier et envoie directement son contenu au client.
        readfile($path);

        // Retourne la réponse HTTP complète.
        return $response;
    }
}