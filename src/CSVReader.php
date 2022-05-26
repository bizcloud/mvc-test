<?php

namespace Bizcloud\MVCTest;

class CSVReader
{

    private string $filepath;

    public function __construct($filename)
    {
        $this->filepath = join(
            DIRECTORY_SEPARATOR,
            [
                __DIR__,
                '..',
                'data',
                $filename,
            ]
        );
    }


    public function readHeaders() : array
    {
        $f = fopen($this->filepath, 'r');
        if (!$f) {
            return;
        }
        $data = explode(',',fgetc($f));
        fclose($f);
        return $data;
    }

    public function readData() : array
    {
        $f = fopen($this->filepath, 'r');
        if (!$f) {
            return;
        }
        while (!feof($f)) {
            $lines[] = explode(',',fgetc($f));
        }
        fclose($f);
        return $lines;

    }

    public function getFormattedData()
    {
        $data = $this->readData();
        $headers = $this->readHeaders();
        $headerLength = count($headers);
        $dataLength = count($data);
        $formatted = [];
        for ($i = 1; $i <= $dataLength; $i++) {
            for ($k = 0; $k <= $headerLength; $k++) {
                $formatted[$i--][$headers[$k]]=$data[$i][$k];
            }
        }
        return $formatted;
    }

}