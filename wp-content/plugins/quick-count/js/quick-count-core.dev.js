var quick_count = jQuery.extend(quick_count || {}, {
    single_user_html: function(su, counter, qfc){
        var backend =  (quick_count.action() === 'quick-count-backend') ? 1 : 0, f;

        var str = [quick_count.i18n.count_s];

        if(backend)
            str.push(quick_count.i18n.ip_s);

        if(qfc == 1 && su.cc != null){
            str.push(quick_count.i18n.country_s);
            f = quick_count.cflag_html(su.cc);
        }else{
            f = '';
        }

        str.push(quick_count.i18n.joined_s);

        if(su.bn != null)
            str.push(quick_count.i18n.browser_s);
        else
            str.push(quick_count.i18n.agent_s);

        if(su.r != null && backend)
            str.push(quick_count.i18n.referrer_s);

        return ([
            '<div class="quick-count-list-single-data">',
            str.join(' ').
            replace('%count', counter).
            replace('%name', su.n).
            replace('%ip', su.i).
            replace('%cname', su.cn).
            replace('%cflag', f).
            replace('%joined', su.j).
            replace('%polled', su.p).
            replace(new RegExp('%url', 'g'), su.u).
            replace('%title', su.t).
            replace(new RegExp('%referrer', 'g'), su.r).
            replace('%bname', su.bn).
            replace('%bversion', su.bv).
            replace('%pname', su.pn).
            replace('%pversion', su.pv).
            replace(new RegExp('%agent', 'g'), su.a),
            '</div>'].join(''));
    },
    update: function(){
        jQuery.post(quick_count.ajaxurl, {
            action: quick_count.action(),
            u: document.URL,
            t: document.title,
            r: document.referrer},
            function(data){
                if(typeof(quick_count.users_interval) == "undefined"){
                    quick_count.users_interval = setInterval(function(){
                        quick_count.update();
                    }, quick_count.timeout_refresh_users);
                }

                var i = 0, count_s = [], admins = [], subscribers = [], bots = [], visitors = [],
                admins_s = [], subscribers_s = [], bots_s = [], visitors_s = [],
                admins_count_s = '', subscribers_count_s='', bots_count_s = '',
                visitors_count_s = '',  all_count_s = [], admins_names_s = [],
                subscribers_names_s = [], bots_names_s = [];

                var ul = data.ul;
                if(quick_count.qfc == 1){
                    var cdata = quick_count.get_cdata(ul);
                }

                if(ul.length == 0)
                     count_s.push(quick_count.i18n.zero_s);
                else {
                    if(ul.length == 1)
                        count_s.push(quick_count.i18n.one_s);
                    else
                        count_s.push(quick_count.i18n.multiple_s.replace('%number', ul.length));

                    if(quick_count.qfc == 1){
                        if(cdata.length == 1)
                            count_s.push(quick_count.i18n.one_country_s);
                        else
                            count_s.push(quick_count.i18n.multiple_countries_s.replace('%number', cdata.length));
                    }
                }

                for(i=0;typeof(ul[i])!="undefined";i++){
                    if(ul[i].s == 0){
                        admins.push(ul[i]);
                    }else if(ul[i].s == 1){
                        subscribers.push(ul[i]);
                    }else if(ul[i].s == 3){
                        bots.push(ul[i]);
                    }else if(ul[i].s == 2){
                        visitors.push(ul[i]);
                    }
                }

                if(admins.length != 0){
                    admins_s.push('<div class="quick-count-list-group"><div class="quick-count-list-group-title">');
                    if(admins.length == 1){
                        admins_s.push(quick_count.i18n.one_admin_online_s);
                        admins_count_s = quick_count.i18n.one_admin_s;
                    }else {
                        admins_s.push(quick_count.i18n.multiple_admins_online_s.replace('%number', admins.length));
                        admins_count_s = quick_count.i18n.multiple_admins_s.replace('%number', admins.length);
                    }
                    admins_s.push('</div>');
                    for(i=0;typeof(admins[i])!="undefined";i++){
                        admins_s.push(quick_count.single_user_html(admins[i], i+1, quick_count.qfc));
                        admins_names_s.push(['<strong>',admins[i].n, '</strong>'].join(''));
                    }
                    admins_s.push('</div>');
                    all_count_s.push([admins_count_s, ' (', admins_names_s.join(', '), ')'].join(''));
                }

                if(subscribers.length != 0){
                    subscribers_s.push('<div class="quick-count-list-group"><div class="quick-count-list-group-title">');
                    if(subscribers.length == 1){
                        subscribers_s.push(quick_count.i18n.one_subscriber_online_s);
                        subscribers_count_s = quick_count.i18n.one_subscriber_s;
                    }else {
                        subscribers_s.push(quick_count.i18n.multiple_subscribers_online_s.replace('%number', subscribers.length));
                        subscribers_count_s = quick_count.i18n.multiple_subscribers_s.replace('%number', subscribers.length);
                    }
                    subscribers_s.push('</div>');
                    for(i=0;typeof(subscribers[i])!="undefined";i++){
                        subscribers_s.push(quick_count.single_user_html(subscribers[i], admins.length+i+1, quick_count.qfc));
                        subscribers_names_s.push(['<strong>', subscribers[i].n, '</strong>'].join(''));
                    }
                    subscribers_s.push('</div>');
                    all_count_s.push([subscribers_count_s, ' (', subscribers_names_s.join(', '), ')'].join(''));
                }

                if(bots.length != 0){
                    bots_s.push('<div class="quick-count-list-group"><div class="quick-count-list-group-title">');
                    if(bots.length == 1){
                        bots_s.push(quick_count.i18n.one_bot_online_s);
                        bots_count_s = quick_count.i18n.one_bot_s;
                    }else {
                        bots_s.push(quick_count.i18n.multiple_bots_online_s.replace('%number', bots.length));
                        bots_count_s = quick_count.i18n.multiple_bots_s.replace('%number', bots.length);
                    }
                    bots_s.push('</div>');
                    for(i=0;typeof(bots[i])!="undefined";i++){
                        bots_s.push(quick_count.single_user_html(bots[i], admins.length+subscribers.length+i+1, quick_count.qfc));
                        bots_names_s.push(['<strong>', bots[i].n, '</strong>'].join(''));
                    }
                    bots_s.push('</div>');
                    all_count_s.push([bots_count_s, ' (', bots_names_s.join(', '), ')'].join(''));
                }

                if(visitors.length != 0){
                    visitors_s.push('<div class="quick-count-list-group"><div class="quick-count-list-group-title">');
                    if(visitors.length == 1){
                        visitors_s.push(quick_count.i18n.one_visitor_online_s);
                        visitors_count_s = quick_count.i18n.one_visitor_s;
                    }else {
                        visitors_s.push(quick_count.i18n.multiple_visitors_online_s.replace('%number', visitors.length));
                        visitors_count_s = quick_count.i18n.multiple_visitors_s.replace('%number', visitors.length);
                    }
                    visitors_s.push('</div>');
                    for(i=0;typeof(visitors[i])!="undefined";i++){
                        visitors_s.push(quick_count.single_user_html(visitors[i], admins.length+subscribers.length+bots.length+i+1, quick_count.qfc));
                    }
                    visitors_s.push('</div>');
                    all_count_s.push(visitors_count_s);
                }

                jQuery('div.quick-count-online-count').each(function(){
                     jQuery(this).html(count_s.join(' ')).show();
                });

                jQuery('div.quick-count-online-count-each').each(function(){
                    jQuery(this).html(all_count_s.join(', ')).show();
                });

                if(quick_count.qfc == 1){
                    jQuery('div.quick-count-by-country').each(function(){
                        quick_count.by_country(this, cdata);
                    });
                }

                jQuery('div.quick-count-most-online').each(function(){
                    var most_online_s = quick_count.i18n.most_online_s.replace('%number', data.sn).replace('%time', data.st);
                    jQuery(this).html(most_online_s).show();
                });

                jQuery('div.quick-count-list').each(function(){
                    jQuery(this).html([admins_s.join(''), subscribers_s.join(''), bots_s.join(''), visitors_s.join('')].join('')).show();
                });

                if(quick_count.qfc == 1){
                    jQuery('div.quick-count-visitors-map').each(function(){
                        var self = jQuery(this);
                        var width;
                        if(quick_count.action() === 'quick-count-backend')
                            width = 60;
                        else
                            width = 95;

                        quick_count.map(self, cdata, width);
                    });
                }

                var loading = jQuery('div.quick-count-loading');
                if(loading.is(':visible'))
                    loading.hide();
            },
            'json'
        );
    }
});

quick_count.update();