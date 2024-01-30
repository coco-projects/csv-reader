<?php

    use Coco\csvReader\Writer;

    require '../vendor/autoload.php';

    $file = 'data/test11.csv';

    $array = [
        [
            "id"     => 1,
            "name"   => "张三",
            "age"    => 27,
            "time"   => "2024-01-11",
            "region" => "北京",
        ],
        [
            "id"     => 2,
            "name"   => "李四",
            "age"    => 35,
            "time"   => "2024-01-11",
            "region" => "上海",
        ],
        [
            "id"     => 3,
            "name"   => "王五",
            "age"    => 42,
            "time"   => "2024-7-11",
            "region" => "广州",
        ],
        [
            "id"     => 4,
            "name"   => "赵六",
            "age"    => 18,
            "time"   => "2024-2-11",
            "region" => "成都",
        ],
        [
            "id"     => 5,
            "name"   => "陈七",
            "age"    => 31,
            "time"   => "2024-01-2",
            "region" => "深圳",
        ],
        [
            "id"     => 6,
            "name"   => "刘八",
            "age"    => 26,
            "time"   => "2024-01-6",
            "region" => "杭州",
        ],
        [
            "id"     => 7,
            "name"   => "黄九",
            "age"    => 39,
            "time"   => "2024-9-16",
            "region" => "重庆",
        ],
        [
            "id"     => 8,
            "name"   => "周十",
            "age"    => 23,
            "time"   => "2024-01-2",
            "region" => "天津",
        ],
        [
            "id"     => 9,
            "name"   => "吴十一",
            "age"    => 29,
            "time"   => "2024-01-4",
            "region" => "南京",
        ],
        [
            "id"     => 10,
            "name"   => "郑十二",
            "age"    => 37,
            "time"   => "2024-01-25",
            "region" => "武汉",
        ],
    ];

    $writer = new Writer();

    try
    {
        $writer->create($file);

        $writer->setHeader([
            'id',
            'name',
            'age',
            'time',
            'region',
        ]);

        $writer->writeHeader()->writeAll($array);

        $writer->close();
    }
    catch (\Coco\csvReader\Exceptions\FileException $e)
    {
    }