<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use LaravelDoctrine\ORM\Serializers\ArrayEncoder;
use Symfony\Component\Serializer\Encoder\JsonDecode;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;
use Symfony\Component\Serializer\Serializer;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    protected function deserialize($content, $class, $type = 'json', $context = [])
    {
        $encoders = [new JsonEncoder()];
        $serializers = [new PropertyNormalizer(null, new CamelCaseToSnakeCaseNameConverter())];
        $serializer = new Serializer($serializers, $encoders);
        return $serializer->deserialize($content, $class, $type, $context);
    }

    protected function serialize($data, $type = 'array', $context = [])
    {
        $encoders = [new JsonEncoder(), new ArrayEncoder()];
        $normalizer = new ObjectNormalizer();
        $serializers = [$normalizer];
        $serializer = new Serializer($serializers, $encoders);
        return $serializer->serialize($data, $type, $context);
    }
}
