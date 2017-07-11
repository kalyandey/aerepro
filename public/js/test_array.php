<?php

function get_pdf_dimensions($path, $box="TrimBox") {
    //$box can be set to BleedBox, CropBox or MediaBox 

    $stream = new SplFileObject($path); 
   
    $result = false;

    while (!$stream->eof()) {
        
        if (preg_match("/".$box."\[[0-9]{1,}.[0-9]{1,} [0-9]{1,}.[0-9]{1,} ([0-9]{1,}.[0-9]{1,}) ([0-9]{1,}.[0-9]{1,})\]/", $stream->fgets(), $matches)) {
            $result["width"] = $matches[1];
            $result["height"] = $matches[2]; 
            break;
        }
    }

    $stream = null;

    return $result;
}

var_dump(get_pdf_dimensions("41da2c62e25a3ecc8ac5a0e1545176aa.pdf"));
exit;
?>




<?php

$abc[] = array('0'=>array('property_name'=>'Adelaide Backpackers Inn','bedrooms'=>17,'guest'=>4),'1'=>array('property_name'=>'Adelaide\'s Shakespeare International Backpackers','bedrooms'=>5,'guest'=>5),'2'=>array('property_name'=>'Backpack City and Surf','bedrooms'=>5,'guest'=>7));
print_r($abc);
exit;
?>










<?php
$currentTime = date("h:i:s a", strtotime('20:06:05'));
echo $currentTime;
exit;



$old = array('1','2','3','4','5');
$new = array('1','4','6','7');


$insert_array = array_diff($new,$old);
$delete_array = array_diff($old,$new);

print_r($insert_array);
print_r($delete_array);

?>
