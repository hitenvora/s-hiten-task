@extends('../layouts/side-menu')

@php

    // echo $layout;exit;
@endphp

@section('subhead')
    <title>Create Customer</title>
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
    <div class="intro-y mt-3 flex items-center" style="margin-bottom:13px;">

        <h2 class="mr-auto text-lg font-medium" style="font-size:22px;">Create Customer</h2>

    </div>

    <div class="grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12 lg:col-span-12"
            style="padding: 20px 32px;border: 1px solid #e1dede;border-radius: 6px;box-shadow: 0 3px 10px rgb(69 14 33 / 20%);background: white;border-top: 7px solid #164e63;">
            <form action="{{ route('create.customer.form.add1') }}" method="post" enctype="multipart/form-data"
                id="CreateCustomer">
                <div class='grid-cols-12 grid'>
                    <div class='col-span-6 mr-5'>
                        <div class="input-form">
                            <label style="font-weight:600; line-height:30px;"> Name </label>
                            <input name="name" type="text" required="required" class="form-control" />
                        </div>
                    </div>
                    <div class='col-span-6 mr-5'>
                        <div class="input-form">
                            <label style="font-weight:600; line-height:30px;"> Mobile No </label>
                            <input name="phone_no" type="text" class="form-control" maxlength="10" minlength="10" />
                        </div>
                    </div>
                </div>
                <div class='grid-cols-12 grid main_addredd_div'
                    style="background: #efecec00;margin-top: 20px;border-radius: 8px;margin-bottom: 15px;">
                    <div class='col-span-3 mr-5 mt-3'>
                        <div class="input-form">
                            <label style="font-weight:600; line-height:30px;"> Location Type </label>
                            <input name="location_type[0]" type="text" required="required" class="form-control"
                                placeholder="Home/Office/Other" />
                        </div>
                    </div>
                    <div class='col-span-3 mr-5 mt-3'>
                        <div class="input-form">
                            <label style="font-weight:600; line-height:30px;"> Pincode </label>
                            <input name="pincode[0]" type="text" required="required" class="form-control" />
                        </div>
                    </div>
                    <div class='col-span-6 mt-3'>
                        <div class="input-form">
                            <label style="font-weight:600; line-height:30px;"> Address </label>
                            <input name="address[0]" type="text" required="required" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="ac_type">
                    <div class="grid-cols-12 grid ">
                        <div class='col-span-2 mr-5 mt-3 '>
                            <div class="input-form">
                                <label style="font-weight:600; line-height:30px;"> Type </label>
                                <select class="form-control select_tag" name='type[0][]'>
                                    @php
                                        $product = DB::table('products')->get();
                                    @endphp
                                    @foreach ($product as $rowProduct)
                                        <option class='{{ $rowProduct->product_name }}'>{{ $rowProduct->product_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class='col-span-2 mr-5 mt-3 '>
                            <div class="input-form">
                                <label style="font-weight:600; line-height:30px;"> No Ac </label>
                                <input name="no_ac[0][]" type="text" required="required" class="form-control no_ac" />
                            </div>
                        </div>
                        <div class='col-span-2 mr-5 mt-3' style="margin-bottom: 15px;">
                            <div class="input-form">
                                <label style="font-weight:600; line-height:30px;"> No of Ton </label>
                                <input name="no_of_ton[0][]" type="text" required="required" class="form-control no_of_ton" />
                            </div>
                        </div>
                        <div class='col-span-1 mr-5 mt-3' style="margin-bottom: 15px;">
                            <div class="input-form">
                                <label style="font-weight:600; line-height:30px;"> Total Ton</label>
                                <input name="total_ac_ton[0][]" type="text" required="required" class="form-control total_ac_ton" />
                            </div>
                        </div>
                        <div class='col-span-3 mr-5 mt-3' style="margin-bottom: 15px;">
                            <div class="input-form">
                                <label style="font-weight:600; line-height:30px;"> Message </label>
                                <input name="message[0][]" type="text" required="required" class="form-control message" />
                            </div>
                        </div>
                        <div class='col-span-1 mt-10'>
                            <label style="font-weight:600; line-height:30px;"></label>
                            <button class='btn btn-success btn_add_ac' value="0" type='button'>Add</button>
                        </div>
                        <div class="col-span-1 mt-3">
                            <label style="font-weight:600; line-height:30px;">Total Ton  </label>
                            <input type="text" class="form-control total_ton" readonly>
                        </div>
                        <div class='add_other_ac col-span-12'></div>
                        <div class='col-span-12'>
                            <div id="search_container" style="margin-bottom: 0.75rem;"><input id="search_location" type="text" placeholder="Search Location" class="pac-target-input" autocomplete="off"></div>
                            <div id="map_canvas_0" class="map_canvas" style="border: 2px solid #3872ac; height: 300px;">
                            </div>
                            <input id="location_0" name="location[0]" type="text" class="location"
                                placeholder="Click on the map to set location" required="required" id="" style="display: none">
                        </div>
                    </div>
                </div>
                <div class='add_other_address'>
                </div>
                @csrf
                <button type="submit"
                    class="text-center transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;amp;:hover:not(:disabled)]:border-opacity-90 [&amp;amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mt-5 mt-5">Register</button>
                <button class='btn btn-success btn_add_address' type='button'>Add-Address</button>
            </form>
        </div>

    </div>

    <script>
        // const inputElements = document.querySelectorAll('input[type="text"]');



        // function generateRandomValue() {

        //     return Math.random().toString(36).substring(2, 10); // Random alphanumeric string

        // }



        // inputElements.forEach((input) => {

        //     input.value = generateRandomValue();

        // });
    </script>
@endsection

@once

    @push('script')
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBc-IV1LhwxzZkVbGfqiHKq-wiHayqgU8&sensor=true"
            type="text/javascript"></script>

        {{-- <script>
            var typeIndex = 1; // Initialize the index counter
        
            $('body').on('click', '.btn_add_address', function () {
                var originalElement = $(".select_tag");
                var clonedElement = originalElement.clone();
                clonedElement.attr('name', 'type[' + typeIndex + '][]'); // Update the name attribute with auto-incremented index
                clonedSelectHTML = clonedElement[0].outerHTML;
        
                $('.add_other_address').append(
                    '<div class="grid-cols-12 grid" style="background: #efecec00;border-radius: 8px; margin-bottom: 15px;">' +
                    '<div class="col-span-3 mr-5 mt-3"><div class="input-form">' +
                    '<label style="font-weight:600; line-height:30px;">Location Type</label>' +
                    '<input name="location_type[' + typeIndex + ']" type="text" placeholder="Home/Office/Other" required="required" class="form-control">' +
                    '</div></div>' +
                    '<div class="col-span-3 mr-5 mt-3"><div class="input-form">' +
                    '<label style="font-weight:600; line-height:30px;"> Pincode </label>' +
                    '<input name="pincode[' + typeIndex + ']" type="text" required="required" class="form-control" />' +
                    '</div></div>' +
                    '<div class="col-span-6 mr-5 mt-3"><div class="input-form">' +
                    '<label style="font-weight:600; line-height:30px;">Address</label>' +
                    '<input name="address[' + typeIndex + ']" type="text" required="required" class="form-control">' +
                    '</div></div>' +
                    '<div class="col-span-2 mr-5 mt-3"><div class="input-form">' +
                    '<label style="font-weight:600; line-height:30px;">Type</label>' +
                    clonedSelectHTML +
                    '</div></div>' +
                    '<div class="col-span-2 mr-5 mt-3"><div class="input-form">' +
                    '<label style="font-weight:600; line-height:30px;"> No Ac </label>' +
                    '<input name="no_ac[' + typeIndex + '][]" type="text" required="required" class="form-control no_ac" />' +
                    '</div></div>' +
                    '<div class="col-span-2 mr-5 mt-3"><div class="input-form">' +
                    '<label style="font-weight:600; line-height:30px;"> No of Ton </label>' +
                    '<input name="no_of_ton[' + typeIndex + '][]" type="text" required="required" class="form-control no_of_ton" />' +
                    '</div></div>' +
                    '<div class="col-span-1 mr-5 mt-3"><div class="input-form">' +
                    '<label style="font-weight:600; line-height:30px;"> No of Ton </label>' +
                    '<input name="total_ac_ton[' + typeIndex + '][]" type="text" required="required" class="form-control total_ac_ton" />' +
                    '</div></div>' +
                    '<div class="col-span-3 mr-5 mt-3"><div class="input-form">' +
                    '<label style="font-weight:600; line-height:30px;"> Message </label>' +
                    '<input name="message[' + typeIndex + '][]" type="text" required="required" class="form-control message" />' +
                    '</div></div>' +
                    
                    '<div class="col-span-1 mr-5 mt-3">' +
                    '<button class="btn btn-success btn_add_ac" type="button" value="' + typeIndex + '" style=" margin-top: 30px;">Add</button>' +
                    '</div>' +
                    '<div class="add_other_ac col-span-12"></div>' +
                    '<div class="col-span-12 mr-5 mt-3">' +
                    '<button class="btn btn-success btn_remove_address" type="button" style=" margin-top: 30px;">Remove</button>' +
                    '</div>' +
                    '</div>'
                );
                // Increment the index for the next clone
                typeIndex++;
            });
        
            // Add a script to remove the added address if needed
            $('body').on('click', '.btn_remove_address', function () {
                $(this).closest('.grid-cols-12').remove();
            });
        </script> --}}

        <script>
            var typeIndex = 1; // Initialize the index counter

            $('body').on('click', '.btn_add_address', function() {
                var originalElement = $(".select_tag");
                var clonedElement = originalElement.clone();
                clonedElement.attr('name', 'type[' + typeIndex +
                '][]'); // Update the name attribute with auto-incremented index
                clonedSelectHTML = clonedElement[0].outerHTML;

                var mapId = 'map_canvas_' + typeIndex;
                var locationInputId = 'location_' + typeIndex;

                $('.add_other_address').append(
                    '<div class="grid-cols-12 grid" style="background: #efecec00;border-radius: 8px; margin-bottom: 15px;">' +
                    '<div class="col-span-3 mr-5 mt-3"><div class="input-form">' +
                    '<label style="font-weight:600; line-height:30px;">Location Type</label>' +
                    '<input name="location_type[' + typeIndex +
                    ']" type="text" placeholder="Home/Office/Other" required="required" class="form-control">' +
                    '</div></div>' +
                    '<div class="col-span-3 mr-5 mt-3"><div class="input-form">' +
                    '<label style="font-weight:600; line-height:30px;"> Pincode </label>' +
                    '<input name="pincode[' + typeIndex +
                    ']" type="text" required="required" class="form-control" />' +
                    '</div></div>' +
                    '<div class="col-span-6 mr-5 mt-3"><div class="input-form">' +
                    '<label style="font-weight:600; line-height:30px;">Address</label>' +
                    '<input name="address[' + typeIndex +
                    ']" type="text" required="required" class="form-control">' +
                    '</div></div>' +
                    '<div class="col-span-2 mr-5 mt-3"><div class="input-form">' +
                    '<label style="font-weight:600; line-height:30px;">Type</label>' +
                    clonedSelectHTML +
                    '</div></div>' +
                    '<div class="col-span-2 mr-5 mt-3"><div class="input-form">' +
                    '<label style="font-weight:600; line-height:30px;"> No Ac </label>' +
                    '<input name="no_ac[' + typeIndex +
                    '][]" type="text" required="required" class="form-control no_ac" />' +
                    '</div></div>' +
                    '<div class="col-span-2 mr-5 mt-3" style="margin-bottom: 15px;"><div class="input-form">' +
                    '<label style="font-weight:600; line-height:30px;"> No of Ton </label>' +
                    '<input name="no_of_ton[' + typeIndex +
                    '][]" type="text" required="required" class="form-control no_of_ton" />' +
                    '</div></div>' +
                    '<div class="col-span-1 mr-5 mt-3" style="margin-bottom: 15px;"><div class="input-form">' +
                    '<label style="font-weight:600; line-height:30px;"> TotalTon </label>' +
                    '<input name="total_ac_ton[' + typeIndex +
                    '][]" type="text" required="required" class="form-control total_ac_ton" />' +
                    '</div></div>' +
                    '<div class="col-span-3 mr-5 mt-3" style="margin-bottom: 15px;"><div class="input-form">' +
                    '<label style="font-weight:600; line-height:30px;"> Message </label>' +
                    '<input name="message[' + typeIndex +
                    '][]" type="text" required="required" class="form-control message" />' +
                    '</div></div>' +

                   
                    '<div class="col-span-1 mr-5 mt-3">' +
                    '<button class="btn btn-success btn_add_ac" type="button" value="' + typeIndex +
                    '" style=" margin-top: 30px;">Add</button>' +
                    '</div>' +
                    '<div class="col-span-12 mr-5 mt-3 mb-3">' +
                    '<div id="search_container_' + mapId + '" style="text-align: right; margin-bottom: 1px;"></div>' +
                    '</div>' +
                    '<div class="add_other_ac col-span-12"></div>' +
                    '<div class="col-span-12">' +

                    '<div id="' + mapId +
                    '" class="map_canvas" style="border: 2px solid #3872ac; height: 300px;"></div>' +
                    '<input id="' + locationInputId + '" name="location[' + typeIndex +
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
            $('body').on('click', '.btn_remove_address', function() {
                $(this).closest('.grid-cols-12').remove();
            });

            // function initializeMap(mapId, locationInputId) {
            //     var map;
            //     var infowindow = new google.maps.InfoWindow();
            //     var marker;

            //     map = new google.maps.Map(
            //         document.getElementById(mapId), {
            //             center: new google.maps.LatLng(21.209036, 72.8479451),
            //             zoom: 13,
            //             mapTypeId: google.maps.MapTypeId.ROADMAP
            //         });

            //     google.maps.event.addListener(map, 'click', function(e) {
            //         var latLng = e.latLng;

            //         if (marker) {
            //             marker.setMap(null);
            //         }

            //         marker = new google.maps.Marker({
            //             position: latLng,
            //             map: map,
            //         });

            //         // Update the location input field with the coordinates
            //         document.getElementById(locationInputId).value = latLng.lat() + ',' + latLng.lng();
            //     });
            // }
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

			// function initMap() {
			//     initializeMap("map_canvas_0", "location_input_id");
			// }

			// Load the Google Maps JavaScript API script
			var script = document.createElement('script');
			script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCBc-IV1LhwxzZkVbGfqiHKq-wiHayqgU8&libraries=places&callback=initMap';
			script.defer = true;
			document.head.appendChild(script);
        </script>



        <script>
            $(document).ready(function() {
            $('body').on('click', '.btn_add_ac', function() {
                var val = $(this).val()
                var originalElement = $(".select_tag");
                var clonedElement = originalElement.clone();
                clonedElement.attr('name', 'type[' + val +
                '][]'); // Update the name attribute with auto-incremented index
                clonedSelectHTML = clonedElement[0].outerHTML;
                $(this).closest('.grid-cols-12').find('.add_other_ac').append(
                    '<div class="grid-cols-12 grid" style="background: #efecec00;border-radius: 8px; margin-bottom: 15px;">' +
                    '<div class="col-span-2 mr-5 mt-3"><div class="input-form"><label style="font-weight:600; line-height:30px;">Type</label>' +
                    clonedSelectHTML +
                    '</div></div>' +
                    '<div class="col-span-2 mr-5 mt-3"><div class="input-form"> <label style="font-weight:600; line-height:30px;"> No Ac </label><input name="no_ac[' +
                    val + '][]" type="text" required="required" class="form-control no_ac" /></div></div>' +
                    '<div class="col-span-2 mr-5 mt-3"><div class="input-form"><label style="font-weight:600; line-height:30px;"> No of Ton </label><input name="no_of_ton[' +
                    val + '][]" type="text" required="required" class="form-control no_of_ton" /></div></div>' +
                    '<div class="col-span-1 mr-5 mt-3" ><div class="input-form"><label style="font-weight:600; line-height:30px;"> Totalton </label><input name="total_ac_ton[' +
                    val + '][]" type="text" required="required" class="form-control total_ac_ton" /></div></div>' +
                    '<div class="col-span-3 mr-5 mt-3"><div class="input-form"><label style="font-weight:600; line-height:30px;"> Message </label><input name="message[' +
                    val + '][]" type="text" required="required" class="form-control message" /></div></div>' +
                    '<div class="col-span-2 mr-5 mt-3"><button class="btn btn-success btn_remove_ac" type="button" style=" margin-top: 30px;">Remove</button></div>' +
                    '</div>'
                );
            });
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
        {{-- <script>
    $('body').on('click', '.btn_add_ac', function() {
        var originalElement = $(".select_tag");
        var clonedElement = originalElement.clone();
        clonedSelectHTML = clonedElement[0].outerHTML;
        $('.add_other_ac').append(
            '<div class="grid-cols-12 grid" style="background: #efecec00;border-radius: 8px; margin-bottom: 15px;"><div class="col-span-3 mr-5 mt-3"><div class="input-form"> <label style="font-weight:600; line-height:30px;"> No Ac </label><input name="no_ac[]" type="text" required="required" class="form-control" /></div></div><div class="col-span-3 mr-5 mt-3"><div class="input-form"><label style="font-weight:600; line-height:30px;"> No of Ton </label><input name="no_of_ton[]" type="text" required="required" class="form-control" /></div></div><div class="col-span-3 mr-5 mt-3"><div class="input-form"><label style="font-weight:600; line-height:30px;">Type</label>' +
            clonedSelectHTML +
            '</div></div><div class="col-span-3 mr-5 mt-3"><button class="btn btn-success btn_remove_address" type="button" style=" margin-top: 30px;">Remove</button></div></div>'
            );
    });
</script> --}}
        {{-- <script>
    // jQuery code to handle button clicks
    $(document).ready(function () {
        // Add button click event
        $('bod').on('click', '.btn_add_ac', function () {
            // Clone the template set of fields
            var clonedFields = $('.grid.ac_type').clone();

            // Replace "Add" button with "Remove" button
            clonedFields.find('.btn_add_ac').replaceWith('<button class="btn btn-danger btn_remove_ac" type="button">Remove</button>');

            // Append the cloned set of fields to the container
            $('.add_other_ac').append(clonedFields);
        });

        // Remove button click event for dynamically added "Remove" buttons
        $(document).on('click', '.btn_remove_ac', function () {
            $(this).closest('.grid.ac_type').remove();
        });
    });
</script> --}}

        // <script>
        //     var map;
        //     var infowindow = new google.maps.InfoWindow();
        //     var marker;

        //     function initialize() {
        //         map = new google.maps.Map(
        //             document.getElementById("map_canvas_0"), {
        //                 center: new google.maps.LatLng(21.209036, 72.8479451),
        //                 zoom: 13,
        //                 mapTypeId: google.maps.MapTypeId.ROADMAP
        //             });
        //         google.maps.event.addListener(map, 'click', function(e) {
        //             var latLng = e.latLng;
        //             // Remove existing marker if any
        //             if (marker) {
        //                 marker.setMap(null);
        //             }
        //             // Set a new marker at the clicked location
        //             marker = new google.maps.Marker({
        //                 position: latLng,
        //                 map: map,
        //             });
        //             // Update the location input field with the coordinates
        //             document.getElementById('location_0').value = latLng.lat() + ',' + latLng.lng();
        //         });
        //     }
        //     google.maps.event.addDomListener(window, "load", initialize);
        // </script>
        
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
