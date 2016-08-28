<?php

    function testTimeStamp($f_timestamp, $timeElipsed){
        $date = new DateTime();
		//echo "<br>" . $f_timestamp;
        $now =  $date->getTimestamp();
		//echo "<br>" . $now;
        $diff = $now - $f_timestamp;
		//echo "<br>" . $diff;
        if($diff<$timeElipsed){
			return true;
        }
        else{
			//echo "<br>" . $diff;
            return false;
        }
    } 
?>