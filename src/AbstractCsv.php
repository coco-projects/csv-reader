<?php

    namespace Coco\csvReader;

    /**
     * Class AbstractCsv
     */
abstract class AbstractCsv
{
    protected string      $delimiter;
    protected string      $enclosure;
    protected string      $escape;
    protected string|null $encodingFrom = null;
    protected string|null $encodingTo   = null;
    protected $handle       = null;
    protected ?array      $header       = null;

    /**
     * @param string $delimiter @link http://php.net/manual/en/function.fgetcsv.php
     * @param string $enclosure @link http://php.net/manual/en/function.fgetcsv.php
     * @param string $escape    @link http://php.net/manual/en/function.fgetcsv.php
     */
    public function __construct(string $delimiter = ',', string $enclosure = '"', string $escape = '\\')
    {
        $this->delimiter = $delimiter;
        $this->enclosure = $enclosure;
        $this->escape    = $escape;
    }

    /**
     *
     * @return bool|array|null
     */
    public function getHeader(): bool|array|null
    {
        return $this->header;
    }

    public function setHeader(array $header): static
    {
        $this->header = $header;

        return $this;
    }

    public function encoding(string $encodingFrom, string $encodingTo): static
    {
        $this->encodingFrom = $encodingFrom;
        $this->encodingTo   = $encodingTo;

        return $this;
    }

    protected function open(string $file, string $mode): static
    {
        $this->handle = fopen($file, $mode);

        return $this;
    }

    /**
     * Close file pointer
     */
    public function close(): static
    {
        fclose($this->handle);

        return $this;
    }
}
