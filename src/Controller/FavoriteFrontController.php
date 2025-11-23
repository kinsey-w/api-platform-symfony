<?php

namespace App\Controller;

use App\Entity\Movie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FavoriteFrontController extends AbstractController
{
    #[Route('/favorite/{movieId}', name: 'toggle_favorite_front')]
    public function toggle(int $movieId, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();

        if (!$user) {
            return $this->redirectToRoute('login');
        }

        $movie = $em->getRepository(Movie::class)->find($movieId);

        if (!$movie) {
            throw $this->createNotFoundException('Movie not found');
        }

        if ($user->getFavorites()->contains($movie)) {
            $user->removeFavorite($movie);
        } else {
            $user->addFavorite($movie);
        }

        $em->flush();

        return $this->redirectToRoute('movie_show', ['id' => $movieId]);
    }
}
