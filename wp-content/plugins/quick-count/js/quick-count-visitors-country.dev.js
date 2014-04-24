var quick_count = jQuery.extend(quick_count || {}, {
    visitors_country_map: function(){
        var map_element = jQuery('div.quick-count-visitors-map');

        quick_count.map(map_element, quick_count.cdata, 60);
    }
}, quick_count_visitors_country || {});

jQuery(document).ready(function(){
    if(quick_count.qfc == 1){
        quick_count.visitors_country_map();
    }
});