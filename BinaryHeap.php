<?php 

class BinaryHeap {
	
	private $heap = array();
	
	private $type = null;
	
	public function __construct ($type = 'max') {
		if (strtolower($type) == 'max') {
			$this->type = 'maxHeap';
		} else if (strtolower($type) == 'min') {
			$this->type = 'minHeap';
		} else {
			throw new Exception("Unsupported type. Supported types include 'min' and 'max'");
		}
	}
	
	/**
	* Adds element maintanining 'min'/'max' heap
	* @param int|string $value 
	*/
	public function push ($value) {
		array_push($this->heap, $value);
		$this->orderUp(sizeof($this->heap) - 1);
	}
	
	/**
	* Removes top of the heap and readjusts the heap
	* @return int|string min or max element depending on the type of heap
	*/	
	public function pop () {
		if (!sizeof($this->heap)) { return false; }
		$last = sizeof($this->heap) - 1;
		$poppedValue = $this->heap[0];
		$this->heap[0] = $this->heap[$last];
		array_pop($this->heap);
		$this->orderDown(0);
		return $poppedValue;
	}
	
	/**
	* Returns current top of the heap
	* @return int|string min or max element depending on the type of heap
	*/	
	public function peek () {
		if (!sizeof($this->heap)) { return false; }
		return $this->heap[0];
	}
	
	/**
	* Puts an element in the right place of the heap from the bottom going up
	* @param int $child index of the child to reorder
	*/
	private function orderUp ($child) {
		if ($child == 0) { return; }
		if ($child == 1) { $parent = 0; }
		else { $parent = round(($child / 2) -1); }
		if ($this->heap[$parent] == $this->heap[$child]) { $this->pop(); }
		$shouldSwap = call_user_func_array(array($this, $this->type), array($parent, $child));
		if ($shouldSwap) {
			$this->swap($parent, $child);
			$this->orderUp($parent);
		}
	}
	
	/**
	* Puts an element in the right place of the heap from the top going down
	* @param int $parent index of the parent to reorder
	*/
	private function orderDown ($parent) {
		if ($parent == sizeof($this->heap) - 1) { return; }
		$child1 = ($parent*2) + 1;
		$child2 = $child1 + 1;
		$shouldSwap = $child1 < sizeof($this->heap) && call_user_func_array(array($this, $this->type), array($parent, $child1));
		$shouldSwap2 = $child2 < sizeof($this->heap) && call_user_func_array(array($this, $this->type), array($parent, $child2));
		if ($shouldSwap) {
			$this->swap($parent, $child1);
			$this->orderDown($child1);
		} else if ($shouldSwap2) {
			$this->swap($parent, $child2);
			$this->orderDown($child2);
		}
	}
	
	/**
	* Swaps two elements
	* @param int|string $item1 index of item to swap
	* @param int|string $item2 index of other item to swap
	*/
	private function swap ($item1, $item2) {
		$item1Value = $this->heap[$item1];
		$this->heap[$item1] = $this->heap[$item2];
		$this->heap[$item2] = $item1Value;
	}
	
	/**
	* Comparison function for a max heap
	* @param int|string $item1 index of item to compare
	* @param int|string $item2 index of second item to compare
	* @return bool - true if item1 is > item 2, false otherwise
	*/
	private function maxHeap ($item1, $item2) {
		return  $this->heap[$item2] > $this->heap[$item1];
	}
	
	/**
	* Comparison function for a min heap
	* @param int|string $item1 index of item to compare
	* @param int|string $item2 index of second item to compare
	* @return bool - true if item1 is < item2, false otherwise
	*/
	private function minHeap ($item1, $item2) {
		return $this->heap[$item2] < $this->heap[$item1];
	}
	
	/**
	* Prints the heap
	*/
	public function print() {
		var_dump($this->heap);
	}
	
}

 ?>
