@extends('../layouts/side-menu')

@php

    // echo $layout;exit;
@endphp

@section('subhead')
    <title>Update Customer</title>
@endsection



@section('subcontent')
    <style>
        .btn-success {
            color: #fff !important;
            background-color: #164e63 !important;
            border-color: #164e63 !important;
        }

        .pac-target-input {
            display: block !important;
            width: 30% !important;
            height: calc(1.5em + 0.9rem + 2px) !important;
            padding: 0.45rem 0.9rem !important;
            font-size: .875rem !important;
            font-weight: 400 !important;
            line-height: 1.5 !important;
            color: #6c757d !important;
            background-color: #fff !important;
            background-clip: padding-box !important;
            border: 1px solid #ced4da !important;
            border-radius: 5px !important;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out !important;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">
    <div class="intro-y flex items-center" style="margin-bottom:13px;">
        <h2 class="mr-auto text-lg font-medium" style="font-size:22px;">Update Customer</h2>
    </div>

    <div class="mt-5 grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12 lg:col-span-12"
            style="padding: 20px 32px; border: 1px solid #e1dede; border-radius: 6px; box-shadow: 0 3px 10px rgb(69 14 33 / 20%); background: white;border-top: 7px solid #164e63;">
            <form action='{{ route('update.customer') }}' method="post" enctype="multipart/form-data" id="update_form">
                <input name="id" type="hidden" required="required" value="{{ $userData->id }}" class="form-control" />
                <div class='grid-cols-12 grid'>
                    <div class='col-span-6 mr-5'>
                        <div class="input-form">
                            <label style="font-weight:600; line-height:30px;"> Name </label>
                            <input name="name" type="text" required="required" value="{{ $userData->name }}"
                                class="form-control" />
                        </div>
                    </div>
                    <div class="col-span-6 mr-5">
                        <div class="input-form">
                            <label style="font-weight:600; line-height:30px;"> Mobile No </label>
                            <input name="phone_no" id="phone_no" type="text"
                                value="{{ old('phone_no', $userData->phone_no) }}" maxlength="10" minlength="10"
                                class="form-control" />
                            <span class="text-danger" id="phone_no-error"></span>
                        </div>

                    </div>

                </div>
                <div class="input-form mt-3">
                    <div class='add_other_address'>
                        @php
                            $i = 1;
                        @endphp
                        {{-- @foreach ($getDetails as $rowDetails) --}}
                        @foreach ($getDetails as $i => $rowDetails)
                            <div class='grid-cols-12 grid'
                                style="background: #efecec00;margin-top: 20px; border-radius: 8px;">
                                <input name="address_id[{{ $i }}]" type="hidden" required="required"
                                    class="form-control" value='{{ $rowDetails->id }}' />
                                <div class='col-span-3 mr-5 mt-3'>
                                    <div class="input-form">
                                        <label style="font-weight:600; line-height:30px;"> Location Type </label>
                                        <input name="location_type[{{ $i }}]" type="text" required="required"
                                            class="form-control" value='{{ $rowDetails->location_type }}'
                                            placeholder="Home/Office/Other" />
                                    </div>
                                </div>
                                <div class='col-span-3 mr-5 mt-3'>
                                    <div class="input-form">
                                        <label style="font-weight:600; line-height:30px;"> Pincode </label>
                                        <input name="pincode[{{ $i }}]" type="text" required="required"
                                            class="form-control" value='{{ $rowDetails->pincode }}' />
                                    </div>
                                </div>
                                <div class='col-span-6 mt-3'>
                                    <div class="input-form">
                                        <label style="font-weight:600; line-height:30px;"> Address </label>
                                        <input name="address[{{ $i }}]" type="text" required="required"
                                            class="form-control" value='{{ $rowDetails->address }}' />
                                    </div>
                                </div>
                            </div>
                            @php
                                $acDetails = DB::table('ac_detail')
                                    ->where('address_id', $rowDetails->id)
                                    ->get();
                            @endphp
                            @php
                                $total_ton_sum = 0; // Initialize total_ton sum variable
                            @endphp
                            <div class="ac_type">
                                @foreach ($acDetails as $key => $acDetail)
                                    <div class="grid-cols-12 grid">
                                        <div class='col-span-2 mr-5 mt-3'>
                                            <div class="input-form">
                                                <label style="font-weight:600; line-height:30px;">Type</label>
                                                <select class="form-control"
                                                    name='type[{{ $i }}][{{ $key }}]'>
                                                    @php
                                                        $product = DB::table('products')->get();
                                                    @endphp
                                                    @foreach ($product as $rowProduct)
                                                        <option class="{{ $rowProduct->product_name }}"
                                                            {{ $rowProduct->product_name == $acDetail->type ? 'selected' : '' }}>
                                                            {{ $rowProduct->product_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class='col-span-2 mr-5 mt-3'>
                                            <input type="hidden" name="acId[{{ $i }}][{{ $key }}]"
                                                value="{{ $acDetail->id }}">
                                            <div class="input-form">
                                                <label style="font-weight:600; line-height:30px;">No Ac</label>
                                                <input name="no_ac[{{ $i }}][{{ $key }}]"
                                                    type="number" required="required" class="form-control no_ac"
                                                    value='{{ $acDetail->no_ac }}' />
                                            </div>
                                        </div>
                                        <div class='col-span-2 mr-5 mt-3'>
                                            <div class="input-form">
                                                <label style="font-weight:600; line-height:30px;">No of Ton</label>
                                                <input name="no_of_ton[{{ $i }}][{{ $key }}]"
                                                    type="number" required="required" class="form-control no_of_ton"
                                                    value='{{ $acDetail->no_of_ton }}' />
                                            </div>
                                        </div>
                                        <div class='col-span-2 mr-5 mt-3'>
                                            <div class="input-form">
                                                @php
                                                    // Check if values are numeric before performing calculations
                                                    if (
                                                        is_numeric($acDetail->no_of_ton) &&
                                                        is_numeric($acDetail->no_ac)
                                                    ) {
                                                        // Convert string values to integers and perform calculations
                                                        $no_of_ton = intval($acDetail->no_of_ton);
                                                        $no_ac = intval($acDetail->no_ac);
                                                        $total = $no_of_ton * $no_ac;

                                                        // Calculate total_ac_ton for current iteration
                                                        $total_ac_ton = $acDetail->no_of_ton * $acDetail->no_ac;
                                                        // Add current total_ac_ton to sum
                                                        $total_ton_sum += $total_ac_ton;
                                                    } else {
                                                        // Handle the case where values are not numeric
                                                        // You can log an error message or handle it as appropriate
                                                        $total = 0; // or any default value
                                                    }
                                                @endphp
                                                <label style="font-weight:600; line-height:30px;">TotalTon</label>
                                                <input name="total_ac_ton[{{ $i }}][{{ $key }}]"
                                                    type="text" required="required" class="form-control total_ac_ton"
                                                    value='{{ $total }}' />
                                            </div>
                                        </div>
                                        <div class='col-span-2 mr-5 mt-3'>
                                            <div class="input-form">
                                                <label style="font-weight:600; line-height:30px;">Message</label>
                                                <input name="message[{{ $i }}][{{ $key }}]"
                                                    type="text" required="required" class="form-control"
                                                    value='{{ $acDetail->message }}' />
                                            </div>
                                        </div>

                                        @if (count($acDetails) == 1)
                                        @else
                                            <div class='col-span-1 ml-5 mt-10'>
                                                <label style="font-weight:600; line-height:30px;"></label>
                                                <button class='btn btn-success removeAC' value="{{ $acDetail->id }}"
                                                    data-key="{{ $key }}" type='button'>Remove</button>
                                            </div>
                                        @endif
                                        @if ($loop->last)
                                            <div class='col-span-1 ml-5 mt-10'>
                                                <label style="font-weight:600; line-height:30px;"></label>
                                                <button class='btn btn-success btn_add_ac' value="{{ $i }}"
                                                    data-key="{{ $key }}" type='button'>Add</button>
                                            </div>
                                            <div class="col-span-1 ml-5 mt-10" style="margin: 10px;">
                                                <label style="font-weight:600; line-height:30px;">Total Ton</label>
                                                <input type="text" class="form-control total_ton"
                                                    value="{{ $total_ton_sum }}" readonly>
                                            </div>
                                        @else
                                            <div class='col-span-3 ml-5 mt-3'></div>
                                        @endif
                                        <div class='add_other_ac col-span-12' style="margin-bottom: 15px;"></div>
                                    </div>
                                @endforeach
                            </div>

                            {{-- <div class='col-span-12'>
                                <div id="search_container" style="margin-bottom: 0.75rem;">
                                    <input id="search_location_{{ $i }}" type="text"
                                        class="abcd pac-target-input" placeholder="Search Location" autocomplete="off">
                                </div>
                                <div id="map_canvas_{{ $i }}" class="map_canvas"
                                    style="border: 2px solid #3872ac; height: 300px;">

                                </div>
                                <input id="location_{{ $i }}" name="location[{{ $i }}]"
                                    value="{{ $rowDetails->latlong }}" type="text" class="location"
                                    placeholder="Click on the map to set location" required="required"
                                    style="display:none;"> --}}

                            {{-- <input class="abcd" value="map_canvas_{{ $i }}"> --}}
                            {{-- </div> --}}

                            <div id="search_container_{{ $i }}" style="margin-bottom: 0.75rem;">
                                <input id="search_location_{{ $i }}" type="text"
                                    class="abcd pac-target-input" placeholder="Search Location" autocomplete="off">
                            </div>
                            <div id="map_canvas_{{ $i }}" class="map_canvas"
                                style="border: 2px solid #3872ac; height: 300px;"></div>
                            <input id="location_{{ $i }}" name="location[{{ $i }}]"
                                value="{{ $rowDetails->latlong }}" type="text" class="location"
                                placeholder="Click on the map to set location" required="required" style="display:none;">
                            <br>
                            {{-- <button class='btn btn-success removeAddress' data-address-id="{{ $rowDetails->id }}"
                                type='button'>Delete</button> --}}
                            @if (!$loop->first)
                                <!-- Check if it's not the first iteration -->
                                <!-- Display the delete button only if it's not the first address -->
                                <button class='btn btn-success removeAddress' data-address-id="{{ $rowDetails->id }}"
                                    type='button'>Delete</button>
                            @else
                                <h1 class="text-danger">First Address Not Delete This Only For Update</h1>
                            @endif
                        @endforeach
                        @php
                            $i++;
                        @endphp




                        <div class='grid-cols-12 grid main_addredd_div'
                            style="background: #efecec00;margin-top: 20px;border-radius: 8px;margin-bottom: 15px;display: none;">

                            {{-- <div class='add_other_ac'>
                    </div> --}}
                        </div>
                        <div class='add_other_address add_new_address'>
                        </div>
                        @csrf
                        <button type="submit"
                            class="text-center transition duration-200 border shadow-sm inline-flex
                     items-center justify-center py-2 px-3 
                     rounded-md font-medium cursor-pointer focus:ring-4
                      focus:ring-primary 
                      focus:ring-opacity-20
                       focus-visible:outline-none 
                       dark:focus:ring-slate-700 
                       dark:focus:ring-opacity-50
                        [&amp;amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;amp;:hover:not(:disabled)]:border-opacity-90 
                        [&amp;amp;:not(button)]:text-center disabled:opacity-70 
                        disabled:cursor-not-allowed bg-primary border-primary 
                        text-white dark:border-primary mt-5 mt-5">Update</button>
                        <button class='btn btn-success btn_add_address' value="{{ count($acDetails ?? []) }}"
                            type='button'>Add-Address</button>

            </form>
        </div>
    </div>
@endsection

@once

    @push('script')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBc-IV1LhwxzZkVbGfqiHKq-wiHayqgU8&sensor=true"
            type="text/javascript"></script>
        <script>
            jQuery(document).ready(function($) {
                $('body').on('click', '.removeAC', function() {
                    var val = $(this).val();
                    // Show confirmation dialog
                    swal({
                            title: "Are you sure?",
                            text: "Once deleted, you will not be able to recover this Ac Detail!",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        })
                        .then((willDelete) => {
                            if (willDelete) {
                                // If user confirms, send AJAX request to remove the item
                                $.ajax({
                                    type: "GET",
                                    dataType: "json",
                                    url: '{{ route('removeAC') }}',
                                    data: {
                                        'id': val
                                    },
                                    success: function(data) {
                                        window.location.reload();
                                    }
                                });
                            } else {
                                // If user cancels, do nothing
                                // You can optionally show a cancellation message here
                            }
                        });
                });
            });
        </script>
        <script>
            jQuery(document).ready(function($) {
                // $('body').on('click', '.removeAC', function() {
                $('.removeAddress').on('click', function() {
                    var addressId = $(this).data('address-id'); // Get the ID of the address to be deleted

                    var val = $(this).val();
                    // Show confirmation dialog
                    swal({
                            title: "Are you sure?",
                            text: "Delete Address Detils",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        })
                        .then((willDelete) => {
                            if (willDelete) {
                                // If user confirms, send AJAX request to remove the item
                                $.ajax({
                                    type: "POST",
                                    dataType: "json",
                                    url: "/delete-address/" +
                                        addressId, // URL to your backend route to handle the deletion
                                    data: {
                                        _token: '{{ csrf_token() }}', // Add CSRF token if you're using Laravel's CSRF protection
                                        id: addressId
                                    },
                                    success: function(data) {
                                        window.location.reload();
                                    }
                                });
                            } else {
                                // If user cancels, do nothing
                                // You can optionally show a cancellation message here
                            }
                        });
                });
            });
        </script>





        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBc-IV1LhwxzZkVbGfqiHKq-wiHayqgU8"
            type="text/javascript"></script>


        @foreach ($getDetails as $key => $rowDetails)
            <script>
                var map;
                var infowindow = new google.maps.InfoWindow();
                var marker;

                function initialize11() {
                    var latlong = "{{ $rowDetails->latlong }}";
                    var latlongArray = latlong.split(',');
                    map = new google.maps.Map(document.getElementById("map_canvas_{{ $i }}"), {
                        // console.log("
                        center: new google.maps.LatLng(parseFloat(latlongArray[0]), parseFloat(latlongArray[1])),
                        zoom: 13,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    });
                    // console.log("map", map);
                    marker = new google.maps.Marker({
                        position: new google.maps.LatLng(parseFloat(latlongArray[0]), parseFloat(latlongArray[1])),
                        map: map,
                    });
                    google.maps.event.addListener(map, 'click', function(e) {
                        var latLng = e.latLng;
                        if (marker) {
                            marker.setMap(null);
                        }
                        marker = new google.maps.Marker({
                            position: latLng,
                            map: map,
                        });
                        document.getElementById('location_{{ $key }}').value = latLng.lat() + ',' + latLng.lng();
                    });
                }
                google.maps.event.addDomListener(window, "load", initialize11);
            </script>
        @endforeach



        <script>
            var typeIndex = 1; // Initialize the index counter



            $('body').on('click', '.btn_add_address', function() {
                var selectTag = $(
                    '<div class="col-span-4 mt-3" style="margin-top:0px;"><div class="input-form"><select class="form-control select_tag" name="newtype[' +
                    typeIndex +
                    '][0]">@php $product=DB::table("products")->get(); @endphp @foreach ($product as $rowProduct)<option class="{{ $rowProduct->product_name }}">{{ $rowProduct->product_name }}</option>@endforeach</select></div></div>'
                );
                var originalElement = selectTag;
                var clonedElement = originalElement.clone();
                clonedSelectHTML = clonedElement[0].outerHTML;

                var mapId = 'map_canvas11_' + typeIndex;
                var locationInputId = 'location11_' + typeIndex;
                $('.add_new_address').append(
                    '<div class="grid-cols-12 mt-3 grid" style="background: #efecec00;border-radius: 8px; margin-bottom: 15px;margin-top: 20px;">' +
                    '<div class="col-span-3 mr-5 mt-3"><div class="input-form">' +
                    '<label style="font-weight:600; line-height:30px;">Location Type</label>' +
                    '<input name="newlocation_type[' + typeIndex +
                    ']" type="text" placeholder="Home/Office/Other" required="required" class="form-control">' +
                    '</div></div>' +
                    '<div class="col-span-3 mr-5 mt-3"><div class="input-form">' +
                    '<label style="font-weight:600; line-height:30px;"> Pincode </label>' +
                    '<input name="newpincode[' + typeIndex +
                    ']" type="text" required="required" class="form-control" />' +
                    '</div></div>' +
                    '<div class="col-span-6 mr-5 mt-3"><div class="input-form">' +
                    '<label style="font-weight:600; line-height:30px;">Address</label>' +
                    '<input name="newaddress[' + typeIndex +
                    ']" type="text" required="required" class="form-control">' +
                    '</div></div>' +
                    '<div class="col-span-2 mr-5 mt-3"><div class="input-form">' +
                    '<label style="font-weight:600; line-height:30px;">Type</label>' +
                    clonedSelectHTML +
                    '</div></div>' +
                    '<div class="col-span-2 mr-5 mt-3"><div class="input-form">' +
                    '<label style="font-weight:600; line-height:30px;"> No Ac </label>' +
                    '<input name="newno_ac[' + typeIndex +
                    '][0]" type="number" required="required" class="form-control no_ac" />' +
                    '</div></div>' +
                    '<div class="col-span-2 mr-5 mt-3"><div class="input-form">' +
                    '<label style="font-weight:600; line-height:30px;"> No of Ton </label>' +
                    '<input name="newno_of_ton[' + typeIndex +
                    '][0]" type="number" required="required" class="form-control no_of_ton" />' +
                    '</div></div>' +
                    '<div class="col-span-1 mr-5 mt-3" style="margin-bottom: 15px;"><div class="input-form">' +
                    '<label style="font-weight:600; line-height:30px;"> TotalTon </label>' +
                    '<input name="newtotal_ac_ton[' + typeIndex +
                    '][]" type="text" required="required" class="form-control total_ac_ton" />' +
                    '</div></div>' +
                    '<div class="col-span-3 mr-5 mt-3" style="margin-bottom: 15px;"><div class="input-form">' +
                    '<label style="font-weight:600; line-height:30px;"> Message </label>' +
                    '<input name="newmessage[' + typeIndex +
                    '][]" type="text" required="required" class="form-control message" />' +
                    '</div></div>' +
                    '<div class="col-span-2 mr-5 mt-3">' +
                    '<button class="btn btn-success btn_newadd_ac" type="button" value="' + typeIndex +
                    '" style=" margin-top: 30px;">Add</button>' +

                    '<div class="col-span-1 ml-5 mt-10" style="margin-top: -70px;width: 110px;  margin-left: 135px">' +
                    '<label style="font-weight:600; line-height:30px;">Total Ton</label>' +
                    '<input type="text" class="form-control total_ton" readonly>' +
                    '</div>' +

                    '</div>' +

                    '<div class="add_other_ac col-span-12"></div>' +
                    '<div class="col-span-12 mr-5 mt-3 mb-3">' +
                    '<div id="search_container_' + mapId +
                    '" style="text-align: left; margin-bottom: 1px;"></div>' +
                    '</div>' +

                    '<div class="col-span-12">' +
                    '<div id="' + mapId +
                    '" class="map_canvas" style="border: 2px solid #3872ac; height: 300px;"></div>' +
                    '<input id="' + locationInputId + '" name="newlocation[' + typeIndex +
                    ']" type="text" class="location" placeholder="Click on the map to set location" required="required" style="display:none;">' +
                    '</div>' +
                    '<div class="col-span-12 mr-5 mt-3">' +
                    '<button class="btn btn-success btn_remove_address" type="button" style=" margin-top: 30px;">Remove</button>' +
                    '</div>' +
                    '</div>'
                );

                initializeMap(mapId, locationInputId);
                // Increment the index for the next clones
                typeIndex++;
            });

            // Add a script to remove the added address if needed
            $('body').on('click', '.btn_remove_address', function() {
                $(this).closest('.grid-cols-12').remove();
            });


            function initializeMap(mapId, locationInputId) {
                var map;
                var infowindow = new google.maps.InfoWindow();
                var marker;

                map = new google.maps.Map(document.getElementById(mapId), {
                    center: new google.maps.LatLng(21.209036, 72.8479451),
                    zoom: 13,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                });

                google.maps.event.addListener(map, 'click', function(e) {
                    var latLng = e.latLng;

                    if (marker) {
                        marker.setMap(null);
                    }

                    marker = new google.maps.Marker({
                        position: latLng,
                        map: map,
                    });

                    // Update the location input field with the coordinates
                    document.getElementById(locationInputId).value = latLng.lat() + ',' + latLng.lng();
                });

                var searchContainer = document.getElementById('search_container_' + mapId);
                var searchInput = document.createElement('input');
                searchInput.id = 'search_location' + mapId;
                searchInput.type = 'text';
                // searchInput.required = true;
                searchInput.placeholder = 'Search Location';
                searchContainer.appendChild(searchInput);

                var searchBox = new google.maps.places.SearchBox(searchInput);

                google.maps.event.addListener(searchBox, 'places_changed', function() {
                    var places = searchBox.getPlaces();
                    if (places.length == 0) {
                        return;
                    }
                    var bounds = new google.maps.LatLngBounds();
                    places.forEach(function(place) {
                        if (!place.geometry) {
                            console.log("Returned place contains no geometry");
                            return;
                        }

                        if (marker) {
                            marker.setMap(null);
                        }

                        // Set marker at the selected location
                        marker = new google.maps.Marker({
                            map: map,
                            position: place.geometry.location
                        });
                        if (place.geometry.viewport) {
                            bounds.union(place.geometry.viewport);
                        } else {
                            bounds.extend(place.geometry.location);
                        }
                    });
                    map.fitBounds(bounds);
                });

                // Bias the SearchBox results towards current map's viewport.
                map.addListener('bounds_changed', function() {
                    searchBox.setBounds(map.getBounds());
                });
            }
        </script>
        <!-- Include SweetAlert JS -->


        <script>
            $('body').on('click', '.btn_newadd_ac', function() {
                var val = $(this).val()
                var selectTag = $(
                    '<div class="col-span-4 mt-3" style="margin-top:0px;"><div class="input-form"><select class="form-control select_tag" name="newtype[' +
                    val +
                    '][]">@php $product=DB::table("products")->get(); @endphp @foreach ($product as $rowProduct)<option class="{{ $rowProduct->product_name }}">{{ $rowProduct->product_name }}</option>@endforeach</select></div></div>'
                );
                var originalElement = selectTag;
                var clonedElement = originalElement.clone();
                clonedSelectHTML = clonedElement[0].outerHTML;
                $(this).closest('.grid-cols-12').find('.add_other_ac').append(
                    '<div class="grid-cols-12 grid" style="background: #efecec00;border-radius: 8px; margin-bottom: 15px;">' +
                    '<div class="col-span-2 mr-5 mt-3"><div class="input-form"><label style="font-weight:600; line-height:30px;">Type</label>' +
                    clonedSelectHTML +
                    '</div></div>' +
                    '<div class="col-span-2 mr-5 mt-3"><div class="input-form"> <label style="font-weight:600; line-height:30px;"> No Ac </label><input name="newno_ac[' +
                    val + '][]" type="number" required="required" class="form-control no_ac" /></div></div>' +
                    '<div class="col-span-2 mr-5 mt-3"><div class="input-form"><label style="font-weight:600; line-height:30px;"> No of Ton </label><input name="newno_of_ton[' +
                    val + '][]" type="number" required="required" class="form-control no_of_ton" /></div></div>' +
                    '<div class="col-span-1 mr-5 mt-3"><div class="input-form"> <label style="font-weight:600; line-height:30px;"> TotalTon </label><input name="newtotal_ac_ton[' +
                    val + '][]" type="text" required="required" class="form-control total_ac_ton" /></div></div>' +
                    '<div class="col-span-3 mr-5 mt-3"><div class="input-form"> <label style="font-weight:600; line-height:30px;"> Message </label><input name="newmessage[' +
                    val + '][]" type="text" required="required" class="form-control message" /></div></div>' +
                    '<div class="col-span-2 mr-5 mt-3"><button class="btn btn-success btn_remove_ac" type="button" style=" margin-top: 30px;">Remove</button></div>' +
                    '</div>'
                );
            });
            // Add a script to remove the added AC section if needed
            $('body').on('click', '.btn_remove_ac', function() {
                $(this).closest('.grid-cols-12').remove();
            });
        </script>
        <script>
            $('body').on('click', '.btn_add_ac', function() {
                // var getval = $(this).val();
                var val = $(this).val();
                // console.log(val);
                var datacount = $(this).data('key');
                var dataKey = parseInt(datacount) + 1;

                // Update the data-key attribute immediately
                $(this).data('key', dataKey);
                var selectTag = $(
                    '<div class="col-span-4 mt-3"><div class="input-form"><select class="form-control select_tag" name="type[' +
                    val + '][' + dataKey +
                    ']">@php $product=DB::table("products")->get(); @endphp @foreach ($product as $rowProduct)<option class="{{ $rowProduct->product_name }}">{{ $rowProduct->product_name }}</option>@endforeach</select></div></div>'
                );
                var originalElement = selectTag;
                var clonedElement = originalElement.clone();
                clonedSelectHTML = clonedElement[0].outerHTML;
                $(this).closest('.grid-cols-12').find('.add_other_ac').append(
                    '<div class="grid-cols-12 grid" style="background: #efecec00;border-radius: 8px; margin-bottom: 15px;">' +
                    '<div class="col-span-2 mr-5 mt-3"><div class="input-form"><label style="font-weight:600; line-height:30px;">Type</label>' +
                    clonedSelectHTML +
                    '</div></div>' +
                    '<div class="col-span-2 mr-5 mt-3"><div class="input-form"> <label style="font-weight:600; line-height:30px;"> No Ac </label><input name="no_ac[' +
                    val + '][' + dataKey +
                    ']" type="number" required="required" class="form-control no_ac" /></div></div>' +
                    '<div class="col-span-2 mr-5 mt-3"><div class="input-form"><label style="font-weight:600; line-height:30px;"> No of Ton </label><input name="no_of_ton[' +
                    val + '][' + dataKey +
                    ']" type="text" required="required" class="form-control no_of_ton" /></div></div>' +
                    '<div class="col-span-1 mr-5 mt-3"><div class="input-form"><label style="font-weight:600; line-height:30px;"> TotalTon </label><input name="total_ac_ton[' +
                    val + '][' + dataKey +
                    ']" type="text" required="required" class="form-control total_ac_ton" /></div></div>' +
                    '<div class="col-span-3 mr-5 mt-3"><div class="input-form"><label style="font-weight:600; line-height:30px;"> Message </label><input name="message[' +
                    val + '][' + dataKey +
                    ']" type="text" required="required" class="form-control message" /></div></div>' +

                    '<div class="col-span-2 mr-5 mt-3"><button class="btn btn-success btn_remove_ac" type="button" style=" margin-top: 30px;">Remove</button></div>' +
                    '</div>'
                );
                dataKey++;
            });
            // Add a script to remove the added AC section if needed
            $('body').on('click', '.btn_remove_ac', function() {
                $(this).closest('.grid-cols-12').remove();
            });
        </script>
        <script>
            $(document).ready(function() {


                // Calculate total ton when input values change
                $('body').on('input', '.no_of_ton, .no_ac', function() {

                    var total = 0;
                    var $grid = $(this).closest('.grid-cols-12');
                    var no_ac_val = parseFloat($grid.find('.no_ac').val());

                    // alert(no_ac_val)
                    var no_of_ton_val = parseFloat($(this).val());
                    // alert(no_of_ton_val)
                    var total_ac_ton = no_ac_val * no_of_ton_val;
                    // console.log(total_ac_ton);
                    $grid.find('.total_ac_ton').val(total_ac_ton);
                    $('.total_ac_ton').each(function() {
                        total += parseFloat($(this).val()) || 0;
                    });
                    $('.total_ton').val(total);
                });
                $('body').on('click', '.btn_remove_ac', function() {
                    $(this).closest('.grid-cols-12').remove();
                    calculateTotalTon();
                });

                function calculateTotalTon() {
                    var total = 0;
                    $('.total_ac_ton').each(function() {
                        total += parseFloat($(this).val()) || 0;
                    });
                    $('.total_ton').val(total);
                }
            });
        </script>


        {{-- old --}}

        {{-- @foreach ($getDetails as $rowDetails)
        
           
            <script>
                function initialize() {

                    // Get all elements with the class name "map_canvas"
                    const mapCanvasElements = document.getElementsByClassName("map_canvas");
                    const searchInputElements = document.getElementsByClassName("abcd");
                    console.log(mapCanvasElements.length);
                    // Iterate over the elements and initialize a map for each one
                    for (let i = 0; i < mapCanvasElements.length; i++) {
                        const mapCanvasElement = mapCanvasElements[i];
                        const searchInputElement = searchInputElements[i];

                        // Retrieve the value of the current input element
                        const latlng = new google.maps.LatLng({{ $rowDetails->latlong }}); // Inject dynamic latlong here

                        // Create a new map for the current element
                        const map = new google.maps.Map(mapCanvasElement, {
                            center: latlng,
                            zoom: 13,
                            mapTypeId: google.maps.MapTypeId.ROADMAP
                        });

                        // Define the custom pin icon
                        const pinIcon = {
                            url: '{{ asset('build/assets/free-pin-locate-marker-location-navigation-16-28668.png') }}',
                            scaledSize: new google.maps.Size(40, 40),
                        };

                        // Initialize marker variable
                        let marker = new google.maps.Marker({
                            position: latlng,
                            map: map,
                            draggable: true,
                            icon: pinIcon
                        });

                        // Add click event listener to the map
                        google.maps.event.addListener(map, 'click', function(e) {
                            const latLng = e.latLng;

                            // Remove existing marker
                            if (marker) {
                                marker.setMap(null);
                            }

                            // Create a new marker at the clicked location
                            marker = new google.maps.Marker({
                                position: latLng,
                                map: map,
                                draggable: true,
                                icon: pinIcon
                            });

                            // Update the location input field with the coordinates
                            const locationInputId = 'location_' + (i + 1);
                            document.getElementById(locationInputId).value = latLng.lat() + ',' + latLng.lng();
                        });

                        // Initialize search box for places search
                        const searchBox = new google.maps.places.SearchBox(searchInputElement);

                        // Add places_changed event listener to the search box
                        google.maps.event.addListener(searchBox, 'places_changed', function() {
                            const places = searchBox.getPlaces();
                            if (places.length == 0) {
                                return;
                            }
                            const bounds = new google.maps.LatLngBounds();
                            places.forEach(function(place) {
                                if (!place.geometry) {
                                    console.log("Returned place contains no geometry");
                                    return;
                                }

                                // Remove existing marker
                                if (marker) {
                                    marker.setMap(null);
                                }

                                // Create a new marker at the selected location
                                marker = new google.maps.Marker({
                                    position: place.geometry.location,
                                    map: map,
                                    draggable: true,
                                    icon: pinIcon
                                });

                                bounds.extend(place.geometry.location);
                            });
                            map.fitBounds(bounds);
                        });

                        // Bias the SearchBox results towards current map's viewport.
                        map.addListener('bounds_changed', function() {
                            searchBox.setBounds(map.getBounds());
                        });
                    }
                }

                // Load the Google Maps JavaScript API script
                var script = document.createElement('script');
                script.src =
                    'https://maps.googleapis.com/maps/api/js?key=AIzaSyCBc-IV1LhwxzZkVbGfqiHKq-wiHayqgU8&libraries=places&callback=initialize';
                script.defer = true;
                document.head.appendChild(script);
            </script>
        @endforeach --}}











        {{-- new --}}


        @php
            // Initialize an empty array for latlngs
            $latlngs = [];

            // Populate $latlngs with latitude and longitude values from $getDetails
            foreach ($getDetails as $index => $rowDetails) {
                $latlngs[] = explode(',', $rowDetails->latlong);
            }
            // dd($latlngs);
        @endphp



        {{-- @foreach ($getDetails as $index => $rowDetails)
            <script>
                function initialize{{ $index + 1 }}() {
                    // Get map canvas element
                    const mapCanvasElement = document.getElementsByClassName("map_canvas")[{{ $index }}];
                    // Get search input element
                    const searchInputElement = document.getElementsByClassName("abcd")[{{ $index }}];

                    // Retrieve the value of the current input element
                    const latlng = new google.maps.LatLng({{ $latlngs[$index][0] }}, {{ $latlngs[$index][1] }});

                    // Create a new map for the current element
                    const map = new google.maps.Map(mapCanvasElement, {
                        center: latlng,
                        zoom: 13,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    });

                    // Define the custom pin icon
                    const pinIcon = {
                        url: '{{ asset('build/assets/free-pin-locate-marker-location-navigation-16-28668.png') }}',
                        scaledSize: new google.maps.Size(40, 40),
                    };

                    // Initialize marker variable
                    let marker = new google.maps.Marker({
                        position: latlng,
                        map: map,
                        draggable: true,
                        icon: pinIcon
                    });

                    // Add click event listener to the map
                    google.maps.event.addListener(map, 'click', function(e) {
                        const latLng = e.latLng;

                        // Remove existing marker
                        if (marker) {
                            marker.setMap(null);
                        }

                        // Create a new marker at the clicked location
                        marker = new google.maps.Marker({
                            position: latLng,
                            map: map,
                            draggable: true,
                            icon: pinIcon
                        });

                        // Update the location input field with the coordinates
                        const locationInputId = 'location_' + ({{ $index + 1 }});
                        document.getElementById(locationInputId).value = latLng.lat() + ',' + latLng.lng();
                    });

                    // Initialize search box for places search
                    const searchBox = new google.maps.places.SearchBox(searchInputElement);

                    // Add places_changed event listener to the search box
                    google.maps.event.addListener(searchBox, 'places_changed', function() {
                        const places = searchBox.getPlaces();
                        if (places.length == 0) {
                            return;
                        }
                        const bounds = new google.maps.LatLngBounds();
                        places.forEach(function(place) {
                            if (!place.geometry) {
                                console.log("Returned place contains no geometry");
                                return;
                            }

                            // Remove existing marker
                            if (marker) {
                                marker.setMap(null);
                            }

                            // Create a new marker at the selected location
                            marker = new google.maps.Marker({
                                position: place.geometry.location,
                                map: map,
                                draggable: true,
                                icon: pinIcon
                            });

                            bounds.extend(place.geometry.location);
                        });
                        map.fitBounds(bounds);
                    });

                    // Bias the SearchBox results towards current map's viewport.
                    map.addListener('bounds_changed', function() {
                        searchBox.setBounds(map.getBounds());
                    });
                }

                // Load the Google Maps JavaScript API script
                initialize{{ $index + 1 }}();
            </script>
        @endforeach --}}



        @foreach ($getDetails as $index => $rowDetails)
            <script>
                function initialize() {
                    const mapCanvasElements = document.getElementsByClassName("map_canvas");
                    const searchInputElements = document.getElementsByClassName("abcd");

                    for (let i = 0; i < mapCanvasElements.length; i++) {
                        const mapCanvasElement = mapCanvasElements[i];
                        const searchInputElement = searchInputElements[i];

                        // Retrieve the latlong from the hidden input field
                        const latlongString = document.getElementById('location_' + i).value;
                        const [lat, lng] = latlongString.split(',').map(Number);
                        const latlng = new google.maps.LatLng(lat, lng);

                        const map = new google.maps.Map(mapCanvasElement, {
                            center: latlng,
                            zoom: 13,
                            mapTypeId: google.maps.MapTypeId.ROADMAP
                        });

                        const pinIcon = {
                            url: '{{ asset('build/assets/free-pin-locate-marker-location-navigation-16-28668.png') }}',
                            scaledSize: new google.maps.Size(40, 40),
                        };

                        let marker = new google.maps.Marker({
                            position: latlng,
                            map: map,
                            draggable: true,
                            icon: pinIcon
                        });

                        google.maps.event.addListener(map, 'click', function(e) {
                            const latLng = e.latLng;

                            if (marker) {
                                marker.setMap(null);
                            }

                            marker = new google.maps.Marker({
                                position: latLng,
                                map: map,
                                draggable: true,
                                icon: pinIcon
                            });

                            document.getElementById('location_' + i).value = latLng.lat() + ',' + latLng.lng();
                        });

                        const searchBox = new google.maps.places.SearchBox(searchInputElement);

                        google.maps.event.addListener(searchBox, 'places_changed', function() {
                            const places = searchBox.getPlaces();
                            if (places.length == 0) {
                                return;
                            }
                            const bounds = new google.maps.LatLngBounds();
                            places.forEach(function(place) {
                                if (!place.geometry) {
                                    // console.log("Returned place contains no geometry");
                                    return;
                                }

                                if (marker) {
                                    marker.setMap(null);
                                }

                                marker = new google.maps.Marker({
                                    position: place.geometry.location,
                                    map: map,
                                    draggable: true,
                                    icon: pinIcon
                                });

                                bounds.extend(place.geometry.location);
                            });
                            map.fitBounds(bounds);
                        });

                        map.addListener('bounds_changed', function() {
                            searchBox.setBounds(map.getBounds());
                        });
                    }
                }

                var script = document.createElement('script');
                script.src =
                    'https://maps.googleapis.com/maps/api/js?key=AIzaSyCBc-IV1LhwxzZkVbGfqiHKq-wiHayqgU8&libraries=places&callback=initialize';
                script.defer = true;
                document.head.appendChild(script);
            </script>
        @endforeach










        <script>
            // Function to fetch address based on latitude and longitude
            function fetchAddress(lat, lng, inputId) {
                var latlng = new google.maps.LatLng(lat, lng);
                var geocoder = new google.maps.Geocoder();

                geocoder.geocode({
                    'latLng': latlng
                }, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            document.getElementById(inputId).value = results[0].formatted_address;
                        }
                    } else {
                        // console.log('Geocoder failed due to: ' + status);
                    }
                });
            }


            $('#update_form').submit(function(event) {
                event.preventDefault(); // Prevent the form from submitting normally

                var phone_no = $('#phone_no').val();
                var userId = '{{ $userData->id }}'; // Get the user ID

console.log('User ID:', userId);


                jQuery.ajax({
                    url: '{{ route('checkmobileuserid', $userData->id) }}',
                    method: 'POST',
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        'phone_no': phone_no
                    },
                    success: function(response) {
                        if (response.exists) {
                            // Handle existing phone_no
                            // For example, show an error message using Toastr
                            toastr.error('Mobile number already exists');

                            // Optionally, you can clear the input field
                            // $('#phone_no').val('');

                            // Optionally, you can set focus back to the input field
                            $('#phone_no').focus();
                        } else {
                            // Handle non-existing phone_no
                            // For example, submit the form
                            document.getElementById('update_form').submit();
                        }
                    }
                });
            });
        </script>
    @endpush
@endonce
@once
    @push('vendors')
        @vite('resources/js/vendor/pristine/index.js')
        @vite('resources/js/vendor/toastify/index.js')
    @endpush
@endonce
@once
    @push('scripts')
        @vite('resources/js/pages/validation/index.js')
    @endpush
@endonce
