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
    </style>
    <div class="intro-y flex items-center" style="margin-bottom:13px;">
        <h2 class="mr-auto text-lg font-medium" style="font-size:22px;">Update Customer</h2>
    </div>

    <div class="mt-5 grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12 lg:col-span-12"
            style="padding: 20px 32px; border: 1px solid #e1dede; border-radius: 6px; box-shadow: 0 3px 10px rgb(69 14 33 / 20%); background: white;border-top: 7px solid #164e63;">
            <form action='{{ route('update.customer') }}' method="post" enctype="multipart/form-data">
                <input name="id" type="hidden" required="required" value="{{ $userData->id }}" class="form-control" />
                <div class='grid-cols-12 grid'>
                    <div class='col-span-6 mr-5'>
                        <div class="input-form">
                            <label style="font-weight:600; line-height:30px;"> Name </label>
                            <input name="name" type="text" required="required" value="{{ $userData->name }}"
                                class="form-control" />
                        </div>
                    </div>
                    <div class='col-span-6 mr-5'>
                        <div class="input-form">
                            <label style="font-weight:600; line-height:30px;"> Mobile No </label>
                            <input name="phone_no" type="text" value="{{ $userData->phone_no }}" maxlength="10"
                                minlength="10" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="input-form mt-3">
                    <div class='add_other_address'>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($getDetails as $rowDetails)
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
                            <div class="ac_type">
                                @foreach ($acDetails as $key => $acDetail)
                                    <div class="grid-cols-12 grid ">
                                        <div class='col-span-2 mr-5 mt-3'>
                                            <div class="input-form">
                                                <label style="font-weight:600; line-height:30px;"> Type </label>
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
                                            <div class="input-form">
                                                <label style="font-weight:600; line-height:30px;"> No Ac </label>
                                                <input name="no_ac[{{ $i }}][{{ $key }}]"
                                                    type="text" required="required" class="form-control no_ac"
                                                    value='{{ $acDetail->no_ac }}' />
                                            </div>
                                        </div>
                                        <div class='col-span-2 mr-5 mt-3'>
                                            <div class="input-form">
                                                <label style="font-weight:600; line-height:30px;"> No of Ton </label>
                                                <input name="no_of_ton[{{ $i }}][{{ $key }}]"
                                                    type="text" required="required" class="form-control no_of_ton"
                                                    value='{{ $acDetail->no_of_ton }}' />
                                            </div>
                                        </div>
                                        <div class='col-span-2 mr-5 mt-3'>
                                            <div class="input-form">
                                                @php $total = $acDetail->no_of_ton * $acDetail->no_ac;  @endphp
                                                <label style="font-weight:600; line-height:30px;"> TotalTon </label>
                                                <input name="total_ac_ton[{{ $i }}][{{ $key }}]"
                                                    type="text" required="required" class="form-control total_ac_ton"
                                                    value='{{ $total }}' />
                                            </div>
                                        </div>
                                        <div class='col-span-3 mr-5 mt-3'>
                                            <div class="input-form">
                                                <label style="font-weight:600; line-height:30px;"> Message </label>
                                                <input name="message[{{ $i }}][{{ $key }}]"
                                                    type="text" required="required" class="form-control"
                                                    value='{{ $acDetail->message }}' />
                                            </div>
                                        </div>
                                        @if ($loop->last)
                                            <div class='col-span-1 ml-5 mt-10'>
                                                <label style="font-weight:600; line-height:30px;"></label>
                                                <button class='btn btn-success btn_add_ac' value="{{ $i }}" data-key="{{ $key }}" type='button'>Add</button>
                                            </div>
                                        @else
                                            <div class='col-span-3 ml-5 mt-3'>
                                                
                                            </div>
                                        @endif
                                        <div class='add_other_ac col-span-12' style="margin-bottom: 15px;"></div>
                                    </div>
                                @endforeach
                            </div>
                            <div class='col-span-12'>
                                <div id="map_canvas_{{ $i }}" class="map_canvas" style="border: 2px solid #3872ac; height: 300px;">
                                </div>
                                <input id="location_{{ $i }}" name="location[{{ $i }}]" value="{{ $rowDetails->latlong }}" type="text" class="location"
                                                placeholder="Click on the map to set location" required="required" style="display:none;">
                            </div>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </div>
                    <div class='grid-cols-12 grid main_addredd_div'
                        style="background: #efecec00;margin-top: 20px;border-radius: 8px;margin-bottom: 15px;display: none;">
                   
                    {{-- <div class='add_other_ac'>
                    </div> --}}
                    </div>
                    <div class='add_other_address add_new_address'>
                    </div>
                    @csrf
                    <button type="submit"
                        class="text-center transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;amp;:hover:not(:disabled)]:border-opacity-90 [&amp;amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mt-5 mt-5">Update</button>
                    <button class='btn btn-success btn_add_address' value="{{ count($acDetails) }}" type='button'>Add-Address</button>
            </form>
        </div>
    </div>
@endsection

@once

    @push('script')
        {{-- <script>
            $('body').on('click', '.btn_add_address', function() {
                var selectTag = $(
                    '<div class="col-span-4 mt-3"><div class="input-form"><select class="form-control select_tag" name="newtype[]">@php $product=DB::table("products")->get(); @endphp @foreach ($product as $rowProduct)<option class="{{ $rowProduct->product_name }}">{{ $rowProduct->product_name }}</option>@endforeach</select></div></div>'
                );
                var originalElement = selectTag;
                var clonedElement = originalElement.clone();
                clonedSelectHTML = clonedElement[0].outerHTML;
                $('.add_new_address').append(
                    '<div class="grid-cols-12 grid" style="background: #efecec00;border-radius: 8px; margin-bottom: 15px;"><div class="col-span-6 mr-5 mt-3"><div class="input-form"><label style="font-weight:600; line-height:30px;">Location Type</label><input name="newlocation_type[]" type="text" required="required" class="form-control"></div></div><div class="col-span-6 mr-5 mt-3"><div class="input-form"><label style="font-weight:600; line-height:30px;"> Pincode </label><input name="newpincode[]" type="text" required="required" class="form-control" /></div></div><div class="col-span-12 mr-5 mt-3"><div class="input-form"><label style="font-weight:600; line-height:30px;">Address</label><input name="newaddress[]" type="text" required="required" class="form-control"></div></div><div class="col-span-4 mr-5 mt-3"><div class="input-form"> <label style="font-weight:600; line-height:30px;"> No Ac </label><input name="newno_ac[]" type="text" required="required" class="form-control" /></div></div><div class="col-span-4 mr-5 mt-3"><div class="input-form"><label style="font-weight:600; line-height:30px;"> No of Ton </label><input name="newno_of_ton[]" type="text" required="required" class="form-control" /></div></div><div class="col-span-4 mr-5 mt-3"><div class="input-form"><label style="font-weight:600; line-height:30px;">Type</label>' +
                    clonedSelectHTML +
                    '</div></div><div class="col-span-12 mr-5 mt-3"><button class="btn btn-success btn_remove_address" type="button" style=" margin-top: 30px;">Remove</button></div></div>'
                    );
            });
        </script> --}}
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBc-IV1LhwxzZkVbGfqiHKq-wiHayqgU8&sensor=true" type="text/javascript"></script>
        @foreach ($getDetails as $key => $rowDetails)
        <script>
            var map;
            var infowindow = new google.maps.InfoWindow();
            var marker;
            function initialize11() {
                var latlong = "{{ $rowDetails->latlong }}";
                var latlongArray = latlong.split(',');
                map = new google.maps.Map(document.getElementById("map_canvas_{{ $key + 1 }}"), {
                    center: new google.maps.LatLng(parseFloat(latlongArray[0]), parseFloat(latlongArray[1])),
                    zoom: 13,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                });
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(parseFloat(latlongArray[0]), parseFloat(latlongArray[1])),
                    map: map,
                });
                google.maps.event.addListener(map, 'click', function (e) {
                    var latLng = e.latLng;
                    if (marker) {
                        marker.setMap(null);
                    }
                    marker = new google.maps.Marker({
                        position: latLng,
                        map: map,
                    });
                    document.getElementById('location_{{ $key + 1 }}').value = latLng.lat() + ',' + latLng.lng();
                });
            }
            google.maps.event.addDomListener(window, "load", initialize11);
        </script>
    @endforeach

        <script>
            var typeIndex = 1 ; // Initialize the index counter
        
            $('body').on('click', '.btn_add_address', function () {
                var selectTag = $(
                    '<div class="col-span-4 mt-3" style="margin-top:0px;"><div class="input-form"><select class="form-control select_tag" name="newtype[' + typeIndex + '][0]">@php $product=DB::table("products")->get(); @endphp @foreach ($product as $rowProduct)<option class="{{ $rowProduct->product_name }}">{{ $rowProduct->product_name }}</option>@endforeach</select></div></div>'
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
                    '<input name="newlocation_type[' + typeIndex + ']" type="text" placeholder="Home/Office/Other" required="required" class="form-control">' +
                    '</div></div>' +
                    '<div class="col-span-3 mr-5 mt-3"><div class="input-form">' +
                    '<label style="font-weight:600; line-height:30px;"> Pincode </label>' +
                    '<input name="newpincode[' + typeIndex + ']" type="text" required="required" class="form-control" />' +
                    '</div></div>' +
                    '<div class="col-span-6 mr-5 mt-3"><div class="input-form">' +
                    '<label style="font-weight:600; line-height:30px;">Address</label>' +
                    '<input name="newaddress[' + typeIndex + ']" type="text" required="required" class="form-control">' +
                    '</div></div>' +
                    '<div class="col-span-2 mr-5 mt-3"><div class="input-form">' +
                    '<label style="font-weight:600; line-height:30px;">Type</label>' +
                    clonedSelectHTML +
                    '</div></div>' +
                    '<div class="col-span-2 mr-5 mt-3"><div class="input-form">' +
                    '<label style="font-weight:600; line-height:30px;"> No Ac </label>' +
                    '<input name="newno_ac[' + typeIndex + '][0]" type="text" required="required" class="form-control no_ac" />' +
                    '</div></div>' +
                    '<div class="col-span-2 mr-5 mt-3"><div class="input-form">' +
                    '<label style="font-weight:600; line-height:30px;"> No of Ton </label>' +
                    '<input name="newno_of_ton[' + typeIndex + '][0]" type="text" required="required" class="form-control no_of_ton" />' +
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
                    '<button class="btn btn-success btn_newadd_ac" type="button" value="' + typeIndex + '" style=" margin-top: 30px;">Add</button>' +
                    '</div>' +
                    '<div class="add_other_ac col-span-12"></div>' +
                    '<div class="col-span-12 mr-5 mt-3 mb-3">' +
                    '<div id="search_container_' + mapId + '" style="text-align: left; margin-bottom: 1px;"></div>' +
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
                // Increment the index for the next clone
                typeIndex++;
            });
            // Add a script to remove the added address if needed
            $('body').on('click', '.btn_remove_address', function () {
                $(this).closest('.grid-cols-12').remove();
            });

            function initializeMap(mapId, locationInputId) {
                var map;
                var infowindow = new google.maps.InfoWindow();
                var marker;

                map = new google.maps.Map(
                    document.getElementById(mapId), {
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

                var searchContainer = document.getElementById('search_container_'+mapId);
				var searchInput = document.createElement('input');
				searchInput.id = 'search_location'+mapId;
				searchInput.type = 'text';
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
        <script>
            $('body').on('click', '.btn_newadd_ac', function() {
                var val = $(this).val()
                var selectTag = $(
                    '<div class="col-span-4 mt-3" style="margin-top:0px;"><div class="input-form"><select class="form-control select_tag" name="newtype[' + val + '][]">@php $product=DB::table("products")->get(); @endphp @foreach ($product as $rowProduct)<option class="{{ $rowProduct->product_name }}">{{ $rowProduct->product_name }}</option>@endforeach</select></div></div>'
                );
                var originalElement = selectTag;
                var clonedElement = originalElement.clone();
                clonedSelectHTML = clonedElement[0].outerHTML;
                $(this).closest('.grid-cols-12').find('.add_other_ac').append(
                    '<div class="grid-cols-12 grid" style="background: #efecec00;border-radius: 8px; margin-bottom: 15px;">' +
                    '<div class="col-span-2 mr-5 mt-3"><div class="input-form"><label style="font-weight:600; line-height:30px;">Type</label>' +
                    clonedSelectHTML +
                    '</div></div>' +
                    '<div class="col-span-2 mr-5 mt-3"><div class="input-form"> <label style="font-weight:600; line-height:30px;"> No Ac </label><input name="newno_ac[' + val + '][]" type="text" required="required" class="form-control no_ac" /></div></div>' +
                    '<div class="col-span-2 mr-5 mt-3"><div class="input-form"><label style="font-weight:600; line-height:30px;"> No of Ton </label><input name="newno_of_ton[' + val + '][]" type="text" required="required" class="form-control no_of_ton" /></div></div>' +
                    '<div class="col-span-1 mr-5 mt-3"><div class="input-form"> <label style="font-weight:600; line-height:30px;"> TotalTon </label><input name="newtotal_ac_ton[' + val + '][]" type="text" required="required" class="form-control total_ac_ton" /></div></div>' +
                    '<div class="col-span-3 mr-5 mt-3"><div class="input-form"> <label style="font-weight:600; line-height:30px;"> Message </label><input name="newmessage[' + val + '][]" type="text" required="required" class="form-control message" /></div></div>' +
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
                var datacount = $(this).data('key');
                var dataKey = parseInt(datacount) + 1;

                // Update the data-key attribute immediately
                $(this).data('key', dataKey);
                var selectTag = $(
                    '<div class="col-span-4 mt-3"><div class="input-form"><select class="form-control select_tag" name="type[' + val + '][' + dataKey + ']">@php $product=DB::table("products")->get(); @endphp @foreach ($product as $rowProduct)<option class="{{ $rowProduct->product_name }}">{{ $rowProduct->product_name }}</option>@endforeach</select></div></div>'
                );
                var originalElement = selectTag;
                var clonedElement = originalElement.clone();
                clonedSelectHTML = clonedElement[0].outerHTML;
                $(this).closest('.grid-cols-12').find('.add_other_ac').append(
                    '<div class="grid-cols-12 grid" style="background: #efecec00;border-radius: 8px; margin-bottom: 15px;">' +
                    '<div class="col-span-2 mr-5 mt-3"><div class="input-form"><label style="font-weight:600; line-height:30px;">Type</label>' +
                    clonedSelectHTML +
                    '</div></div>' +
                    '<div class="col-span-2 mr-5 mt-3"><div class="input-form"> <label style="font-weight:600; line-height:30px;"> No Ac </label><input name="no_ac[' + val + '][' + dataKey + ']" type="text" required="required" class="form-control no_ac" /></div></div>' +
                    '<div class="col-span-2 mr-5 mt-3"><div class="input-form"><label style="font-weight:600; line-height:30px;"> No of Ton </label><input name="no_of_ton[' + val + '][' + dataKey + ']" type="text" required="required" class="form-control no_of_ton" /></div></div>' +
                    '<div class="col-span-1 mr-5 mt-3"><div class="input-form"><label style="font-weight:600; line-height:30px;"> No of Ton </label><input name="total_ac_ton[' + val + '][' + dataKey + ']" type="text" required="required" class="form-control total_ac_ton" /></div></div>' +
                    '<div class="col-span-3 mr-5 mt-3"><div class="input-form"><label style="font-weight:600; line-height:30px;"> No of Ton </label><input name="message[' + val + '][' + dataKey + ']" type="text" required="required" class="form-control message" /></div></div>' +
                  
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
            // Add a script to remove the added AC section if needed
            // $('body').on('click', '.btn_remove_ac', function() {
            //     $(this).closest('.grid-cols-12').remove();
            //     calculateTotalTon();
            // });


            // Calculate total ton when input values change
            $('body').on('input', '.no_of_ton', function() {
                var total = 0;
                var $grid = $(this).closest('.grid-cols-12');
                var no_ac_val = parseFloat($grid.find('.no_ac').val());
                var no_of_ton_val = parseFloat($(this).val());
                var total_ac_ton = no_ac_val * no_of_ton_val;
                        console.log(total_ac_ton);
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


<script>
            function initialize() {
				var marker;
                var map = new google.maps.Map(document.getElementById("map_canvas_0"), {
                    center: new google.maps.LatLng(21.209036, 72.8479451),
                    zoom: 13,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                });
        
				var locationInputId = 'location_0';
		 
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
		
                var searchInput = document.getElementById('search_location');
                // var searchInput = document.createElement('input');
                // searchInput.id = 'search_location';
                // searchInput.type = 'text';
                // searchInput.placeholder = 'Search Location';
                // searchContainer.appendChild(searchInp);ut
        
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
        
            function initMap() {
                // Load the Google Maps JavaScript API script
                var script = document.createElement('script');
                script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCBc-IV1LhwxzZkVbGfqiHKq-wiHayqgU8&libraries=places&callback=initialize';
                script.defer = true;
                document.head.appendChild(script);
            }
        
            // Initialize the map when the window has finished loading
            window.onload = initMap;
        </script>
        
        


        <script>
            var form = document.getElementById('CreateCustomer');
            var mapCanvasElements = document.getElementsByClassName('location');
            form.addEventListener('submit', function(event) {
                if (!isValid()) {
                    event.preventDefault();
                    alert('Location Peak Required');
                }
            });
            function isValid() {
                return true; 
            }
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
