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
}