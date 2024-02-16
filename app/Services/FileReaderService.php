<?php

namespace App\Services;

use App\Interfaces\ReaderInterface;
use Illuminate\Support\Facades\File;

class FileReaderService implements ReaderInterface
{
    private array $data;
    public string $path = '../public/files/affiliates.txt';

    public function read(): array
    {
        foreach (explode(PHP_EOL, File::get($this->path)) as $item) {
            if (!empty($item)) {
                $this->data[] = json_decode($item);
            }
        }

        return $this->data;
    }
}
