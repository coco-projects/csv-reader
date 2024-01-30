<?php

    namespace Coco\csvReader;

    /**
     * @license https://github.com/wilgucki/dbrepository/blob/master/LICENSE
     * @link    https://github.com/wilgucki/csv
     */
class Writer extends AbstractCsv
{

    /**
     * Open CSV file for writing.
     *
     * @param string $file File name for writing CSV data. If not provided CSV data will be written to memory
     * @param string $mode @link http://php.net/manual/en/function.fopen.php
     *
     * @return $this
     */
    public function create(string $file = 'php://memory', string $mode = 'w+'): static
    {
        parent::open($file, $mode);

        return $this;
    }

    /**
     * Write line to CSV file.
     *
     * @param array $row
     *
     * @return bool|int
     */
    public function writeLine(array $row): bool|int
    {
        return $this->write($row);
    }

    /**
     * Write all lines to CSV file
     *
     * @param array $data
     *
     * @return Writer
     */
    public function writeAll(array $data): static
    {
        foreach ($data as $i => $row) {
            $this->writeLine($row);
        }

        return $this;
    }

    public function writeHeader(): static
    {
        $this->header and $this->writeLine($this->header);

        return $this;
    }

    /**
     * Output all written data as string.
     *
     * @return string
     */
    public function flush(): string
    {
        rewind($this->handle);

        $out = stream_get_contents($this->handle);
        fseek($this->handle, 0, SEEK_END);

        return $out;
    }

    /**
     * Wrapper for fputcsv function
     *
     * @param array $row
     *
     * @return bool|int
     */
    private function write(array $row): bool|int
    {
        if ($this->encodingFrom !== null && $this->encodingTo !== null) {
            foreach ($row as $k => $v) {
                $row[$k] = iconv($this->encodingFrom, $this->encodingTo, $v);
            }
        }

        return fputcsv($this->handle, $row, $this->delimiter, $this->enclosure, $this->escape);
    }
}
