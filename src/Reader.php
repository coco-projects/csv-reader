<?php

    namespace Coco\csvReader;

    use Coco\csvReader\Exceptions\FileException;

    /**
     * CSV Reader class. Object-oriented way of reading CSV files.
     */
class Reader extends AbstractCsv
{
    /**
     * Open CSV file for reading
     *
     * @param string $file File name with path to open
     * @param string $mode @link http://php.net/manual/en/function.fopen.php
     *
     * @return $this
     * @throws FileException
     */
    public function openFile(string $file, bool $withHeader = false, string $mode = 'r+'): static
    {
        if (!file_exists($file)) {
            throw new FileException('CSV file does not exist');
        }

        parent::open($file, $mode);

        if ($withHeader) {
            if (ftell($this->handle) == 0) {
                $this->header = $this->read();
            }
        }

        return $this;
    }

    /**
     * Read current line from CSV file
     *
     * @return array|false
     */
    public function readLine(): bool|array
    {
        $line = $this->read();

        if ($line === false) {
            return false;
        }

        $out = [];

        foreach ($line as $columnNo => $value) {
            $out[$columnNo] = $value;
        }

        if (is_array($this->header) && is_array($out)) {
            $out = array_combine($this->header, $out);
        }

        return $out;
    }

    /**
     * Read all lines from CSV file
     *
     * @return array
     */
    public function readAll(): array
    {
        $out = [];
        while (($row = $this->readLine()) !== false) {
            $out[] = $row;
        }

        return $out;
    }

    public function seek($offset): static
    {
        for ($i = 0; (($this->readLine()) !== false) && $i < $offset; $i++) {}

        return $this;
    }

    /**
     * Wrapper for fgetcsv function
     *
     * @return array|null|false
     */
    private function read(): bool|array|null
    {
        $out = fgetcsv($this->handle, null, $this->delimiter, $this->enclosure);

        if (!is_array($out)) {
            return $out;
        }

        if ($this->encodingFrom !== null && $this->encodingTo !== null) {
            foreach ($out as $k => $v) {
                $out[$k] = mb_convert_encoding($v, $this->encodingTo, $this->encodingFrom);
            }
        }

        return $out;
    }
}
