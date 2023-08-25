<?php

namespace Retamayo\Absl\Classes;

use Retamayo\Absl\Traits\Query;
use Retamayo\Absl\Traits\ExceptionHandler;

/**
 * Class Auth
 * 
 * @package Retamayo\Absl\Classes
 */
class Auth
{

    /**
     * @trait Query
     * @trait ExceptionHandler
     */
    use Query;
    use ExceptionHandler;

    /**
     * @var PDO $connection
     * @var Table $table
     */
    public function __construct(
        private \PDO $connection,
        private Table $table,
        private string $userColumn,
        private string $tokenColumn,
        private array $session
    ) {}

    /**
     * Authenticates a user.
     * 
     * @param array $config
     * @param string $username
     * @param string $password
     * 
     * @return bool
     */
    public function authenticate(string $username, string $password): bool
    {
        $query = $this->authQuery($this->table->name, $this->userColumn);
        $statement = $this->connection->prepare($query);
        try {
            if (!$statement->execute([$username])) {
                throw new \Exception("Failed to execute auth query");
            }
            $data = $statement->fetch(\PDO::FETCH_ASSOC);
            if (empty($data)) {
                return false;
            } else {
                if (password_verify($password, $data[$this->tokenColumn])) {
                    $this->initSession($this->session, $data);
                    return true;
                } else {
                    return false;
                }
            }
        } catch (\PDOException $e) {
            $this->formatException($e);
        } catch (\Exception $e) {
            $this->formatException($e);
        }
    }

    /**
     * Initializes the session.
     * 
     * @param array $sessionData
     * @param array $data
     * 
     * @return void
     */
    private function initSession(array $session, array $data): void
    {
        try {
            if (empty($session)) {
                throw new \Exception("Session data is empty");
            } else {
                foreach ($session as $id) {
                    foreach ($data as $key => $value) {
                        if ($id === $key) {
                            $_SESSION[$id] = $value;
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            $this->formatException($e);
        }
    }
}
