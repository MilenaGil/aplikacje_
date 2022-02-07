<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{

    public function getUser(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.users 
            LEFT JOIN profiles on users.id=profiles.id_user
            WHERE email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return null;
        }

        return new User(
            $user['email'],
            $user['password'],
            $user['name'],
            $user['surname'],
            $user['nickname']
        );
    }

    public function addUser(User $user): void
    {

        $stmt = $this->database->connect()->prepare('
            call adduser(?, ?, ?, ?, ?);
        ');

        $stmt->execute([
            $user->getEmail(),
            $user->getPassword(),
            $user->getName(),
            $user->getSurname(),
            $user->getNickname()
        ]);
    }

    public function creatSession(User $user): string
    {
        $stmt = $this->database->connect()->prepare('
            select session_start(?);
        ');

        $stmt->execute([
            $user->getEmail()
        ]);


        $idSession= $stmt->fetch(PDO::FETCH_ASSOC)['session_start'];
        return $idSession;
    }

    public function getUserfromSession(string $id_session): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM users JOIN session on users.id=session.id_user 
                JOIN profiles on users.id=profiles.id_user WHERE id_session=?;
        ');

        $stmt->execute([
            $id_session
        ]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return null;
        }

        return new User(
            $user['email'],
            $user['password'],
            $user['name'],
            $user['surname'],
            $user['nickname']
        );
    }

    public function isValidSession(string $id_session): bool
    {
        return !(is_null($this->getUserfromSession($id_session)));
    }

    public function deleteSession(string $id_session): void
    {
        $stmt = $this->database->connect()->prepare('
            DELETE FROM session WHERE id_session = ?
        ');
        $stmt->execute([
            $id_session
        ]);
    }
}