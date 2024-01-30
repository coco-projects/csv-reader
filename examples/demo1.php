<?php

    use Coco\csvReader\Reader;

    require '../vendor/autoload.php';

    $file = 'data/test.csv';

    $reader = new Reader();

    try
    {
        $reader->openFile($file, !true);

        $reader->setHeader([
            'id',
            'name',
            'age',
            'time',
            'region',
        ]);

        $reader->seek(3);

        $data = $reader->readAll();

        print_r($reader->getHeader());

        print_r($data);

        $reader->close();
    }
    catch (\Coco\csvReader\Exceptions\FileException $e)
    {
    }