<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UploadAssetsToS3 extends Command
{
    protected $signature = 'assets:upload';
    protected $description = 'Upload all public/assets files to S3';

    public function handle()
    {
        $files = File::allFiles(public_path('assets'));

        foreach ($files as $file) {
            $relativePath = $file->getRelativePathname();
            Storage::disk('s3')->put(
                'assets/'.$relativePath,
                File::get($file->getPathname())// Make file publicly accessible
            );
            $this->info("Uploaded: $relativePath");
        }

        $this->info('All assets uploaded successfully!');
    }
}
