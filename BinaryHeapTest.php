<?php 

include('./BinaryHeap.php');
use PHPUnit\Framework\TestCase;

class BinaryHeapTest extends TestCase {
	
	public function testCreateMaxHeap () {
		$BinaryHeap = new BinaryHeap();
		$this->assertTrue(is_a($BinaryHeap, 'BinaryHeap'));
	}
	
	public function testCreateMinHeap () {
		$BinaryHeap = new BinaryHeap('min');
		$this->assertTrue(is_a($BinaryHeap, 'BinaryHeap'));
	}
	
	public function testCreateWrongType () {
		$this->expectExceptionMessage("Unsupported type. Supported types include 'min' and 'max'");
		$BinaryHeap = new BinaryHeap('wrong');
	}
	
	public function testPush () {
		$BinaryHeap = new BinaryHeap('min');
		$BinaryHeap->push(5);
		$BinaryHeap->push(15);
		$this->assertTrue($BinaryHeap->peek() == 5);
		$BinaryHeap->push(3);
		$this->assertTrue($BinaryHeap->peek() == 3);
		$BinaryHeap->push(4);
		$this->assertTrue($BinaryHeap->peek() == 3);
		$BinaryHeap->push(1);
		$this->assertTrue($BinaryHeap->peek() == 1);
		$BinaryHeap->push(11);
		$this->assertTrue($BinaryHeap->peek() == 1);
	}
	
	public function testPop () {
		$BinaryHeap = new BinaryHeap('max');
		$BinaryHeap->push(5);
		$BinaryHeap->push(15);
		$this->assertEquals(15, $BinaryHeap->pop());
		$BinaryHeap->push(20);
		$BinaryHeap->push(3);
		$BinaryHeap->push(10);
		$BinaryHeap->push(8);
		$this->assertEquals(20, $BinaryHeap->pop());
		$this->assertEquals(10, $BinaryHeap->pop());
		$this->assertEquals(8, $BinaryHeap->pop());
		$this->assertEquals(5, $BinaryHeap->pop());
		$this->assertEquals(3, $BinaryHeap->pop());
		$this->assertEquals(null, $BinaryHeap->pop());
	}
	
}
