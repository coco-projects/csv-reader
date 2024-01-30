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

        $data = $reader->readAll();

        var_export($reader->getHeader());

        print_r($data);

        $reader->close();
    }
    catch (\Coco\csvReader\Exceptions\FileException $e)
    {
    }