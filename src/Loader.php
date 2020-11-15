<?php

namespace App;

use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\YamlFileLoader;
use Symfony\Component\Serializer\NameConverter\MetadataAwareNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class Loader
{

    private string $dataFile;

    private string $dataClass;

    private Serializer $serializer;

    public function __construct(string $dataFile, string $dataClass)
    {
        // Load mapping between CSV and model class
        $classMetadataFactory = new ClassMetadataFactory(
            new YamlFileLoader(implode(DIRECTORY_SEPARATOR, [__DIR__, '..', 'config', 'metadata.yaml']))
        );

        // normalizers for symfony serializer object
        $normalizers = [
            new ArrayDenormalizer(),
            new ObjectNormalizer($classMetadataFactory, new MetadataAwareNameConverter($classMetadataFactory))
        ];

        $this->serializer = new Serializer($normalizers, [new CsvEncoder()]);
        $this->dataFile = $dataFile;
        $this->dataClass = $dataClass;
    }

    public function load(): array
    {
        return $this->serializer->deserialize($this->loadDataFile(), $this->dataClass . "[]", 'csv');
    }

    private function loadDataFile()
    {
        $file = implode(DIRECTORY_SEPARATOR, [__DIR__, '..', 'data', $this->dataFile]);
        if (file_exists($file)) {
            return file_get_contents($file);
        }
        throw new \InvalidArgumentException(sprintf("File %s not found.", $file));
    }

}
