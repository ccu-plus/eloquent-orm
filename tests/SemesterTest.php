<?php

namespace CCUPLUS\EloquentORM\Tests;

use CCUPLUS\EloquentORM\Semester;

class SemesterTest extends TestCase
{
    public function test_value_attribute()
    {
        Semester::query()->insert([
            ['id' => 1, 'name' => '101上'],
            ['id' => 2, 'name' => '100下'],
        ]);

        $this->assertNull((new Semester)->value);
        $this->assertSame('1011', Semester::query()->find(1)->value);
        $this->assertSame('1002', Semester::query()->find(2)->value);
    }

    public function test_newest_method()
    {
        Semester::query()->insert([
            ['name' => '101上'],
            ['name' => '100下'],
            ['name' => '101下'],
            ['name' => '100上'],
            ['name' => '102下'],
            ['name' => '99以前'],
            ['name' => '102上'],
        ]);

        $this->assertSame('102下', Semester::newest()->name);

        Semester::query()->insert(['name' => '103上']);

        $this->assertSame('103上', Semester::newest()->name);
    }
}
