<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calendar extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('admin/additional_requests');
    }
    function index(){

		if (isset($_GET['year'])) {$year =$_GET['year']; 
		if ($year == '') { unset($year);}}
		if (isset($_GET['month'])) {$month =$_GET['month']; 
		if ($month == '') { unset($month);}}

    	$dates = $this->additional_requests->date_this_game($year, $month);
    	print_r($dates);




/*
			$select = 'SELECT dates';
			$from   = '  FROM arhiv';
			$where  = '  WHERE YEAR(dates)='.$year.' AND MONTH(dates)='.$month;
			$data = array();
			$i=0;
			$queryResult = @mysql_query($select . $from . $where);
			while($row=mysql_fetch_array($queryResult))
			    {  
			        $data[$i]=$row['dates'];
			        $i++;
			    }
			// преобрзование массива в данные json
			$resalt = json_encode($data);
			echo $resalt;
			 
			mysql_close($conn);
			*/
    }
}