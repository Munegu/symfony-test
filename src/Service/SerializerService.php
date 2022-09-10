<?php

namespace App\Service;

use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;
use Symfony\Component\Serializer\Serializer;

class SerializerService
{
    public function getSerializer(): Serializer
    {
        $extractor = new PropertyInfoExtractor([], [new PhpDocExtractor(), new ReflectionExtractor()]);
        $encoder = [
            new XmlEncoder(),
        ];
        $normalizer = [
            new ArrayDenormalizer(),
            new ObjectNormalizer(null, new CamelCaseToSnakeCaseNameConverter(), null, $extractor),
            new PropertyNormalizer(null, new CamelCaseToSnakeCaseNameConverter(), new ReflectionExtractor()),
            new DateTimeNormalizer(),
        ];

        return new Serializer($normalizer, $encoder);
    }
}