var quick_count = jQuery.extend(quick_count || {}, {
    get_script: function(url, callback, options) {
        options = jQuery.extend(options || {}, {
            crossDomain: (quick_count.script_suffix == '.dev')? true : false,
            dataType: "script",
            cache: true,
            success: callback,
            url: url
        });

        return jQuery.ajax(options);
    },
    load: function(){
        quick_count.get_script(quick_count.url+'js/quick-count-core'+quick_count.script_suffix+'.js?'+quick_count.version);
    },
    action: function(){
        return 'quick-count-backend';
    }
});

jQuery(document).ready(function(){
    if(jQuery('div.quick-count').length != 0){
        if(quick_count.qfc == 1){
            if(jQuery('div.quick-count-visitors-map').length != 0){
                quick_count.get_script(quick_count.url+'js/jquery.vmap'+quick_count.script_suffix+'.js?'+quick_count.jqvmap_version, function(){
                    quick_count.get_script(quick_count.url+'js/jquery.vmap.world.js', function(){
                        quick_count.get_script(quick_count.url+'js/quick-count-quick-flag'+quick_count.script_suffix+'.js?'+quick_count.version, function(){
                            quick_count.load();
                        });
                    });
                });
            } else{
                quick_count.get_script(quick_count.url+'js/quick-count-quick-flag'+quick_count.script_suffix+'.js?'+quick_count.version, function(){
                    quick_count.load();
                });
            }
        } else{
            quick_count.load();
        }
    } else{
        quick_count.keepalive();
    }
});