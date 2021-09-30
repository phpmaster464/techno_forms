let add_autocomplete;
let add_addressField;
function AddressAuto(selAddress,showDiv1,showDiv2,subPremise,streetNumber,streetName,suburb,state,postcode,lat,long){
	//console.log(selAddress,showDiv1,showDiv2,subPremise,streetNumber,streetName,suburb,state,postcode,lat,long);
	Add_initAutocomplete(selAddress,showDiv1,showDiv2,subPremise,streetNumber,streetName,suburb,state,postcode,lat,long);
}

function Add_initAutocomplete(selAddress,showDiv1,showDiv2,subPremise,streetNumber,streetName,suburb,state,postcode,lat,long) {
	
    add_addressField = document.querySelector(selAddress);
    add_autocomplete = new google.maps.places.Autocomplete(add_addressField, {
                        componentRestrictions: {
                            country: ["au"]
                        },
                        fields: ["address_components", "geometry"],
                        types: ["address"],
                    });
    add_autocomplete.addListener("place_changed", function(){ 
    	Add_fillInAddress(showDiv1,showDiv2,subPremise,streetNumber,streetName,suburb,state,postcode,lat,long)
    });
    
}	

function Add_fillInAddress(showDiv1,showDiv2,subPremise,streetNumber,streetName,suburb,state,postcode,lat,long){

	$(showDiv1).show();
    $(showDiv2).show();
    const place = add_autocomplete.getPlace();
    
	$(lat).val(place.geometry.location.lat());
	$(long).val(place.geometry.location.lng());
	

    //console.log("lat is"+place.geometry.location.lat());
    //console.log("lng is"+place.geometry.location.lng());

    for (const component of place.address_components) {
        const componentType = component.types[0];
        //console.log(componentType);
        //console.log(component.long_name);
        //console.log(component.short_name);


        switch (componentType) {

            case "subpremise": {
                $(subPremise).val(component.long_name);
            }

            case "street_number": {
                $(streetNumber).val(component.long_name);
            }

            case "route": {
                $(streetName).val(component.short_name);
            }

            case "locality": {
                $(suburb).val(component.long_name);
            }

            case "administrative_area_level_1": {

                $(state).val(component.short_name).trigger('change');;
            }

            case "postal_code": {

                $(postcode).val(component.short_name);
            }

        }

    }
}
