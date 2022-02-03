<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Slope.php';

class SlopeRepository extends Repository
{

    public function getSlope(int $id): ?Slope
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.slope WHERE id= :id
        ');
        $stmt->bindParam(':email', $id, PDO::PARAM_INT);
        $stmt->execute();

        $slope = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($slope == false) {
            return null;
        }

        return new Slope(
            $slope['title'],
            $slope['description'],
            $slope['image']
        );
    }

    public function addSlope(Slope $slope): void
    {
        $date = new DateTime();
        $stmt = $this->database->connect()->prepare('
            INSERT INTO slopes (title, description, image)
            VALUES (?, ?, ?)
        ');

        //TODO you should get this value from logged user session
        $assignedById = 1;

        $stmt->execute([
            $slope->getTitle(),
            $slope->getDescription(),
            $slope->getImage(),
        ]);
    }

    public function getSlopes(): array
    {
        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM slopes;
        ');
        $stmt->execute();
        $slopes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($slopes as $slope) {
            $result[] = new Slope(
                $slope['title'],
                $slope['description'],
                $slope['image']
            );
        }

        return $result;
    }

}