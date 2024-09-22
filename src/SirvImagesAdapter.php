<?php

declare(strict_types=1);

namespace Lipit146\FilesystemSirv;

use SirvClient;
use Lipit146\FilesystemSirv\Exceptions\MethodNotAvailable;

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

    public function directoryExists(string $path): bool
    {
        throw MethodNotAvailable::throw('directoryExists');
    }

    public function deleteDirectory(string $path): void
    {
        throw MethodNotAvailable::throw('deleteDirectory');
    }

    public function createDirectory(string $path, Config $config): void
    {
        throw MethodNotAvailable::throw('deleteDirectory');
    }

    public function files(string $folder = null): array
    {
        $result = [];
        $items = $this->sirvClient->getBucketContents($folder);
        if ($folder && $items['contents'] && $items['current_dir'] != '') {
            $result = array_filter($items['contents'], function ($item) {
                return $item['Size'] !== "0";
            });
        }
        return $result ?: $items;
    }

    public function get(string $file): string
    {
        return $this->sirvClient->getFile($file);
    }

    public function put($sirv_path, $fs_path): array
    {
        return $this->sirvClient->uploadFile($sirv_path, $fs_path);
    }

    public function delete(string $file): bool
    {
        return $this->sirvClient->deleteFile($file);
    }

    public function directories($prefix = null, $marker = null, $delimeter = null, $max_keys = null): array
    {
        return $this->sirvClient->getBucketContents($prefix, $marker, $delimeter, $max_keys);
    }
}
