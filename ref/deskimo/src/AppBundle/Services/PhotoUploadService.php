<?php

namespace AppBundle\Services;

use Gaufrette\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Gaufrette\Adapter\Local as LocalAdapter;


class PhotoUploadService
{
  const ALLOW_MIME_TYPES = array(
    'image/jpeg',
    'image/png',
    'image/jpeg'
  );

  private $filesystem;

  public function __construct(Filesystem $filesystem)
  {
    $this->filesystem = $filesystem;
  }

  public function upload(UploadedFile $file, $type = null, $allowMimeTypes = self::ALLOW_MIME_TYPES)
  {
    if (!$type) {
      throw new \InvalidArgumentException('Type is undefined');
    }
    // Check if the file's mime type is in the list of allowed mime types.
    if (!in_array($file->getClientMimeType(), $allowMimeTypes)) {
      throw new \InvalidArgumentException(sprintf('Files of type %s are not allowed.', $file->getClientMimeType()));
    }

    // Generate a unique filename based on the date and add file extension of the uploaded file
    $filename = sprintf('%s/%s/%s/%s/%s.%s', $type, date('Y'), date('m'), date('d'), uniqid(), $file->getClientOriginalExtension());

    $adapter = $this->filesystem->getAdapter();
    $adapter->write($filename, file_get_contents($file->getPathname()));
    return $filename;
  }

  public function remove($fileKey) {
    $adapter = $this->filesystem->getAdapter();
    $adapter->delete($fileKey);

    return $fileKey;
  }
}