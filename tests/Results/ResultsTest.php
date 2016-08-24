<?php
class ResultsTest extends PHPUnit_Framework_TestCase
{

    public function testPrependToResults()
    {
        $results = new \TypeRocket\Database\Results();
        $results->prepend(true);

        $this->assertTrue( $results[0] );
    }

    public function testCastToResults()
    {
        // Test null
        $results = new \TypeRocket\Database\Results();
        $isNull = $results->castResults();

        $this->assertTrue( $isNull === null );

        // Test with custom model
        $results = new \TypeRocket\Database\Results();
        $results->prepend(['post_title' => 'New Post 1']);
        $results->prepend(['post_title' => 'New Post 2']);
        $results->class = \TypeRocket\Models\WPPost::class;
        $results->castResults();
        $object1 = $results[0];
        $object2 = $results[0];

        $r1 = $object1 instanceof \TypeRocket\Models\WPPost;
        $r2 = $object2 instanceof \TypeRocket\Models\WPPost;

        $this->assertTrue( $r1 );
        $this->assertTrue( $r2 );

        // test with custom property
        $results = new \TypeRocket\Database\Results();
        $results->prepend(['post_title' => 'New Post 1']);
        $results->class = \stdClass::class;
        $results->castResults();
        $this->assertTrue( $results[0] instanceof \stdClass );
    }

}