<?php
$conn = new mysqli('localhost', 'akshat51_midone', '}sFu8-7&N_hc3!k', 'akshat51_midone');

date_default_timezone_set('Asia/Kolkata');

mysqli_query($conn,'SET character_set_results=utf8');

$arr =  array();
$arr1 =  array();
$arr['success']=0;

$qq = mysqli_query($conn,"SELECT * FROM jobs where status='Assign'");
if(mysqli_num_rows($qq)>0)
{
	$arr['success']=1;
	while($q1_data=mysqli_fetch_array($qq))
	{
	    $arr1['created_at']=$q1_data['created_at'];
        $arr1['job_ref_no']=$q1_data['job_ref_no'];
        $arr1['status']=$q1_data['status'];

        $future = date('Y-m-d H:i:s',strtotime('+24 hour',strtotime($q1_data['created_at'])));
        $arr1['future']=$future;

        $arr1['current']=date('Y-m-d H:i:s');
        if($future >= $arr1['current'])
        {
            $arr1['jobstatus']='1';
        }
        else
        {
            $arr1['jobstatus']='0';
            $qq = mysqli_query($conn,"UPDATE jobs set status='Pending' where id='".$q1_data['id']."'");
        }

        // $arr['wallet_detail'][]=$arr1;
		
	}
}
echo json_encode($arr); 	


?>