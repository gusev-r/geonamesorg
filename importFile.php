<?php
namespace Geonamesorg;
//namespace FileSystem;

class ImportFile {

    private $handle;

    public function openFile($file_name = 'test.txt') {
        return $this->handle = fopen($file_name, 'rt');
    }

    public function closeFile() {
        fclose($this->handle);
    }

    public function readLine() {
        if ($this->handle) {
            $return = array();
            if (($buffer = fgets($this->handle)) !== false) {
                $return = $this->lineProcessing($buffer);
                return $return;
            }
            return FALSE;
        }
    }

    public function readLines($count = 10, $keys) {
        $return = array();
        for ($index = 0; $index < $count; $index++) {
            if ($line = $this->readLine()) {
                $return[] = $this->implementLine($keys, $line);
            }
        }
        return $return;
    }

    private function implementLine(array $keys, array $values) {
        return array_combine($keys, $values);
    }

    public function readFile() {
        if ($this->handle) {
            $return = array();
            while (($buffer = fgets($this->handle)) !== false) {
                $return[] = $this->lineProcessing($buffer);
            }
            return $return;
        }
    }

    private function lineProcessing($line, $terminated = "\t") {
        $line = explode($terminated, $line);
        return $line;
    }

}
