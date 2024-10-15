<?php
class month{
	private $month_no;
	private $month_name;
	
	public function prnMonth() {
		$month = array(1=>"January","February","March","April","May", "June", "July", "August", "September","October","November","December");
		foreach ($month as $month_no => $month_name){
			$sess = "<option value = '$month_no'>$month_name</option>";
			echo $sess;
		}
	}
}

class year{
	private $year = 1999;
	private $year2;
	
	public function prnYear() {
		$this->setYear2();
		
		for ($this->year2; $this->year2 >= $this->year; $this->year2--){
			$y = $this->year2;
			$sess = "<option value = '$y'>$y</option>";
			echo $sess;
		}
	}
	
	private function setYear2(){
		$tday = date('Y') + 1;
		$this->year2 = $tday;
	}
}
?>