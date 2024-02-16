<?php

namespace Tests\Feature;

use App\Services\FileReaderService;
use Tests\TestCase;

class FileReaderServiceTest extends TestCase
{
    public function test_reading_file_successfully(): void
    {
        $file = New FileReaderService();
        $file->path = substr($file->path, 3);

        $this->assertFileExists($file->path);
        $this->assertSame(32, count($file->read()));
    }

    public function test_file_not_exist(): void
    {
        $this->assertFileDoesNotExist('public/files/affiliates.json');
    }
}
