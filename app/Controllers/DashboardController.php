<?php

namespace App\Controllers;

use App\Repositories\StatisticsRepository;

class DashboardController
{
    private $statsRepo;

    public function __construct(StatisticsRepository $statsRepo)
    {
        $this->statsRepo = $statsRepo;
    }
    public function index()
    {
        $totalCourses = $this->statsRepo->nombreTotaldeCours();
        $totalUsers = $this->statsRepo->nombreUsers();
        $totalEnrollments = $this->statsRepo->totalInsc();

        $enrollmentsPerCourse = $this->statsRepo->inscriptionsParCours();

        $popularCourse = $this->statsRepo->popularCourse();

        $avgSections = $this->statsRepo->moyenneSectionsCours();

        $heavyCourses = $this->statsRepo->coursRiche();

        $usersThisYear = $this->statsRepo->inscriptionsCetteAnne();

        $emptyCourses = $this->statsRepo->coursSansInscriptions();

        $latestEnrollments = $this->statsRepo->dernieresInscriptions();
        $usersSansUser = $this->statsRepo->userSansinscription();
        include "./resources/views/admin/stats_dashboard.php";
    }
}