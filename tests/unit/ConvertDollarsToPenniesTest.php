<?php

class ConvertDollarsToPenniesTest extends TestCase
{
    /** @test */
    public function convert_dollars_to_pennies()
    {
        $this->assertEquals(100, to_pennies("1"));
        $this->assertEquals(1200, to_pennies("12"));
        $this->assertEquals(12300, to_pennies("123"));
        $this->assertEquals(12345, to_pennies("123.45"));
        $this->assertEquals(12345, to_pennies("$123.45"));
        $this->assertEquals(1234567, to_pennies("$12,345.67"));
    }
}
