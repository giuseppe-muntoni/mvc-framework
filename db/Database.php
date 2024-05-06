<?php

namespace giuseppemuntoni\mvc\db;

use giuseppemuntoni\mvc\Application;
use PDO;

/**
 * Class database
 *
 * @author Giuseppe Muntoni <g.muntoni.cs@gmail.com>
 * @package giuseppemuntoni\mvc
 */
class Database
{
    public PDO $pdo;

    public function __construct(array $config) {
        $dsn = $config['dsn'] ?? '';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';
        $this->pdo = new PDO($dsn, $user, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function applyMigrations()
    {
        $this->createMigrationTable();
        $appliedMigrations = $this->getAppliedMigrations();
        $files = scandir(Application::$ROOT_DIR.'/migrations');
        $toApplyMigrations = array_diff($files, $appliedMigrations);
        $newMigrations = [];

        foreach ($toApplyMigrations as $migration) {
            if ($migration === '.' || $migration === '..') {
                continue;
            }

            require_once(Application::$ROOT_DIR.'/migrations/'.$migration);
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $className();

            $this->log("Applying migration: $migration".PHP_EOL);
            $instance->up();
            $this->log("Applied migration: $migration".PHP_EOL);

            $newMigrations[] = $migration;
        }

        if (!empty($newMigrations)) {
            $this->saveMigrations($newMigrations);
        } else {
            $this->log("All migrations are applied".PHP_EOL);
        }
    }

    public function createMigrationTable()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
            id SERIAL PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );");
    }

    private function getAppliedMigrations()
    {
        $statement = $this->pdo->prepare("SELECT migration FROM migrations;");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_COLUMN);
    }

    private function saveMigrations(array $migrations)
    {
        $migrationsStr = implode(",", array_map(fn($migration) => "('$migration')", $migrations));

        $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES $migrationsStr");
        $statement->execute();
    }

    private function log($message)
    {
        echo "[" . date("Y-m-d H:i:s") . "] - " . $message . PHP_EOL;
    }
}