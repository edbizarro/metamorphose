<?php

namespace PowerDataHub\Metamorphose\Tests;

use PowerDataHub\Metamorphose\Metamorphose;
use PowerDataHub\Metamorphose\Transformers\TrimTransformer;

class MetamorphoseTest extends TestCase
{
    /** @test */
    public function it_can_transform()
    {
        $result = app(Metamorphose::class)
            ->from(' John Doe ')
            ->through($this->defaultTransformers())
            ->transform();

        $this->assertEquals('John Doe', $result);
    }

    /** @test */
    public function it_can_transform_with_source()
    {
        $result = app(Metamorphose::class)
            ->from([
                'sessions' => '100',
            ])
            ->sourceType('ga')
            ->through(
                $this->defaultTransformers(),
                $this->sourcesTransformersWithDuplicates()
            )
            ->transform();

        $this->assertTrue(is_numeric($result['sessions']));
        $this->assertEquals(100, $result['sessions']);
    }

    /** @test */
    public function it_can_transform_with_source_duplicated()
    {
        $data = [
            'sessions' => '124334',
            'users' => '1987',
            'clicks' => '923743',
            'avgSessionDuration' => '7896',
        ];

        $result = app(Metamorphose::class)
            ->from($data)
            ->sourceType('ga')
            ->through(
                $this->defaultTransformers(),
                $this->sourcesTransformersWithDuplicates()
            )
            ->transform();

        foreach ($data as $key => $item) {
            $this->assertTrue(is_numeric($result[$key]));
            $this->assertEquals((integer) $item, $result[$key]);
        }
    }


    /** @test */
    public function it_can_transform_with_transformers_passed_as_string()
    {
        $result = app(Metamorphose::class)
            ->from([
                'sessions' => ' 100 ',
            ])
            ->sourceType('ga')
            ->through(TrimTransformer::class)
            ->transform();

        $this->assertEquals(100, $result['sessions']);
    }

    /** @test */
    public function it_can_transform_an_array()
    {
        $result = app(Metamorphose::class)
            ->from([
                'name' => ' John Doe ',
                'email' => ' johndoe@gmail.com ',
            ])
            ->through($this->defaultTransformers())
            ->transform();

        $this->arrayHasKey('name', $result);
        $this->assertEquals('John Doe', $result['name']);
        $this->assertEquals('johndoe@gmail.com', $result['email']);
    }
}
