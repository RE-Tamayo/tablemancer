<?php

namespace Retamayo\Tablemancer\Classes;

use Retamayo\Tablemancer\Exceptions\AuthenticationException;
use Retamayo\Tablemancer\Traits\ExceptionFormatter;
use Retamayo\Tablemancer\Traits\QueryBuilder;

/**
 * Class Authentication
 * 
 * @package Retamayo\Tablemancer\Classes
 */
class Authentication
{

    /**
     * @trait QueryBuilder
     * @trait ExceptionFormatter
     */
    use QueryBuilder;
    use ExceptionFormatter;

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
     * 
     * @throws AuthenticationException
     */
    public function authenticate(string $username, string $password): bool
    {
        $query = $this->existsQuery($this->table->name, $this->userColumn);
        $statement = $this->connection->prepare($query);
        try {
            if (!$statement->execute([$username])) {
                throw new AuthenticationException("Failed to execute auth query");
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
        } catch (AuthenticationException $e) {
            $this->formatException($e);
            exit();
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
                throw new AuthenticationException("Session data is empty");
            } else {
                foreach ($session as $id) {
                    foreach ($data as $key => $value) {
                        if ($id === $key) {
                            $_SESSION[$id] = $value;
                        }
                    }
                }
            }
        } catch (AuthenticationException $e) {
            $this->formatException($e);
            exit();
        }
    }
}
