<?php

namespace App\Repositories;

use Core\Database\EntityManager;
use App\Models\Section;

class SectionRepository
{
    private $pdo;
    private $em;

    public function __construct(\PDO $pdo, EntityManager $em)
    {
        $this->pdo = $pdo;
        $this->em = $em;
    }

    public function getAllWithCourse()
    {
        $sql = "SELECT s.*, c.title as course_title 
                FROM sections s 
                INNER JOIN courses c ON s.course_id = c.id 
                ORDER BY s.course_id, s.position";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Section::class);
    }
    public function getsectionWithCourse($id)
    {
        $sql = "SELECT s.*, c.title as course_title 
            FROM sections s 
            INNER JOIN courses c ON s.course_id = c.id 
            WHERE s.id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Section::class);
        return $stmt->fetch();
    }

    public function find($id)
    {
        return $this->em->find($id, Section::class);
    }

    public function insert(Section $section)
    {
        return $this->em->save($section);
    }

    public function delete($id)
    {
        return $this->em->delete($id, Section::class);
    }
    public function update(Section $section) {
        return $this->em->update($section);
    }    

    public function checkPosition($id, $course_id, $position)
    {
        $sql = "SELECT id FROM sections WHERE course_id = :course_id AND position = :position AND id != :id LIMIT 1";
        $stm = $this->pdo->prepare($sql);
        $stm->execute([':id' => $id, ':course_id' => $course_id, ':position' => $position]);
        return $stm->fetch();
    }
}
