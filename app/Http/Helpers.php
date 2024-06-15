<?php
//Use Image;

if (!function_exists('merge')) {
    function merge($arrays)
    {
        $result = [];

        foreach ($arrays as $array) {
            if ($array !== null) {
                if (gettype($array) !== 'string') {
                    foreach ($array as $key => $value) {
                        if (is_integer($key)) {
                            $result[] = $value;
                        } elseif (isset($result[$key]) && is_array($result[$key]) && is_array($value)) {
                            $result[$key] = merge([$result[$key], $value]);
                        } else {
                            $result[$key] = $value;
                        }
                    }
                } else {
                    $result[count($result)] = $array;
                }
            }
        }

        return join(" ", $result);
    }
}

if (!function_exists('uncamelize')) {
    function uncamelize($camel, $splitter = "_")
    {
        $camel = preg_replace('/(?!^)[[:upper:]][[:lower:]]/', '$0', preg_replace('/(?!^)[[:upper:]]+/', $splitter . '$0', $camel));
        return strtolower($camel);
    }
}

// function resizeImage($image,$path)
// {
   
//       $image = $image;    
//       $fileName = rand(111111,999999).time().'.'.$image->getClientOriginalExtension(); 
//       $destinationPath = public_path($path);
//       $img = Image::make($image->getRealPath());
//       $img->resize(500, 500, function ($constraint) {
//           $constraint->aspectRatio();
//       })->save($destinationPath.'/'.$fileName);

//       return $fileName;
 
//     //   $destinationPath = public_path($path);
//     //   $image->move($destinationPath, $input['imagename']);

// }




function getAddressFromLatLong($latLong, $apiKey)
{
    // Split the latitude and longitude values
    $latLongArray = explode(',', $latLong);
    $lat = $latLongArray[0];
    $long = $latLongArray[1];

    // Construct the request URL for reverse geocoding
    $url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' . $lat . ',' . $long . '&key=' . $apiKey;

    // Send a GET request to the Google Maps Geocoding API
    $response = file_get_contents($url);
    
    // Check if the response is valid
    if ($response === false) {
        return 'Error: Failed to fetch data from Google Geocoding API';
    }
    
    // Decode the JSON response
    $data = json_decode($response);

    // Check if the response contains results
    if ($data && $data->status === 'OK' && !empty($data->results)) {
        // Get the formatted address from the first result
        $address = $data->results[0]->formatted_address;
        return $address;
    } else {
        return 'Address not found';
    }
}




