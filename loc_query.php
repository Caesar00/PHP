<?php
    include('library.php');
    $q = trim(urldecode($_GET['q']));
    $result = array();
    if ($q != '') 
    {
        try {
            $locs = json_decode(get_loc_info($q)); 
            foreach($locs as $loc)
            {
                if(property_exists($loc, 'label'))
                {
                    $label = $loc->label;
                    // $name = preg_replace("/\[[^)]+\]/", " ", $loc->container_name); 
                    // $result[$label] = $name;
                    array_push($result, $label);
                    }
                }
        } 
        catch (exception $e) {
            http_response_code(404);
        }
    }

    header('Content-type: application/json');
    echo json_encode($result);
?>
