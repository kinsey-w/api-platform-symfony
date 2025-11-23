<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Movie;
use App\Entity\User;
use App\Entity\Media;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher
    ) {}

    public function load(ObjectManager $manager): void
    {
        // --- DEFINE MOVIES + CATEGORY ---
        $Movies = [
            [
                'title' => 'The Dark Knight',
                'year' => 2008,
                'rating' => 9.0,
                'duration' => 152,
                'synopsis' => 'Batman faces the Joker, a criminal mastermind who unleashes chaos on Gotham.',
                'category' => 'Action',
                'poster' => 'https://static.wikia.nocookie.net/batman/images/3/38/The_Dark_Knight_poster6.jpg/revision/latest?cb=20160504033320'
            ],
            [
                'title' => 'Inception',
                'year' => 2010,
                'rating' => 8.8,
                'duration' => 148,
                'synopsis' => 'A thief enters dreams to steal secrets but gets tasked with planting an idea.',
                'category' => 'Sci-Fi',
                'poster' => 'https://m.media-amazon.com/images/M/MV5BMTM0MjUzNjkwMl5BMl5BanBnXkFtZTcwNjY0OTk1Mw@@._V1_.jpg'
            ],
            [
                'title' => 'Forrest Gump',
                'year' => 1994,
                'rating' => 8.8,
                'duration' => 142,
                'synopsis' => 'A slow-witted but kind-hearted man experiences key moments in U.S. history.',
                'category' => 'Drama',
                'poster' => 'https://resizing.flixster.com/hqcqFfWf1syt2OrGlbW7LDvfj9Y=/fit-in/352x330/v2/https://resizing.flixster.com/-XZAfHZM39UwaGJIFWKAE8fS0ak=/v3/t/assets/p15829_v_v13_aa.jpg'
            ],
            [
                'title' => 'Interstellar',
                'year' => 2014,
                'rating' => 8.6,
                'duration' => 169,
                'synopsis' => 'A team of explorers travels through a wormhole to save humanity.',
                'category' => 'Sci-Fi',
                'poster' => 'https://m.media-amazon.com/images/M/MV5BYzdjMDAxZGItMjI2My00ODA1LTlkNzItOWFjMDU5ZDJlYWY3XkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg'
            ],
            [
                'title' => 'The Fellowship of the Ring',
                'year' => 2001,
                'rating' => 8.8,
                'duration' => 178,
                'synopsis' => 'Frodo begins his journey to destroy the One Ring with the Fellowship.',
                'category' => 'Fantasy',
                'poster' => 'https://resizing.flixster.com/-XZAfHZM39UwaGJIFWKAE8fS0ak=/v3/t/assets/p28828_p_v8_ao.jpg'
            ],
            [
                'title' => 'Pulp Fiction',
                'year' => 1994,
                'rating' => 8.9,
                'duration' => 154,
                'synopsis' => 'Interconnected stories of crime, humor, and unexpected twists.',
                'category' => 'Drama',
                'poster' => 'https://www.filmsite.org/posters/pulpfiction.jpg'
            ],
            [
                'title' => 'Gladiator',
                'year' => 2000,
                'rating' => 8.5,
                'duration' => 155,
                'synopsis' => 'A betrayed Roman general seeks revenge against the corrupt emperor.',
                'category' => 'Action',
                'poster' => 'https://www.moxiecinema.com/uploads/films/_cover/Gladiator-poster.jpg'
            ],
            [
                'title' => 'Avatar',
                'year' => 2009,
                'rating' => 7.8,
                'duration' => 162,
                'synopsis' => 'A paraplegic Marine becomes part of the Na\'vi world on Pandora.',
                'category' => 'Fantasy',
                'poster' => 'https://resizing.flixster.com/8q56_2zGxyG40k_hyrNN_skhktg=/fit-in/705x460/v2/https://resizing.flixster.com/qCUBLUkkmfT_860tQdM9EzXNDZI=/ems.cHJkLWVtcy1hc3NldHMvbW92aWVzL2ZlYTY4ZDE4LWFmMGMtNGM3OC04YjYzLWE1NDg5MjliOWQxMS53ZWJw'
            ],
            [
                'title' => 'The Matrix',
                'year' => 1999,
                'rating' => 8.7,
                'duration' => 136,
                'synopsis' => 'A hacker learns the truth about reality and his role in humanity\'s fate.',
                'category' => 'Sci-Fi',
                'poster' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSjIW_4iSH-IBf17zN589Kf51duvtyOX5T5-g&sg'
            ],
            [
                'title' => 'Titanic',
                'year' => 1997,
                'rating' => 7.9,
                'duration' => 195,
                'synopsis' => 'A love story unfolds aboard the doomed RMS Titanic.',
                'category' => 'Drama',
                'poster' => 'https://fr.web.img6.acsta.net/c_310_420/pictures/23/01/10/16/06/0622119.jpg'
            ],
            [
                'title' => 'Joker',
                'year' => 2019,
                'rating' => 8.4,
                'duration' => 122,
                'synopsis' => 'The origin story of the iconic Batman villain.',
                'category' => 'Drama',
                'poster' => 'https://m.media-amazon.com/images/M/MV5BNGI2NTM3NTYtNzViYy00NzNlLTgxMTktYjA2MWI4YmI5NDgxXkEyXkFqcGc@._V1_.jpg'
            ],
            [
                'title' => 'La La Land',
                'year' => 2016,
                'rating' => 8.0,
                'duration' => 128,
                'synopsis' => 'A jazz pianist and actress pursue dreams in Los Angeles.',
                'category' => 'Comedy',
                'poster' => 'https://m.media-amazon.com/images/M/MV5BM2JlYjE4YWYtMTA3MC00YTAwLTg3OGMtZjQxMjQzMGM3M2U0XkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg'
            ],
            [
                'title' => 'Dune',
                'year' => 2021,
                'rating' => 8.0,
                'duration' => 155,
                'synopsis' => 'Paul Atreides navigates destiny on the desert planet Arrakis.',
                'category' => 'Sci-Fi',
                'poster' => 'https://fr.web.img6.acsta.net/pictures/21/08/10/12/20/4633954.jpg'
            ],
            [
                'title' => 'The Avengers',
                'year' => 2012,
                'rating' => 8.0,
                'duration' => 143,
                'synopsis' => 'Earth\'s mightiest heroes unite to face a global threat.',
                'category' => 'Action',
                'poster' => 'https://fr.web.img3.acsta.net/medias/nmedia/18/85/31/58/20042068.jpg'
            ],
            [
                'title' => 'The Lion King',
                'year' => 1994,
                'rating' => 8.5,
                'duration' => 88,
                'synopsis' => 'Simba must embrace his destiny as king of the Pride Lands.',
                'category' => 'Adventure',
                'poster' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQiD42NXN2uQLPCdnNgWvgaC6rc2BSBXOBzkA&s'
            ],
        ];

        // --- CREATE CATEGORY ENTITIES ---
        $categories = [];
        $categoryNames = ['Action', 'Drama', 'Comedy', 'Sci-Fi', 'Adventure', 'Fantasy'];

        foreach ($categoryNames as $name) {
            $cat = new Category();
            $cat->setName($name);
            $manager->persist($cat);
            $categories[$name] = $cat; // key by name for accuracy
        }

        // Make sure upload folder exists
        if (!is_dir('public/uploads')) {
            mkdir('public/uploads', 0777, true);
        }

        // --- CREATE MOVIES ---
        foreach ($Movies as $data) {

            $movie = new Movie();
            $movie->setTitle($data['title']);
            $movie->setSynopsis($data['synopsis']);
            $movie->setReleaseDate(new \DateTime($data['year'] . '-01-01'));
            $movie->setDuration($data['duration']);
            $movie->setRating($data['rating']);
            $movie->setCategory($categories[$data['category']]);

            $manager->persist($movie);

            // --- DOWNLOAD POSTER ---
            $filename = uniqid() . '.jpg';
            $savePath = 'public/uploads/' . $filename;

            $context = stream_context_create([
                'ssl' => [
                    'verify_peer'      => false,
                    'verify_peer_name' => false,
                ],
            ]);

            $imageData = @file_get_contents($data['poster'], false, $context);
            if ($imageData === false) {
                $imageData = @file_get_contents('https://placehold.co/600x400.jpg', false, $context);
            }

            file_put_contents($savePath, $imageData);

            // create Media object
            $media = new Media();
            $media->setFilePath($filename);
            $media->setMovie($movie);
            $manager->persist($media);
        }

        // --- CREATE USERS ---
        $admin = new User();
        $admin->setEmail("admin@example.com");
        $admin->setFirstname("Admin");
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->passwordHasher->hashPassword($admin, "admin123"));
        $manager->persist($admin);

        $user = new User();
        $user->setEmail("user@example.com");
        $user->setFirstname("User");
        $user->setRoles(['ROLE_USER']);
        $user->setPassword($this->passwordHasher->hashPassword($user, "user123"));
        $manager->persist($user);

        $manager->flush();
    }
}
