<?php                
require 'database_connection.php'; 
$currentDate = date('Y-m-d');
$thirtyDaysLater = date('Y-m-d', strtotime('+30 days'));

$display_query = "select amcs.id,amcs.amc_type,amc_visit.visit_date,users.name from amcs inner join users on amcs._user_id =  users.id inner join `amc_visit` on `amc_visit`.`_amc_id` = `amcs`.`id` where `amc_visit`.`visit_date` between '".$currentDate."' and '".$thirtyDaysLater."'";     

$results = mysqli_query($con,$display_query);   
$count = mysqli_num_rows($results);  
if($count>0) 
{
	$data_arr=array();
    $i=1;
	while($data_row = mysqli_fetch_array($results, MYSQLI_ASSOC))
	{	
		// $addrescs = "select GROUP_CONCAT(location_type) AS addresses from `customer_details` where FIND_IN_SET(id, '".$data_row['_customer_details_id']."') > 0 limit 1";
		// $results1 = mysqli_query($con,$addrescs);  
		// $data_row1 = mysqli_fetch_array($results1);
		// $string = $data_row['_customer_details_id'];
		// $variableAry=explode(",",$string); 
		// $location = "";
		// foreach($variableAry as $value) 
        // {
		// 	$counnt = "select * from `customer_details` where id = '".$value."')";
		// 	$results2 = mysqli_query($con,$counnt); 
		// 	$count = mysqli_num_rows($results2);  
		// 	if($count > 0)
		// 	{
		// 		$customerDetailsname = "select * from `customer_details` where id = '".$value."' limit 1)";
		// 		$results3 = mysqli_query($con,$customerDetailsname); 
		// 		$data_row3 = mysqli_fetch_array($results3);

		// 		$location = $data_row3['location_type'].',';
		// 	}
		// 	else
		// 	{
		// 		$location = "";
		// 	}
		// }

	$data_arr[$i]['event_id'] = $data_row['amc_type'];
	$data_arr[$i]['title'] = $data_row['name'].'('.$data_row['amc_type'].')';
	$data_arr[$i]['start'] = date("Y-m-d", strtotime($data_row['visit_date']));
	$data_arr[$i]['end'] = date("Y-m-d", strtotime($data_row['visit_date']));
	$data_arr[$i]['color'] = '#'.substr(uniqid(),-6); // 'green'; pass colour name
	$data_arr[$i]['url'] = '';
	$i++;
	}
	
	$data = array(
                'status' => true,
                'msg' => 'successfully!',
				'data' => $data_arr
            );
}
else
{
	$data = array(
                'status' => false,
                'msg' => 'Error!'				
            );
}
echo json_encode($data);
?>