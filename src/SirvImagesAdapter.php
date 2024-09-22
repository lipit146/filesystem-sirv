<?php

declare(strict_types=1);

namespace Lipit146\FilesystemSirv;

use Carbon\Carbon;
use League\Flysystem\FilesystemAdapter;
use SirvClient;

class SirvImagesAdapter
{
    private $sirvClient;

    public function __construct($config)
    {
        require('SirvClient.php');
        $this->sirvClient = new SirvClient(
            $config['bucket'],
            $config['key'],
            $config['secret'],
        );
    }

    public function get($file): string
    {
        return $this->sirvClient->getFile($file);
    }

    public function put($sirv_path, $fs_path): array
    {
        return $this->sirvClient->uploadFile($sirv_path, $fs_path);
    }

    public function delete($file): bool
    {
        return $this->sirvClient->deleteFile($file);
    }

    public function directories($prefix = null, $marker = null, $delimeter = null, $max_keys = null): array
    {
        return $this->sirvClient->getBucketContents($prefix = null, $marker = null, $delimeter = null, $max_keys = null);
    }
}
