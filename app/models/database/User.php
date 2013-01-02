<?php namespace nwt;

class UserRepository extends Repository
{
    public function findAuthors()
    {
        return $this->connection
            ->query('SELECT id, CONCAT_WS(" ", name, surname) FROM user as name')
            ->fetchPairs('id', 'name');
    }
}