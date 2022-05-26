<?php

namespace Bizcloud\MVCTest;

use Bizcloud\MVCTest\CSVReader;

class Database
{

    public function readTable(string $tableName) : array
    {
        $reader = new CSVReader($tableName);
        return $reader->getFormattedData();
    }

    public function readFirstLine(string $tableName) : array
    {
        return $this->readTable($tableName)[0];
        
    }

    public function readLastLine(string $tableName) : array
    {
        $data = $this->readTable($tableName);
        return $data[count($data)];
        
    }

    public function findByColumnNum(string $text, int $columnNum) : array
    {

    }

    public function findByColumnName(string $text, string $columnName) : array
    {

    }

    public function writeLine(array $line)
    {

    }



}