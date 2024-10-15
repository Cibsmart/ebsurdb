<?php
class sess{
	private $year = 1999;
	private $year2;
	
	public function prnSess() {
		$this->setYear2();
		
		for ($this->year2; $this->year2 >= $this->year; $this->year2--){
			$y = $this->year2;
			$ses = --$y . "/" . $this->year2;
			$sess = "<option value = '$ses'>$ses</option>";
			echo $sess;
		}
	}
	
	private function setYear2(){
		$tday = date('Y') + 1;
		$this->year2 = $tday;
	}
}
?>