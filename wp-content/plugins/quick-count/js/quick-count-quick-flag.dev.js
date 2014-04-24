var quick_count = jQuery.extend(quick_count || {}, {
    map_cdata: {},
    tooltip_width: 0,
    tooltip_height: 0,
    map_loaded: false,
    map_cflag_html: function(code){
        return ['<img class="quick-count-flags quick-count-map-flag" src="',
            quick_count.quick_flag_url,
            '/',
            code,
            '.gif" />'].join('');
    },
    cflag_html: function(code){
        return ['<img class="quick-count-flag" src="',
            quick_count.quick_flag_url,
            '/',
            code,
            '.gif" />'].join('');
    },
    map: function(el, cdata, width){
        jQuery(el).show();

        el.css({'width': width+'%'});

        var map_w = el.width();
        el.height(Math.round(2/3 * map_w));

        for(var mccode in quick_count.map_cdata){
            quick_count.map_cdata[mccode] = 0;
        }

        if(jQuery.isArray(cdata)){
            for(var i=0;typeof(cdata[i])!='undefined';i++){
                quick_count.map_cdata[cdata[i][0].cc.toLowerCase()] = cdata[i].length;
            }
        }else{
            for(var ccode in cdata){
                quick_count.map_cdata[ccode.toLowerCase()] = cdata[ccode];
            }
        }

        if(el.children().length == 0){
            el.vectorMap({
                map: 'world_en',
                hoverOpacity: 0.7,
                enableZoom: true,
                showTooltip: false,
                values: quick_count.map_cdata,
                onRegionOver: function(event, code, region){
                    var html = [region, quick_count.map_cflag_html(code.toUpperCase())]
                    if(typeof(quick_count.map_cdata[code]) != 'undefined')
                        html.push('('+quick_count.map_cdata[code]+')');
                    else
                        html.push('(0)');

                    quick_count.tooltip.html(html.join(' ')).show();
                    quick_count.tooltip_width = quick_count.tooltip.width();
                    quick_count.tooltip_height = quick_count.tooltip.height();
                },
                onRegionOut: function(event, code, region){
                    quick_count.tooltip.hide();
                },

                backgroundColor: '#505050',
                color: '#ffffff',
                hoverColor: 'black',
                selectedColor: null,
                scaleColors: ['#D0ECD2', '#109618']
            });
        }else{
            el.vectorMap('set', 'values', quick_count.map_cdata);
        }

        if(quick_count.map_loaded == false){
            jQuery(el).mousemove(function(e){
                if(quick_count.tooltip.is(':visible')){
                  quick_count.tooltip.css({
                    left: e.pageX - 15 - quick_count.tooltip_width,
                    top: e.pageY - 15 - quick_count.tooltip_height
                  });
                }
            });
        }
    },
    by_country: function(el, cdata){
        var by_country_s = [];

        cdata.sort(function(a, b) {
            if (a.length > b.length)
                return -1;
            if (a.length < b.length)
                return 1;

            if (b[0].cn < b[0].cn)
                return -1;
            if (a[0].cn > b[0].cn)
                return 1;

            return 0;
        });

        for(var i=0;typeof(cdata[i])!="undefined";i++){
            by_country_s.push(
                [
                    '<div class="quick-count-by-country-element-container" title="',
                    cdata[i][0].cn,
                    '">',
                        '<div class="quick-count-by-country-element-upper">',
                            cdata[i].length,
                        '</div>',
                        '<div class="quick-count-by-country-element-lower">',
                            quick_count.cflag_html(cdata[i][0].cc),
                        '</div>',
                    '</div>'
                ].join('')
            );
        }

        jQuery(el).html(by_country_s.join('')).show();
    },
    get_cdata: function(ul){
        var c = [], i, j;
        for(i=0;typeof(ul[i])!="undefined";i++){
            if(ul[i].cc != null){
                var country_exists = 0;
                for(j=0;typeof(c[j])!="undefined";j++)
                    if(c[j][0].cc == ul[i].cc){
                        c[j].push(ul[i]);
                        country_exists = 1;
                        break;
                    }

                if(country_exists == 0)
                   c.push([ul[i]]);
            }
        }

        return c;
    }
});

jQuery(document).ready(function(){
    quick_count.tooltip = jQuery('<div/>').attr('id', 'quick-count-tooltip').appendTo(jQuery('body'));
});