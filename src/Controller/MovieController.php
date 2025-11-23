<?php

namespace App\Controller;

use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    #[Route('/movies', name: 'movies_list')]
    public function list(MovieRepository $movieRepo): Response
    {
        $movies = $movieRepo->findAll();

        return $this->render('movie/list.html.twig', [
            'movies' => $movies
        ]);
    }

    #[Route('/movies/{id}', name: 'movie_show')]
    public function show(int $id, MovieRepository $movieRepo): Response
    {
        $movie = $movieRepo->find($id);

        if (!$movie) {
            throw $this->createNotFoundException("Movie not found");
        }

        return $this->render('movie/show.html.twig', [
            'movie' => $movie
        ]);
    }
}
