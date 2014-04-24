<script type="text/javascript">
	var ____prototype_ae_IE9JumpList = ____prototype_ae_IE9JumpList || {};

(function( jumplist ) {
	if ( !navigator.userAgent.toLowerCase().match(/msie (9|10)(\.?[0-9]*)*/) ) {
		return;
	}
	
	var options = {

		// Basic site information	
		siteName: 'Cucak.am', // Site Name
		applicationName: 'Cucak.am', // Site Name 
		startURL: 'http://cucak.am', // Homepage URL 
		shortcutIcon: 'https://buildmypinnedsite.blob.core.windows.net/files/JumpList/634940236644434032/Main-favicon.ico', // Main Site Icon
		tooltip: '',

		// Dynamic jumplist tasks & notifications
		rssFeedURL: 'http://www.buildmypinnedsite.com/RSSFeed?feed=http%3a%2f%2fcucak.am%2f%3ffeed%3drss',
		categoryTitle: '<?php _e('Last news') ?>', // Task group name
		defaultTaskIcon: 'https://buildmypinnedsite.blob.core.windows.net/files/JumpList/634940236644434032/GenericTask-1358448924_28308.ico', // Generic task icon
		
		navButtonColor: false,
		
		// Jumplist tasks { name: Task Label, action: Task URL, icon: Task Icon }
		staticTasks: [
						{ name: '<?php _e('Add an announcement') ?>',  action: 'http://cucak.am/addnew/', icon: 'https://buildmypinnedsite.blob.core.windows.net/files/JumpList/634940236644434032/Task0-1358448635_22608.ico', target: 'tab' },
						{ name: '<?php _e('Become a partner') ?>',  action: 'http://cucak.am/private', icon: 'https://buildmypinnedsite.blob.core.windows.net/files/JumpList/634940236644434032/Task1-1358448764_43626.ico', target: 'tab' }
					],
		
		// Drag and drop site pinning bar		
		prompt: true, // Add a site pinning bar on top of my site pages
		barSiteName: 'Cucak.am' // Site name as it should appear on the pinning bar
	};
	
	var lib = {
		dom: {
			meta: function(name, content) {
				var meta = document.createElement('meta');
				meta.setAttribute('name', name);
				meta.setAttribute('content', content);		
				return meta;
			},
			link: function(rel, href) {
				var link = document.createElement('link');
				link.setAttribute('rel', rel);
				link.setAttribute('href', href);
				return link;
			},
			div: function() {
				return document.createElement('div');
			}
		},
		net: {
			getJSONP: function( URL ) {
				var script = document.createElement('script');
				script.type = 'text/javascript';
				script.src = URL + ( URL.indexOf('?') != -1 ? '&' : '?' ) + Date.now();
				var head = document.getElementsByTagName('head')[0];
				head.insertBefore(script, head.firstChild);
			}
		}
	};
	
	jumplist.parseRSSFeed = function parseRSSFeed( news ) {
		try {
			if ( window.external.msIsSiteMode() ) {
				window.external.msSiteModeClearJumpList();
				window.external.msSiteModeCreateJumpList( options.categoryTitle );
				
				try {
					// RSS feeds
					if ( news.rss && news.rss.channel && news.rss.channel.item ) {
						for ( var items = news.rss.channel.item.slice(0, 10), numItems = items.length, i = numItems-1, task, pubDate, taskTitle = ''; i >= 0; i-- ) {
							task = items[i];
							pubDate = Date.parse( task.pubDate );
							taskTitle = task.title ? ( typeof task.title == 'string' ? task.title : task.title['#cdata-section'] || '' ) : '';
							window.external.msSiteModeAddJumpListItem( taskTitle, task.link, options.defaultTaskIcon );
						}
					} else if ( news.feed && news.feed.entry ) { // Atom feeds
						for ( var items = news.feed.entry.slice(0, 10), numItems = items.length, i = numItems-1, task, pubDate, taskTitle = '', link = {}; i >= 0; i-- ) {
							task = items[i];
							pubDate = Date.parse( task.published );
							taskTitle = task.title ? ( typeof task.title == 'string' ? task.title : (task.title['#cdata-section'] ? task.title['#cdata-section'] : task.title['#text'] || '')) : '';

							if ( task.link ) {
								if ( typeof task.link == 'string') {
									link['@href'] = task.link || '#';
								} else if ( Object.prototype.toString.call( task.link ) === '[object Array]') {
									link = task.link[0];
								} else {
									link = task.link;
								}
							}

							window.external.msSiteModeAddJumpListItem( taskTitle, link['@href'] || '#', options.defaultTaskIcon );
						
						}
					}

				} catch ( ex ) {			
				}

				window.external.msSiteModeShowJumpList();
			} else {
			}
		}
		catch ( ex ) {
		}
	}
	
	// Init code
	document.addEventListener('DOMContentLoaded', function() {
		
		try { 
			document.getElementsByTagName('body')[0].onfocus = function() {
				window.external.msSiteModeClearIconOverlay();
			};
		} catch(err) {
		}
		
		var head = document.getElementsByTagName('head');
		
		if ( !head ) {
			return;
		}
		
		head = head[0];
		
		var links = document.getElementsByTagName('link'), remove = [];
		
		for ( var i = 0, rel; i < links.length; i++ ) {
			rel = links[i].getAttribute('rel');
			if ( !rel ) {
				continue;
			}
			rel = rel.toLowerCase().replace(/^\s+|\s+$/g, '').replace(/\s+/g, ' ');
			if ( rel == 'icon' || rel == 'shortcut icon' ) {
				remove.push( links[i] );
			}
		}
		
		for ( i = 0; i < remove.length; i++ ) {
			head.removeChild( remove[i] );
		}
		
		if ( options.shortcutIcon ) {
			head.appendChild( lib.dom.link('shortcut icon', options.shortcutIcon) );
		}
		
		head.appendChild( lib.dom.meta('application-name', options.applicationName) );
		head.appendChild( lib.dom.meta('msapplication-tooltip', options.tooltip) );
		
		if ( options.navButtonColor ) {
			head.appendChild( lib.dom.meta('msapplication-navbutton-color', options.navButtonColor) );
		}
		
		if ( options.startURL ) {
			head.appendChild( lib.dom.meta('msapplication-starturl', options.startURL) );
		}
	
		for ( var i = 0, task; i < options.staticTasks.length; i++ ) {
			task = options.staticTasks[i];
			head.appendChild( lib.dom.meta('msapplication-task', 'name=' + task.name + ';action-uri=' + task.action + ';icon-uri=' + task.icon + ';window-type=' + task.target ) );
		}
		
		jumplist.poll = function() {
			lib.net.getJSONP( options.rssFeedURL, jumplist.parseRSSFeed );
		};
		
		window.setTimeout( jumplist.poll, 30 );
	});
})( ____prototype_ae_IE9JumpList );
</script>