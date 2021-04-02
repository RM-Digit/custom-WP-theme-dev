(function(){
    /**
    * Get data from server by ajax, then render the select option
    */
    function renderFont(){
        var listFont =  [{'key':'quest-icon  quest-disaster-recovery-workshop','value':'Disaster recovery workshop'},{'key':'quest-icon quest-risk-management-workshop','value':'Risk management workshop'},{'key':'quest-icon quest-network-health-infrastruture','value':'Network health infrastruture'},{'key':'quest-icon quest-managed-it-cloud-new', 'value': 'Managed it cloud new'},{'key':'quest-icon  quest-it-infrastructure-new' , 'value':'It infrastructure new'},{'key':'quest-icon  quest-backup-data-recovery', 'value': 'Backup data recovery'},{"key":"quest-icon quest-it-infrastructure","value":"IT Infrastructure"},{"key":"quest-icon quest-disaster-recovery","value":"Disaster Recovery"},{"key":"quest-icon quest-agriculture","value":"Agriculture"},{"key":"quest-icon quest-commercial","value":"Commercial"},{"key":"quest-icon quest-contact","value":"Contact"},{"key":"quest-icon quest-cybersecurity","value":"Cybersecurity"},{"key":"quest-icon quest-date","value":"Date"},{"key":"quest-icon quest-document","value":"Document"},{"key":"quest-icon quest-financial","value":"Financial"},{"key":"quest-icon quest-government","value":"Government"},{"key":"quest-icon quest-healthcare","value":"Health Care"},{"key":"quest-icon quest-legal","value":"Legal"},{"key":"quest-icon quest-location","value":"Location"},{"key":"quest-icon quest-mail","value":"Mail"},{"key":"quest-icon quest-managed-it-cloud","value":"Managed IT Cloud"},{"key":"quest-icon quest-person","value":"Person"},{"key":"quest-icon quest-professional-services","value":"Professional Services"},{"key":"quest-icon quest-technology","value":"Technology"},{"key":"quest-icon quest-time","value":"Time"},{"key":"quest-icon quest-workshop","value":"Workshop"},{"key":"quest-icon quest-video","value":"Video"},{"key":"quest-icon quest-newsletter","value":"Newsletter"},{"key":"quest-icon quest-solution-brief","value":"Solution Brief"},{"key":"quest-icon quest-assessment","value":"Assessment"},{"key":"quest-icon quest-blog","value":"Blog"},{"key":"quest-icon quest-infographic","value":"Infographic"},{"key":"fa fa-address-book","value":"address-book"},{"key":"fa fa-address-book-o","value":"address-book-o"},{"key":"fa fa-address-card","value":"address-card"},{"key":"fa fa-address-card-o","value":"address-card-o"},{"key":"fa fa-bandcamp","value":"bandcamp"},{"key":"fa fa-bath","value":"bath"},{"key":"fa fa-bathtub","value":"bathtub"},{"key":"fa fa-drivers-license","value":"drivers-license"},{"key":"fa fa-drivers-license-o","value":"drivers-license-o"},{"key":"fa fa-eercast","value":"eercast"},{"key":"fa fa-envelope-open","value":"envelope-open"},{"key":"fa fa-envelope-open-o","value":"envelope-open-o"},{"key":"fa fa-etsy","value":"etsy"},{"key":"fa fa-free-code-camp","value":"free-code-camp"},{"key":"fa fa-grav","value":"grav"},{"key":"fa fa-handshake-o","value":"handshake-o"},{"key":"fa fa-id-badge","value":"id-badge"},{"key":"fa fa-id-card","value":"id-card"},{"key":"fa fa-id-card-o","value":"id-card-o"},{"key":"fa fa-imdb","value":"imdb"},{"key":"fa fa-linode","value":"linode"},{"key":"fa fa-meetup","value":"meetup"},{"key":"fa fa-microchip","value":"microchip"},{"key":"fa fa-podcast","value":"podcast"},{"key":"fa fa-quora","value":"quora"},{"key":"fa fa-ravelry","value":"ravelry"},{"key":"fa fa-s15","value":"s15"},{"key":"fa fa-shower","value":"shower"},{"key":"fa fa-snowflake-o","value":"snowflake-o"},{"key":"fa fa-superpowers","value":"superpowers"},{"key":"fa fa-telegram","value":"telegram"},{"key":"fa fa-thermometer","value":"thermometer"},{"key":"fa fa-thermometer-0","value":"thermometer-0"},{"key":"fa fa-thermometer-1","value":"thermometer-1"},{"key":"fa fa-thermometer-2","value":"thermometer-2"},{"key":"fa fa-thermometer-3","value":"thermometer-3"},{"key":"fa fa-thermometer-4","value":"thermometer-4"},{"key":"fa fa-thermometer-empty","value":"thermometer-empty"},{"key":"fa fa-thermometer-full","value":"thermometer-full"},{"key":"fa fa-thermometer-half","value":"thermometer-half"},{"key":"fa fa-thermometer-quarter","value":"thermometer-quarter"},{"key":"fa fa-thermometer-three-quarters","value":"thermometer-three-quarters"},{"key":"fa fa-times-rectangle","value":"times-rectangle"},{"key":"fa fa-times-rectangle-o","value":"times-rectangle-o"},{"key":"fa fa-user-circle","value":"user-circle"},{"key":"fa fa-user-circle-o","value":"user-circle-o"},{"key":"fa fa-user-o","value":"user-o"},{"key":"fa fa-vcard","value":"vcard"},{"key":"fa fa-vcard-o","value":"vcard-o"},{"key":"fa fa-window-close","value":"window-close"},{"key":"fa fa-window-close-o","value":"window-close-o"},{"key":"fa fa-window-maximize","value":"window-maximize"},{"key":"fa fa-window-minimize","value":"window-minimize"},{"key":"fa fa-window-restore","value":"window-restore"},{"key":"fa fa-wpexplorer","value":"wpexplorer"},{"key":"fa fa-address-book","value":"address-book"},{"key":"fa fa-address-book-o","value":"address-book-o"},{"key":"fa fa-address-card","value":"address-card"},{"key":"fa fa-address-card-o","value":"address-card-o"},{"key":"fa fa-adjust","value":"adjust"},{"key":"fa fa-american-sign-language-interpreting","value":"american-sign-language-interpreting"},{"key":"fa fa-anchor","value":"anchor"},{"key":"fa fa-archive","value":"archive"},{"key":"fa fa-area-chart","value":"area-chart"},{"key":"fa fa-arrows","value":"arrows"},{"key":"fa fa-arrows-h","value":"arrows-h"},{"key":"fa fa-arrows-v","value":"arrows-v"},{"key":"fa fa-asl-interpreting","value":"asl-interpreting"},{"key":"fa fa-assistive-listening-systems","value":"assistive-listening-systems"},{"key":"fa fa-asterisk","value":"asterisk"},{"key":"fa fa-at","value":"at"},{"key":"fa fa-audio-description","value":"audio-description"},{"key":"fa fa-automobile","value":"automobile"},{"key":"fa fa-balance-scale","value":"balance-scale"},{"key":"fa fa-ban","value":"ban"},{"key":"fa fa-bank","value":"bank"},{"key":"fa fa-bar-chart","value":"bar-chart"},{"key":"fa fa-bar-chart-o","value":"bar-chart-o"},{"key":"fa fa-barcode","value":"barcode"},{"key":"fa fa-bars","value":"bars"},{"key":"fa fa-bath","value":"bath"},{"key":"fa fa-bathtub","value":"bathtub"},{"key":"fa fa-battery","value":"battery"},{"key":"fa fa-battery-0","value":"battery-0"},{"key":"fa fa-battery-1","value":"battery-1"},{"key":"fa fa-battery-2","value":"battery-2"},{"key":"fa fa-battery-3","value":"battery-3"},{"key":"fa fa-battery-4","value":"battery-4"},{"key":"fa fa-battery-empty","value":"battery-empty"},{"key":"fa fa-battery-full","value":"battery-full"},{"key":"fa fa-battery-half","value":"battery-half"},{"key":"fa fa-battery-quarter","value":"battery-quarter"},{"key":"fa fa-battery-three-quarters","value":"battery-three-quarters"},{"key":"fa fa-bed","value":"bed"},{"key":"fa fa-beer","value":"beer"},{"key":"fa fa-bell","value":"bell"},{"key":"fa fa-bell-o","value":"bell-o"},{"key":"fa fa-bell-slash","value":"bell-slash"},{"key":"fa fa-bell-slash-o","value":"bell-slash-o"},{"key":"fa fa-bicycle","value":"bicycle"},{"key":"fa fa-binoculars","value":"binoculars"},{"key":"fa fa-birthday-cake","value":"birthday-cake"},{"key":"fa fa-blind","value":"blind"},{"key":"fa fa-bluetooth","value":"bluetooth"},{"key":"fa fa-bluetooth-b","value":"bluetooth-b"},{"key":"fa fa-bolt","value":"bolt"},{"key":"fa fa-bomb","value":"bomb"},{"key":"fa fa-book","value":"book"},{"key":"fa fa-bookmark","value":"bookmark"},{"key":"fa fa-bookmark-o","value":"bookmark-o"},{"key":"fa fa-braille","value":"braille"},{"key":"fa fa-briefcase","value":"briefcase"},{"key":"fa fa-bug","value":"bug"},{"key":"fa fa-building","value":"building"},{"key":"fa fa-building-o","value":"building-o"},{"key":"fa fa-bullhorn","value":"bullhorn"},{"key":"fa fa-bullseye","value":"bullseye"},{"key":"fa fa-bus","value":"bus"},{"key":"fa fa-cab","value":"cab"},{"key":"fa fa-calculator","value":"calculator"},{"key":"fa fa-calendar","value":"calendar"},{"key":"fa fa-calendar-check-o","value":"calendar-check-o"},{"key":"fa fa-calendar-minus-o","value":"calendar-minus-o"},{"key":"fa fa-calendar-o","value":"calendar-o"},{"key":"fa fa-calendar-plus-o","value":"calendar-plus-o"},{"key":"fa fa-calendar-times-o","value":"calendar-times-o"},{"key":"fa fa-camera","value":"camera"},{"key":"fa fa-camera-retro","value":"camera-retro"},{"key":"fa fa-car","value":"car"},{"key":"fa fa-caret-square-o-down","value":"caret-square-o-down"},{"key":"fa fa-caret-square-o-left","value":"caret-square-o-left"},{"key":"fa fa-caret-square-o-right","value":"caret-square-o-right"},{"key":"fa fa-caret-square-o-up","value":"caret-square-o-up"},{"key":"fa fa-cart-arrow-down","value":"cart-arrow-down"},{"key":"fa fa-cart-plus","value":"cart-plus"},{"key":"fa fa-cc","value":"cc"},{"key":"fa fa-certificate","value":"certificate"},{"key":"fa fa-check","value":"check"},{"key":"fa fa-check-circle","value":"check-circle"},{"key":"fa fa-check-circle-o","value":"check-circle-o"},{"key":"fa fa-check-square","value":"check-square"},{"key":"fa fa-check-square-o","value":"check-square-o"},{"key":"fa fa-child","value":"child"},{"key":"fa fa-circle","value":"circle"},{"key":"fa fa-circle-o","value":"circle-o"},{"key":"fa fa-circle-o-notch","value":"circle-o-notch"},{"key":"fa fa-circle-thin","value":"circle-thin"},{"key":"fa fa-clock-o","value":"clock-o"},{"key":"fa fa-clone","value":"clone"},{"key":"fa fa-close","value":"close"},{"key":"fa fa-cloud","value":"cloud"},{"key":"fa fa-cloud-download","value":"cloud-download"},{"key":"fa fa-cloud-upload","value":"cloud-upload"},{"key":"fa fa-code","value":"code"},{"key":"fa fa-code-fork","value":"code-fork"},{"key":"fa fa-coffee","value":"coffee"},{"key":"fa fa-cog","value":"cog"},{"key":"fa fa-cogs","value":"cogs"},{"key":"fa fa-comment","value":"comment"},{"key":"fa fa-comment-o","value":"comment-o"},{"key":"fa fa-commenting","value":"commenting"},{"key":"fa fa-commenting-o","value":"commenting-o"},{"key":"fa fa-comments","value":"comments"},{"key":"fa fa-comments-o","value":"comments-o"},{"key":"fa fa-compass","value":"compass"},{"key":"fa fa-copyright","value":"copyright"},{"key":"fa fa-creative-commons","value":"creative-commons"},{"key":"fa fa-credit-card","value":"credit-card"},{"key":"fa fa-credit-card-alt","value":"credit-card-alt"},{"key":"fa fa-crop","value":"crop"},{"key":"fa fa-crosshairs","value":"crosshairs"},{"key":"fa fa-cube","value":"cube"},{"key":"fa fa-cubes","value":"cubes"},{"key":"fa fa-cutlery","value":"cutlery"},{"key":"fa fa-dashboard","value":"dashboard"},{"key":"fa fa-database","value":"database"},{"key":"fa fa-deaf","value":"deaf"},{"key":"fa fa-deafness","value":"deafness"},{"key":"fa fa-desktop","value":"desktop"},{"key":"fa fa-diamond","value":"diamond"},{"key":"fa fa-dot-circle-o","value":"dot-circle-o"},{"key":"fa fa-download","value":"download"},{"key":"fa fa-drivers-license","value":"drivers-license"},{"key":"fa fa-drivers-license-o","value":"drivers-license-o"},{"key":"fa fa-edit","value":"edit"},{"key":"fa fa-ellipsis-h","value":"ellipsis-h"},{"key":"fa fa-ellipsis-v","value":"ellipsis-v"},{"key":"fa fa-envelope","value":"envelope"},{"key":"fa fa-envelope-o","value":"envelope-o"},{"key":"fa fa-envelope-open","value":"envelope-open"},{"key":"fa fa-envelope-open-o","value":"envelope-open-o"},{"key":"fa fa-envelope-square","value":"envelope-square"},{"key":"fa fa-eraser","value":"eraser"},{"key":"fa fa-exchange","value":"exchange"},{"key":"fa fa-exclamation","value":"exclamation"},{"key":"fa fa-exclamation-circle","value":"exclamation-circle"},{"key":"fa fa-exclamation-triangle","value":"exclamation-triangle"},{"key":"fa fa-external-link","value":"external-link"},{"key":"fa fa-external-link-square","value":"external-link-square"},{"key":"fa fa-eye","value":"eye"},{"key":"fa fa-eye-slash","value":"eye-slash"},{"key":"fa fa-eyedropper","value":"eyedropper"},{"key":"fa fa-fax","value":"fax"},{"key":"fa fa-feed","value":"feed"},{"key":"fa fa-female","value":"female"},{"key":"fa fa-fighter-jet","value":"fighter-jet"},{"key":"fa fa-file-archive-o","value":"file-archive-o"},{"key":"fa fa-file-audio-o","value":"file-audio-o"},{"key":"fa fa-file-code-o","value":"file-code-o"},{"key":"fa fa-file-excel-o","value":"file-excel-o"},{"key":"fa fa-file-image-o","value":"file-image-o"},{"key":"fa fa-file-movie-o","value":"file-movie-o"},{"key":"fa fa-file-pdf-o","value":"file-pdf-o"},{"key":"fa fa-file-photo-o","value":"file-photo-o"},{"key":"fa fa-file-picture-o","value":"file-picture-o"},{"key":"fa fa-file-powerpoint-o","value":"file-powerpoint-o"},{"key":"fa fa-file-sound-o","value":"file-sound-o"},{"key":"fa fa-file-video-o","value":"file-video-o"},{"key":"fa fa-file-word-o","value":"file-word-o"},{"key":"fa fa-file-zip-o","value":"file-zip-o"},{"key":"fa fa-film","value":"film"},{"key":"fa fa-filter","value":"filter"},{"key":"fa fa-fire","value":"fire"},{"key":"fa fa-fire-extinguisher","value":"fire-extinguisher"},{"key":"fa fa-flag","value":"flag"},{"key":"fa fa-flag-checkered","value":"flag-checkered"},{"key":"fa fa-flag-o","value":"flag-o"},{"key":"fa fa-flash","value":"flash"},{"key":"fa fa-flask","value":"flask"},{"key":"fa fa-folder","value":"folder"},{"key":"fa fa-folder-o","value":"folder-o"},{"key":"fa fa-folder-open","value":"folder-open"},{"key":"fa fa-folder-open-o","value":"folder-open-o"},{"key":"fa fa-frown-o","value":"frown-o"},{"key":"fa fa-futbol-o","value":"futbol-o"},{"key":"fa fa-gamepad","value":"gamepad"},{"key":"fa fa-gavel","value":"gavel"},{"key":"fa fa-gear","value":"gear"},{"key":"fa fa-gears","value":"gears"},{"key":"fa fa-gift","value":"gift"},{"key":"fa fa-glass","value":"glass"},{"key":"fa fa-globe","value":"globe"},{"key":"fa fa-graduation-cap","value":"graduation-cap"},{"key":"fa fa-group","value":"group"},{"key":"fa fa-hand-grab-o","value":"hand-grab-o"},{"key":"fa fa-hand-lizard-o","value":"hand-lizard-o"},{"key":"fa fa-hand-paper-o","value":"hand-paper-o"},{"key":"fa fa-hand-peace-o","value":"hand-peace-o"},{"key":"fa fa-hand-pointer-o","value":"hand-pointer-o"},{"key":"fa fa-hand-rock-o","value":"hand-rock-o"},{"key":"fa fa-hand-scissors-o","value":"hand-scissors-o"},{"key":"fa fa-hand-spock-o","value":"hand-spock-o"},{"key":"fa fa-hand-stop-o","value":"hand-stop-o"},{"key":"fa fa-handshake-o","value":"handshake-o"},{"key":"fa fa-hard-of-hearing","value":"hard-of-hearing"},{"key":"fa fa-hashtag","value":"hashtag"},{"key":"fa fa-hdd-o","value":"hdd-o"},{"key":"fa fa-headphones","value":"headphones"},{"key":"fa fa-heart","value":"heart"},{"key":"fa fa-heart-o","value":"heart-o"},{"key":"fa fa-heartbeat","value":"heartbeat"},{"key":"fa fa-history","value":"history"},{"key":"fa fa-home","value":"home"},{"key":"fa fa-hotel","value":"hotel"},{"key":"fa fa-hourglass","value":"hourglass"},{"key":"fa fa-hourglass-1","value":"hourglass-1"},{"key":"fa fa-hourglass-2","value":"hourglass-2"},{"key":"fa fa-hourglass-3","value":"hourglass-3"},{"key":"fa fa-hourglass-end","value":"hourglass-end"},{"key":"fa fa-hourglass-half","value":"hourglass-half"},{"key":"fa fa-hourglass-o","value":"hourglass-o"},{"key":"fa fa-hourglass-start","value":"hourglass-start"},{"key":"fa fa-i-cursor","value":"i-cursor"},{"key":"fa fa-id-badge","value":"id-badge"},{"key":"fa fa-id-card","value":"id-card"},{"key":"fa fa-id-card-o","value":"id-card-o"},{"key":"fa fa-image","value":"image"},{"key":"fa fa-inbox","value":"inbox"},{"key":"fa fa-industry","value":"industry"},{"key":"fa fa-info","value":"info"},{"key":"fa fa-info-circle","value":"info-circle"},{"key":"fa fa-institution","value":"institution"},{"key":"fa fa-key","value":"key"},{"key":"fa fa-keyboard-o","value":"keyboard-o"},{"key":"fa fa-language","value":"language"},{"key":"fa fa-laptop","value":"laptop"},{"key":"fa fa-leaf","value":"leaf"},{"key":"fa fa-legal","value":"legal"},{"key":"fa fa-lemon-o","value":"lemon-o"},{"key":"fa fa-level-down","value":"level-down"},{"key":"fa fa-level-up","value":"level-up"},{"key":"fa fa-life-bouy","value":"life-bouy"},{"key":"fa fa-life-buoy","value":"life-buoy"},{"key":"fa fa-life-ring","value":"life-ring"},{"key":"fa fa-life-saver","value":"life-saver"},{"key":"fa fa-lightbulb-o","value":"lightbulb-o"},{"key":"fa fa-line-chart","value":"line-chart"},{"key":"fa fa-location-arrow","value":"location-arrow"},{"key":"fa fa-lock","value":"lock"},{"key":"fa fa-low-vision","value":"low-vision"},{"key":"fa fa-magic","value":"magic"},{"key":"fa fa-magnet","value":"magnet"},{"key":"fa fa-mail-forward","value":"mail-forward"},{"key":"fa fa-mail-reply","value":"mail-reply"},{"key":"fa fa-mail-reply-all","value":"mail-reply-all"},{"key":"fa fa-male","value":"male"},{"key":"fa fa-map","value":"map"},{"key":"fa fa-map-marker","value":"map-marker"},{"key":"fa fa-map-o","value":"map-o"},{"key":"fa fa-map-pin","value":"map-pin"},{"key":"fa fa-map-signs","value":"map-signs"},{"key":"fa fa-meh-o","value":"meh-o"},{"key":"fa fa-microchip","value":"microchip"},{"key":"fa fa-microphone","value":"microphone"},{"key":"fa fa-microphone-slash","value":"microphone-slash"},{"key":"fa fa-minus","value":"minus"},{"key":"fa fa-minus-circle","value":"minus-circle"},{"key":"fa fa-minus-square","value":"minus-square"},{"key":"fa fa-minus-square-o","value":"minus-square-o"},{"key":"fa fa-mobile","value":"mobile"},{"key":"fa fa-mobile-phone","value":"mobile-phone"},{"key":"fa fa-money","value":"money"},{"key":"fa fa-moon-o","value":"moon-o"},{"key":"fa fa-mortar-board","value":"mortar-board"},{"key":"fa fa-motorcycle","value":"motorcycle"},{"key":"fa fa-mouse-pointer","value":"mouse-pointer"},{"key":"fa fa-music","value":"music"},{"key":"fa fa-navicon","value":"navicon"},{"key":"fa fa-newspaper-o","value":"newspaper-o"},{"key":"fa fa-object-group","value":"object-group"},{"key":"fa fa-object-ungroup","value":"object-ungroup"},{"key":"fa fa-paint-brush","value":"paint-brush"},{"key":"fa fa-paper-plane","value":"paper-plane"},{"key":"fa fa-paper-plane-o","value":"paper-plane-o"},{"key":"fa fa-paw","value":"paw"},{"key":"fa fa-pencil","value":"pencil"},{"key":"fa fa-pencil-square","value":"pencil-square"},{"key":"fa fa-pencil-square-o","value":"pencil-square-o"},{"key":"fa fa-percent","value":"percent"},{"key":"fa fa-phone","value":"phone"},{"key":"fa fa-phone-square","value":"phone-square"},{"key":"fa fa-photo","value":"photo"},{"key":"fa fa-picture-o","value":"picture-o"},{"key":"fa fa-pie-chart","value":"pie-chart"},{"key":"fa fa-plane","value":"plane"},{"key":"fa fa-plug","value":"plug"},{"key":"fa fa-plus","value":"plus"},{"key":"fa fa-plus-circle","value":"plus-circle"},{"key":"fa fa-plus-square","value":"plus-square"},{"key":"fa fa-plus-square-o","value":"plus-square-o"},{"key":"fa fa-podcast","value":"podcast"},{"key":"fa fa-power-off","value":"power-off"},{"key":"fa fa-print","value":"print"},{"key":"fa fa-puzzle-piece","value":"puzzle-piece"},{"key":"fa fa-qrcode","value":"qrcode"},{"key":"fa fa-question","value":"question"},{"key":"fa fa-question-circle","value":"question-circle"},{"key":"fa fa-question-circle-o","value":"question-circle-o"},{"key":"fa fa-quote-left","value":"quote-left"},{"key":"fa fa-quote-right","value":"quote-right"},{"key":"fa fa-random","value":"random"},{"key":"fa fa-recycle","value":"recycle"},{"key":"fa fa-refresh","value":"refresh"},{"key":"fa fa-registered","value":"registered"},{"key":"fa fa-remove","value":"remove"},{"key":"fa fa-reorder","value":"reorder"},{"key":"fa fa-reply","value":"reply"},{"key":"fa fa-reply-all","value":"reply-all"},{"key":"fa fa-retweet","value":"retweet"},{"key":"fa fa-road","value":"road"},{"key":"fa fa-rocket","value":"rocket"},{"key":"fa fa-rss","value":"rss"},{"key":"fa fa-rss-square","value":"rss-square"},{"key":"fa fa-s15","value":"s15"},{"key":"fa fa-search","value":"search"},{"key":"fa fa-search-minus","value":"search-minus"},{"key":"fa fa-search-plus","value":"search-plus"},{"key":"fa fa-send","value":"send"},{"key":"fa fa-send-o","value":"send-o"},{"key":"fa fa-server","value":"server"},{"key":"fa fa-share","value":"share"},{"key":"fa fa-share-alt","value":"share-alt"},{"key":"fa fa-share-alt-square","value":"share-alt-square"},{"key":"fa fa-share-square","value":"share-square"},{"key":"fa fa-share-square-o","value":"share-square-o"},{"key":"fa fa-shield","value":"shield"},{"key":"fa fa-ship","value":"ship"},{"key":"fa fa-shopping-bag","value":"shopping-bag"},{"key":"fa fa-shopping-basket","value":"shopping-basket"},{"key":"fa fa-shopping-cart","value":"shopping-cart"},{"key":"fa fa-shower","value":"shower"},{"key":"fa fa-sign-in","value":"sign-in"},{"key":"fa fa-sign-language","value":"sign-language"},{"key":"fa fa-sign-out","value":"sign-out"},{"key":"fa fa-signal","value":"signal"},{"key":"fa fa-signing","value":"signing"},{"key":"fa fa-sitemap","value":"sitemap"},{"key":"fa fa-sliders","value":"sliders"},{"key":"fa fa-smile-o","value":"smile-o"},{"key":"fa fa-snowflake-o","value":"snowflake-o"},{"key":"fa fa-soccer-ball-o","value":"soccer-ball-o"},{"key":"fa fa-sort","value":"sort"},{"key":"fa fa-sort-alpha-asc","value":"sort-alpha-asc"},{"key":"fa fa-sort-alpha-desc","value":"sort-alpha-desc"},{"key":"fa fa-sort-amount-asc","value":"sort-amount-asc"},{"key":"fa fa-sort-amount-desc","value":"sort-amount-desc"},{"key":"fa fa-sort-asc","value":"sort-asc"},{"key":"fa fa-sort-desc","value":"sort-desc"},{"key":"fa fa-sort-down","value":"sort-down"},{"key":"fa fa-sort-numeric-asc","value":"sort-numeric-asc"},{"key":"fa fa-sort-numeric-desc","value":"sort-numeric-desc"},{"key":"fa fa-sort-up","value":"sort-up"},{"key":"fa fa-space-shuttle","value":"space-shuttle"},{"key":"fa fa-spinner","value":"spinner"},{"key":"fa fa-spoon","value":"spoon"},{"key":"fa fa-square","value":"square"},{"key":"fa fa-square-o","value":"square-o"},{"key":"fa fa-star","value":"star"},{"key":"fa fa-star-half","value":"star-half"},{"key":"fa fa-star-half-empty","value":"star-half-empty"},{"key":"fa fa-star-half-full","value":"star-half-full"},{"key":"fa fa-star-half-o","value":"star-half-o"},{"key":"fa fa-star-o","value":"star-o"},{"key":"fa fa-sticky-note","value":"sticky-note"},{"key":"fa fa-sticky-note-o","value":"sticky-note-o"},{"key":"fa fa-street-view","value":"street-view"},{"key":"fa fa-suitcase","value":"suitcase"},{"key":"fa fa-sun-o","value":"sun-o"},{"key":"fa fa-support","value":"support"},{"key":"fa fa-tablet","value":"tablet"},{"key":"fa fa-tachometer","value":"tachometer"},{"key":"fa fa-tag","value":"tag"},{"key":"fa fa-tags","value":"tags"},{"key":"fa fa-tasks","value":"tasks"},{"key":"fa fa-taxi","value":"taxi"},{"key":"fa fa-television","value":"television"},{"key":"fa fa-terminal","value":"terminal"},{"key":"fa fa-thermometer","value":"thermometer"},{"key":"fa fa-thermometer-0","value":"thermometer-0"},{"key":"fa fa-thermometer-1","value":"thermometer-1"},{"key":"fa fa-thermometer-2","value":"thermometer-2"},{"key":"fa fa-thermometer-3","value":"thermometer-3"},{"key":"fa fa-thermometer-4","value":"thermometer-4"},{"key":"fa fa-thermometer-empty","value":"thermometer-empty"},{"key":"fa fa-thermometer-full","value":"thermometer-full"},{"key":"fa fa-thermometer-half","value":"thermometer-half"},{"key":"fa fa-thermometer-quarter","value":"thermometer-quarter"},{"key":"fa fa-thermometer-three-quarters","value":"thermometer-three-quarters"},{"key":"fa fa-thumb-tack","value":"thumb-tack"},{"key":"fa fa-thumbs-down","value":"thumbs-down"},{"key":"fa fa-thumbs-o-down","value":"thumbs-o-down"},{"key":"fa fa-thumbs-o-up","value":"thumbs-o-up"},{"key":"fa fa-thumbs-up","value":"thumbs-up"},{"key":"fa fa-ticket","value":"ticket"},{"key":"fa fa-times","value":"times"},{"key":"fa fa-times-circle","value":"times-circle"},{"key":"fa fa-times-circle-o","value":"times-circle-o"},{"key":"fa fa-times-rectangle","value":"times-rectangle"},{"key":"fa fa-times-rectangle-o","value":"times-rectangle-o"},{"key":"fa fa-tint","value":"tint"},{"key":"fa fa-toggle-down","value":"toggle-down"},{"key":"fa fa-toggle-left","value":"toggle-left"},{"key":"fa fa-toggle-off","value":"toggle-off"},{"key":"fa fa-toggle-on","value":"toggle-on"},{"key":"fa fa-toggle-right","value":"toggle-right"},{"key":"fa fa-toggle-up","value":"toggle-up"},{"key":"fa fa-trademark","value":"trademark"},{"key":"fa fa-trash","value":"trash"},{"key":"fa fa-trash-o","value":"trash-o"},{"key":"fa fa-tree","value":"tree"},{"key":"fa fa-trophy","value":"trophy"},{"key":"fa fa-truck","value":"truck"},{"key":"fa fa-tty","value":"tty"},{"key":"fa fa-tv","value":"tv"},{"key":"fa fa-umbrella","value":"umbrella"},{"key":"fa fa-universal-access","value":"universal-access"},{"key":"fa fa-university","value":"university"},{"key":"fa fa-unlock","value":"unlock"},{"key":"fa fa-unlock-alt","value":"unlock-alt"},{"key":"fa fa-unsorted","value":"unsorted"},{"key":"fa fa-upload","value":"upload"},{"key":"fa fa-user","value":"user"},{"key":"fa fa-user-circle","value":"user-circle"},{"key":"fa fa-user-circle-o","value":"user-circle-o"},{"key":"fa fa-user-o","value":"user-o"},{"key":"fa fa-user-plus","value":"user-plus"},{"key":"fa fa-user-secret","value":"user-secret"},{"key":"fa fa-user-times","value":"user-times"},{"key":"fa fa-users","value":"users"},{"key":"fa fa-vcard","value":"vcard"},{"key":"fa fa-vcard-o","value":"vcard-o"},{"key":"fa fa-video-camera","value":"video-camera"},{"key":"fa fa-volume-control-phone","value":"volume-control-phone"},{"key":"fa fa-volume-down","value":"volume-down"},{"key":"fa fa-volume-off","value":"volume-off"},{"key":"fa fa-volume-up","value":"volume-up"},{"key":"fa fa-warning","value":"warning"},{"key":"fa fa-wheelchair","value":"wheelchair"},{"key":"fa fa-wheelchair-alt","value":"wheelchair-alt"},{"key":"fa fa-wifi","value":"wifi"},{"key":"fa fa-window-close","value":"window-close"},{"key":"fa fa-window-close-o","value":"window-close-o"},{"key":"fa fa-window-maximize","value":"window-maximize"},{"key":"fa fa-window-minimize","value":"window-minimize"},{"key":"fa fa-window-restore","value":"window-restore"},{"key":"fa fa-wrench","value":"wrench"},{"key":"fa fa-american-sign-language-interpreting","value":"american-sign-language-interpreting"},{"key":"fa fa-asl-interpreting","value":"asl-interpreting"},{"key":"fa fa-assistive-listening-systems","value":"assistive-listening-systems"},{"key":"fa fa-audio-description","value":"audio-description"},{"key":"fa fa-blind","value":"blind"},{"key":"fa fa-braille","value":"braille"},{"key":"fa fa-cc","value":"cc"},{"key":"fa fa-deaf","value":"deaf"},{"key":"fa fa-deafness","value":"deafness"},{"key":"fa fa-hard-of-hearing","value":"hard-of-hearing"},{"key":"fa fa-low-vision","value":"low-vision"},{"key":"fa fa-question-circle-o","value":"question-circle-o"},{"key":"fa fa-sign-language","value":"sign-language"},{"key":"fa fa-signing","value":"signing"},{"key":"fa fa-tty","value":"tty"},{"key":"fa fa-universal-access","value":"universal-access"},{"key":"fa fa-volume-control-phone","value":"volume-control-phone"},{"key":"fa fa-wheelchair","value":"wheelchair"},{"key":"fa fa-wheelchair-alt","value":"wheelchair-alt"},{"key":"fa fa-hand-grab-o","value":"hand-grab-o"},{"key":"fa fa-hand-lizard-o","value":"hand-lizard-o"},{"key":"fa fa-hand-o-down","value":"hand-o-down"},{"key":"fa fa-hand-o-left","value":"hand-o-left"},{"key":"fa fa-hand-o-right","value":"hand-o-right"},{"key":"fa fa-hand-o-up","value":"hand-o-up"},{"key":"fa fa-hand-paper-o","value":"hand-paper-o"},{"key":"fa fa-hand-peace-o","value":"hand-peace-o"},{"key":"fa fa-hand-pointer-o","value":"hand-pointer-o"},{"key":"fa fa-hand-rock-o","value":"hand-rock-o"},{"key":"fa fa-hand-scissors-o","value":"hand-scissors-o"},{"key":"fa fa-hand-spock-o","value":"hand-spock-o"},{"key":"fa fa-hand-stop-o","value":"hand-stop-o"},{"key":"fa fa-thumbs-down","value":"thumbs-down"},{"key":"fa fa-thumbs-o-down","value":"thumbs-o-down"},{"key":"fa fa-thumbs-o-up","value":"thumbs-o-up"},{"key":"fa fa-thumbs-up","value":"thumbs-up"},{"key":"fa fa-ambulance","value":"ambulance"},{"key":"fa fa-automobile","value":"automobile"},{"key":"fa fa-bicycle","value":"bicycle"},{"key":"fa fa-bus","value":"bus"},{"key":"fa fa-cab","value":"cab"},{"key":"fa fa-car","value":"car"},{"key":"fa fa-fighter-jet","value":"fighter-jet"},{"key":"fa fa-motorcycle","value":"motorcycle"},{"key":"fa fa-plane","value":"plane"},{"key":"fa fa-rocket","value":"rocket"},{"key":"fa fa-ship","value":"ship"},{"key":"fa fa-space-shuttle","value":"space-shuttle"},{"key":"fa fa-subway","value":"subway"},{"key":"fa fa-taxi","value":"taxi"},{"key":"fa fa-train","value":"train"},{"key":"fa fa-truck","value":"truck"},{"key":"fa fa-wheelchair","value":"wheelchair"},{"key":"fa fa-wheelchair-alt","value":"wheelchair-alt"},{"key":"fa fa-genderless","value":"genderless"},{"key":"fa fa-intersex","value":"intersex"},{"key":"fa fa-mars","value":"mars"},{"key":"fa fa-mars-double","value":"mars-double"},{"key":"fa fa-mars-stroke","value":"mars-stroke"},{"key":"fa fa-mars-stroke-h","value":"mars-stroke-h"},{"key":"fa fa-mars-stroke-v","value":"mars-stroke-v"},{"key":"fa fa-mercury","value":"mercury"},{"key":"fa fa-neuter","value":"neuter"},{"key":"fa fa-transgender","value":"transgender"},{"key":"fa fa-transgender-alt","value":"transgender-alt"},{"key":"fa fa-venus","value":"venus"},{"key":"fa fa-venus-double","value":"venus-double"},{"key":"fa fa-venus-mars","value":"venus-mars"},{"key":"fa fa-file","value":"file"},{"key":"fa fa-file-archive-o","value":"file-archive-o"},{"key":"fa fa-file-audio-o","value":"file-audio-o"},{"key":"fa fa-file-code-o","value":"file-code-o"},{"key":"fa fa-file-excel-o","value":"file-excel-o"},{"key":"fa fa-file-image-o","value":"file-image-o"},{"key":"fa fa-file-movie-o","value":"file-movie-o"},{"key":"fa fa-file-o","value":"file-o"},{"key":"fa fa-file-pdf-o","value":"file-pdf-o"},{"key":"fa fa-file-photo-o","value":"file-photo-o"},{"key":"fa fa-file-picture-o","value":"file-picture-o"},{"key":"fa fa-file-powerpoint-o","value":"file-powerpoint-o"},{"key":"fa fa-file-sound-o","value":"file-sound-o"},{"key":"fa fa-file-text","value":"file-text"},{"key":"fa fa-file-text-o","value":"file-text-o"},{"key":"fa fa-file-video-o","value":"file-video-o"},{"key":"fa fa-file-word-o","value":"file-word-o"},{"key":"fa fa-file-zip-o","value":"file-zip-o"},{"key":"fa fa-circle-o-notch","value":"circle-o-notch"},{"key":"fa fa-cog","value":"cog"},{"key":"fa fa-gear","value":"gear"},{"key":"fa fa-refresh","value":"refresh"},{"key":"fa fa-spinner","value":"spinner"},{"key":"fa fa-check-square","value":"check-square"},{"key":"fa fa-check-square-o","value":"check-square-o"},{"key":"fa fa-circle","value":"circle"},{"key":"fa fa-circle-o","value":"circle-o"},{"key":"fa fa-dot-circle-o","value":"dot-circle-o"},{"key":"fa fa-minus-square","value":"minus-square"},{"key":"fa fa-minus-square-o","value":"minus-square-o"},{"key":"fa fa-plus-square","value":"plus-square"},{"key":"fa fa-plus-square-o","value":"plus-square-o"},{"key":"fa fa-square","value":"square"},{"key":"fa fa-square-o","value":"square-o"},{"key":"fa fa-cc-amex","value":"cc-amex"},{"key":"fa fa-cc-diners-club","value":"cc-diners-club"},{"key":"fa fa-cc-discover","value":"cc-discover"},{"key":"fa fa-cc-jcb","value":"cc-jcb"},{"key":"fa fa-cc-mastercard","value":"cc-mastercard"},{"key":"fa fa-cc-paypal","value":"cc-paypal"},{"key":"fa fa-cc-stripe","value":"cc-stripe"},{"key":"fa fa-cc-visa","value":"cc-visa"},{"key":"fa fa-credit-card","value":"credit-card"},{"key":"fa fa-credit-card-alt","value":"credit-card-alt"},{"key":"fa fa-google-wallet","value":"google-wallet"},{"key":"fa fa-paypal","value":"paypal"},{"key":"fa fa-area-chart","value":"area-chart"},{"key":"fa fa-bar-chart","value":"bar-chart"},{"key":"fa fa-bar-chart-o","value":"bar-chart-o"},{"key":"fa fa-line-chart","value":"line-chart"},{"key":"fa fa-pie-chart","value":"pie-chart"},{"key":"fa fa-bitcoin","value":"bitcoin"},{"key":"fa fa-btc","value":"btc"},{"key":"fa fa-cny","value":"cny"},{"key":"fa fa-dollar","value":"dollar"},{"key":"fa fa-eur","value":"eur"},{"key":"fa fa-euro","value":"euro"},{"key":"fa fa-gbp","value":"gbp"},{"key":"fa fa-gg","value":"gg"},{"key":"fa fa-gg-circle","value":"gg-circle"},{"key":"fa fa-ils","value":"ils"},{"key":"fa fa-inr","value":"inr"},{"key":"fa fa-jpy","value":"jpy"},{"key":"fa fa-krw","value":"krw"},{"key":"fa fa-money","value":"money"},{"key":"fa fa-rmb","value":"rmb"},{"key":"fa fa-rouble","value":"rouble"},{"key":"fa fa-rub","value":"rub"},{"key":"fa fa-ruble","value":"ruble"},{"key":"fa fa-rupee","value":"rupee"},{"key":"fa fa-shekel","value":"shekel"},{"key":"fa fa-sheqel","value":"sheqel"},{"key":"fa fa-try","value":"try"},{"key":"fa fa-turkish-lira","value":"turkish-lira"},{"key":"fa fa-usd","value":"usd"},{"key":"fa fa-viacoin","value":"viacoin"},{"key":"fa fa-won","value":"won"},{"key":"fa fa-yen","value":"yen"},{"key":"fa fa-align-center","value":"align-center"},{"key":"fa fa-align-justify","value":"align-justify"},{"key":"fa fa-align-left","value":"align-left"},{"key":"fa fa-align-right","value":"align-right"},{"key":"fa fa-bold","value":"bold"},{"key":"fa fa-chain","value":"chain"},{"key":"fa fa-chain-broken","value":"chain-broken"},{"key":"fa fa-clipboard","value":"clipboard"},{"key":"fa fa-columns","value":"columns"},{"key":"fa fa-copy","value":"copy"},{"key":"fa fa-cut","value":"cut"},{"key":"fa fa-dedent","value":"dedent"},{"key":"fa fa-eraser","value":"eraser"},{"key":"fa fa-file","value":"file"},{"key":"fa fa-file-o","value":"file-o"},{"key":"fa fa-file-text","value":"file-text"},{"key":"fa fa-file-text-o","value":"file-text-o"},{"key":"fa fa-files-o","value":"files-o"},{"key":"fa fa-floppy-o","value":"floppy-o"},{"key":"fa fa-font","value":"font"},{"key":"fa fa-header","value":"header"},{"key":"fa fa-indent","value":"indent"},{"key":"fa fa-italic","value":"italic"},{"key":"fa fa-link","value":"link"},{"key":"fa fa-list","value":"list"},{"key":"fa fa-list-alt","value":"list-alt"},{"key":"fa fa-list-ol","value":"list-ol"},{"key":"fa fa-list-ul","value":"list-ul"},{"key":"fa fa-outdent","value":"outdent"},{"key":"fa fa-paperclip","value":"paperclip"},{"key":"fa fa-paragraph","value":"paragraph"},{"key":"fa fa-paste","value":"paste"},{"key":"fa fa-repeat","value":"repeat"},{"key":"fa fa-rotate-left","value":"rotate-left"},{"key":"fa fa-rotate-right","value":"rotate-right"},{"key":"fa fa-save","value":"save"},{"key":"fa fa-scissors","value":"scissors"},{"key":"fa fa-strikethrough","value":"strikethrough"},{"key":"fa fa-subscript","value":"subscript"},{"key":"fa fa-superscript","value":"superscript"},{"key":"fa fa-table","value":"table"},{"key":"fa fa-text-height","value":"text-height"},{"key":"fa fa-text-width","value":"text-width"},{"key":"fa fa-th","value":"th"},{"key":"fa fa-th-large","value":"th-large"},{"key":"fa fa-th-list","value":"th-list"},{"key":"fa fa-underline","value":"underline"},{"key":"fa fa-undo","value":"undo"},{"key":"fa fa-unlink","value":"unlink"},{"key":"fa fa-angle-double-down","value":"angle-double-down"},{"key":"fa fa-angle-double-left","value":"angle-double-left"},{"key":"fa fa-angle-double-right","value":"angle-double-right"},{"key":"fa fa-angle-double-up","value":"angle-double-up"},{"key":"fa fa-angle-down","value":"angle-down"},{"key":"fa fa-angle-left","value":"angle-left"},{"key":"fa fa-angle-right","value":"angle-right"},{"key":"fa fa-angle-up","value":"angle-up"},{"key":"fa fa-arrow-circle-down","value":"arrow-circle-down"},{"key":"fa fa-arrow-circle-left","value":"arrow-circle-left"},{"key":"fa fa-arrow-circle-o-down","value":"arrow-circle-o-down"},{"key":"fa fa-arrow-circle-o-left","value":"arrow-circle-o-left"},{"key":"fa fa-arrow-circle-o-right","value":"arrow-circle-o-right"},{"key":"fa fa-arrow-circle-o-up","value":"arrow-circle-o-up"},{"key":"fa fa-arrow-circle-right","value":"arrow-circle-right"},{"key":"fa fa-arrow-circle-up","value":"arrow-circle-up"},{"key":"fa fa-arrow-down","value":"arrow-down"},{"key":"fa fa-arrow-left","value":"arrow-left"},{"key":"fa fa-arrow-right","value":"arrow-right"},{"key":"fa fa-arrow-up","value":"arrow-up"},{"key":"fa fa-arrows","value":"arrows"},{"key":"fa fa-arrows-alt","value":"arrows-alt"},{"key":"fa fa-arrows-h","value":"arrows-h"},{"key":"fa fa-arrows-v","value":"arrows-v"},{"key":"fa fa-caret-down","value":"caret-down"},{"key":"fa fa-caret-left","value":"caret-left"},{"key":"fa fa-caret-right","value":"caret-right"},{"key":"fa fa-caret-square-o-down","value":"caret-square-o-down"},{"key":"fa fa-caret-square-o-left","value":"caret-square-o-left"},{"key":"fa fa-caret-square-o-right","value":"caret-square-o-right"},{"key":"fa fa-caret-square-o-up","value":"caret-square-o-up"},{"key":"fa fa-caret-up","value":"caret-up"},{"key":"fa fa-chevron-circle-down","value":"chevron-circle-down"},{"key":"fa fa-chevron-circle-left","value":"chevron-circle-left"},{"key":"fa fa-chevron-circle-right","value":"chevron-circle-right"},{"key":"fa fa-chevron-circle-up","value":"chevron-circle-up"},{"key":"fa fa-chevron-down","value":"chevron-down"},{"key":"fa fa-chevron-left","value":"chevron-left"},{"key":"fa fa-chevron-right","value":"chevron-right"},{"key":"fa fa-chevron-up","value":"chevron-up"},{"key":"fa fa-exchange","value":"exchange"},{"key":"fa fa-hand-o-down","value":"hand-o-down"},{"key":"fa fa-hand-o-left","value":"hand-o-left"},{"key":"fa fa-hand-o-right","value":"hand-o-right"},{"key":"fa fa-hand-o-up","value":"hand-o-up"},{"key":"fa fa-long-arrow-down","value":"long-arrow-down"},{"key":"fa fa-long-arrow-left","value":"long-arrow-left"},{"key":"fa fa-long-arrow-right","value":"long-arrow-right"},{"key":"fa fa-long-arrow-up","value":"long-arrow-up"},{"key":"fa fa-toggle-down","value":"toggle-down"},{"key":"fa fa-toggle-left","value":"toggle-left"},{"key":"fa fa-toggle-right","value":"toggle-right"},{"key":"fa fa-toggle-up","value":"toggle-up"},{"key":"fa fa-arrows-alt","value":"arrows-alt"},{"key":"fa fa-backward","value":"backward"},{"key":"fa fa-compress","value":"compress"},{"key":"fa fa-eject","value":"eject"},{"key":"fa fa-expand","value":"expand"},{"key":"fa fa-fast-backward","value":"fast-backward"},{"key":"fa fa-fast-forward","value":"fast-forward"},{"key":"fa fa-forward","value":"forward"},{"key":"fa fa-pause","value":"pause"},{"key":"fa fa-pause-circle","value":"pause-circle"},{"key":"fa fa-pause-circle-o","value":"pause-circle-o"},{"key":"fa fa-play","value":"play"},{"key":"fa fa-play-circle","value":"play-circle"},{"key":"fa fa-play-circle-o","value":"play-circle-o"},{"key":"fa fa-random","value":"random"},{"key":"fa fa-step-backward","value":"step-backward"},{"key":"fa fa-step-forward","value":"step-forward"},{"key":"fa fa-stop","value":"stop"},{"key":"fa fa-stop-circle","value":"stop-circle"},{"key":"fa fa-stop-circle-o","value":"stop-circle-o"},{"key":"fa fa-youtube-play","value":"youtube-play"},{"key":"fa fa-500px","value":"500px"},{"key":"fa fa-adn","value":"adn"},{"key":"fa fa-amazon","value":"amazon"},{"key":"fa fa-android","value":"android"},{"key":"fa fa-angellist","value":"angellist"},{"key":"fa fa-apple","value":"apple"},{"key":"fa fa-bandcamp","value":"bandcamp"},{"key":"fa fa-behance","value":"behance"},{"key":"fa fa-behance-square","value":"behance-square"},{"key":"fa fa-bitbucket","value":"bitbucket"},{"key":"fa fa-bitbucket-square","value":"bitbucket-square"},{"key":"fa fa-bitcoin","value":"bitcoin"},{"key":"fa fa-black-tie","value":"black-tie"},{"key":"fa fa-bluetooth","value":"bluetooth"},{"key":"fa fa-bluetooth-b","value":"bluetooth-b"},{"key":"fa fa-btc","value":"btc"},{"key":"fa fa-buysellads","value":"buysellads"},{"key":"fa fa-cc-amex","value":"cc-amex"},{"key":"fa fa-cc-diners-club","value":"cc-diners-club"},{"key":"fa fa-cc-discover","value":"cc-discover"},{"key":"fa fa-cc-jcb","value":"cc-jcb"},{"key":"fa fa-cc-mastercard","value":"cc-mastercard"},{"key":"fa fa-cc-paypal","value":"cc-paypal"},{"key":"fa fa-cc-stripe","value":"cc-stripe"},{"key":"fa fa-cc-visa","value":"cc-visa"},{"key":"fa fa-chrome","value":"chrome"},{"key":"fa fa-codepen","value":"codepen"},{"key":"fa fa-codiepie","value":"codiepie"},{"key":"fa fa-connectdevelop","value":"connectdevelop"},{"key":"fa fa-contao","value":"contao"},{"key":"fa fa-css3","value":"css3"},{"key":"fa fa-dashcube","value":"dashcube"},{"key":"fa fa-delicious","value":"delicious"},{"key":"fa fa-deviantart","value":"deviantart"},{"key":"fa fa-digg","value":"digg"},{"key":"fa fa-dribbble","value":"dribbble"},{"key":"fa fa-dropbox","value":"dropbox"},{"key":"fa fa-drupal","value":"drupal"},{"key":"fa fa-edge","value":"edge"},{"key":"fa fa-eercast","value":"eercast"},{"key":"fa fa-empire","value":"empire"},{"key":"fa fa-envira","value":"envira"},{"key":"fa fa-etsy","value":"etsy"},{"key":"fa fa-expeditedssl","value":"expeditedssl"},{"key":"fa fa-fa","value":"fa"},{"key":"fa fa-facebook","value":"facebook"},{"key":"fa fa-facebook-f","value":"facebook-f"},{"key":"fa fa-facebook-official","value":"facebook-official"},{"key":"fa fa-facebook-square","value":"facebook-square"},{"key":"fa fa-firefox","value":"firefox"},{"key":"fa fa-first-order","value":"first-order"},{"key":"fa fa-flickr","value":"flickr"},{"key":"fa fa-font-awesome","value":"font-awesome"},{"key":"fa fa-fonticons","value":"fonticons"},{"key":"fa fa-fort-awesome","value":"fort-awesome"},{"key":"fa fa-forumbee","value":"forumbee"},{"key":"fa fa-foursquare","value":"foursquare"},{"key":"fa fa-free-code-camp","value":"free-code-camp"},{"key":"fa fa-ge","value":"ge"},{"key":"fa fa-get-pocket","value":"get-pocket"},{"key":"fa fa-gg","value":"gg"},{"key":"fa fa-gg-circle","value":"gg-circle"},{"key":"fa fa-git","value":"git"},{"key":"fa fa-git-square","value":"git-square"},{"key":"fa fa-github","value":"github"},{"key":"fa fa-github-alt","value":"github-alt"},{"key":"fa fa-github-square","value":"github-square"},{"key":"fa fa-gitlab","value":"gitlab"},{"key":"fa fa-gittip","value":"gittip"},{"key":"fa fa-glide","value":"glide"},{"key":"fa fa-glide-g","value":"glide-g"},{"key":"fa fa-google","value":"google"},{"key":"fa fa-google-plus","value":"google-plus"},{"key":"fa fa-google-plus-circle","value":"google-plus-circle"},{"key":"fa fa-google-plus-official","value":"google-plus-official"},{"key":"fa fa-google-plus-square","value":"google-plus-square"},{"key":"fa fa-google-wallet","value":"google-wallet"},{"key":"fa fa-gratipay","value":"gratipay"},{"key":"fa fa-grav","value":"grav"},{"key":"fa fa-hacker-news","value":"hacker-news"},{"key":"fa fa-houzz","value":"houzz"},{"key":"fa fa-html5","value":"html5"},{"key":"fa fa-imdb","value":"imdb"},{"key":"fa fa-instagram","value":"instagram"},{"key":"fa fa-internet-explorer","value":"internet-explorer"},{"key":"fa fa-ioxhost","value":"ioxhost"},{"key":"fa fa-joomla","value":"joomla"},{"key":"fa fa-jsfiddle","value":"jsfiddle"},{"key":"fa fa-lastfm","value":"lastfm"},{"key":"fa fa-lastfm-square","value":"lastfm-square"},{"key":"fa fa-leanpub","value":"leanpub"},{"key":"fa fa-linkedin","value":"linkedin"},{"key":"fa fa-linkedin-square","value":"linkedin-square"},{"key":"fa fa-linode","value":"linode"},{"key":"fa fa-linux","value":"linux"},{"key":"fa fa-maxcdn","value":"maxcdn"},{"key":"fa fa-meanpath","value":"meanpath"},{"key":"fa fa-medium","value":"medium"},{"key":"fa fa-meetup","value":"meetup"},{"key":"fa fa-mixcloud","value":"mixcloud"},{"key":"fa fa-modx","value":"modx"},{"key":"fa fa-odnoklassniki","value":"odnoklassniki"},{"key":"fa fa-odnoklassniki-square","value":"odnoklassniki-square"},{"key":"fa fa-opencart","value":"opencart"},{"key":"fa fa-openid","value":"openid"},{"key":"fa fa-opera","value":"opera"},{"key":"fa fa-optin-monster","value":"optin-monster"},{"key":"fa fa-pagelines","value":"pagelines"},{"key":"fa fa-paypal","value":"paypal"},{"key":"fa fa-pied-piper","value":"pied-piper"},{"key":"fa fa-pied-piper-alt","value":"pied-piper-alt"},{"key":"fa fa-pied-piper-pp","value":"pied-piper-pp"},{"key":"fa fa-pinterest","value":"pinterest"},{"key":"fa fa-pinterest-p","value":"pinterest-p"},{"key":"fa fa-pinterest-square","value":"pinterest-square"},{"key":"fa fa-product-hunt","value":"product-hunt"},{"key":"fa fa-qq","value":"qq"},{"key":"fa fa-quora","value":"quora"},{"key":"fa fa-ra","value":"ra"},{"key":"fa fa-ravelry","value":"ravelry"},{"key":"fa fa-rebel","value":"rebel"},{"key":"fa fa-reddit","value":"reddit"},{"key":"fa fa-reddit-alien","value":"reddit-alien"},{"key":"fa fa-reddit-square","value":"reddit-square"},{"key":"fa fa-renren","value":"renren"},{"key":"fa fa-resistance","value":"resistance"},{"key":"fa fa-safari","value":"safari"},{"key":"fa fa-scribd","value":"scribd"},{"key":"fa fa-sellsy","value":"sellsy"},{"key":"fa fa-share-alt","value":"share-alt"},{"key":"fa fa-share-alt-square","value":"share-alt-square"},{"key":"fa fa-shirtsinbulk","value":"shirtsinbulk"},{"key":"fa fa-simplybuilt","value":"simplybuilt"},{"key":"fa fa-skyatlas","value":"skyatlas"},{"key":"fa fa-skype","value":"skype"},{"key":"fa fa-slack","value":"slack"},{"key":"fa fa-slideshare","value":"slideshare"},{"key":"fa fa-snapchat","value":"snapchat"},{"key":"fa fa-snapchat-ghost","value":"snapchat-ghost"},{"key":"fa fa-snapchat-square","value":"snapchat-square"},{"key":"fa fa-soundcloud","value":"soundcloud"},{"key":"fa fa-spotify","value":"spotify"},{"key":"fa fa-stack-exchange","value":"stack-exchange"},{"key":"fa fa-stack-overflow","value":"stack-overflow"},{"key":"fa fa-steam","value":"steam"},{"key":"fa fa-steam-square","value":"steam-square"},{"key":"fa fa-stumbleupon","value":"stumbleupon"},{"key":"fa fa-stumbleupon-circle","value":"stumbleupon-circle"},{"key":"fa fa-superpowers","value":"superpowers"},{"key":"fa fa-telegram","value":"telegram"},{"key":"fa fa-tencent-weibo","value":"tencent-weibo"},{"key":"fa fa-themeisle","value":"themeisle"},{"key":"fa fa-trello","value":"trello"},{"key":"fa fa-tripadvisor","value":"tripadvisor"},{"key":"fa fa-tumblr","value":"tumblr"},{"key":"fa fa-tumblr-square","value":"tumblr-square"},{"key":"fa fa-twitch","value":"twitch"},{"key":"fa fa-twitter","value":"twitter"},{"key":"fa fa-twitter-square","value":"twitter-square"},{"key":"fa fa-usb","value":"usb"},{"key":"fa fa-viacoin","value":"viacoin"},{"key":"fa fa-viadeo","value":"viadeo"},{"key":"fa fa-viadeo-square","value":"viadeo-square"},{"key":"fa fa-vimeo","value":"vimeo"},{"key":"fa fa-vimeo-square","value":"vimeo-square"},{"key":"fa fa-vine","value":"vine"},{"key":"fa fa-vk","value":"vk"},{"key":"fa fa-wechat","value":"wechat"},{"key":"fa fa-weibo","value":"weibo"},{"key":"fa fa-weixin","value":"weixin"},{"key":"fa fa-whatsapp","value":"whatsapp"},{"key":"fa fa-wikipedia-w","value":"wikipedia-w"},{"key":"fa fa-windows","value":"windows"},{"key":"fa fa-wordpress","value":"wordpress"},{"key":"fa fa-wpbeginner","value":"wpbeginner"},{"key":"fa fa-wpexplorer","value":"wpexplorer"},{"key":"fa fa-wpforms","value":"wpforms"},{"key":"fa fa-xing","value":"xing"},{"key":"fa fa-xing-square","value":"xing-square"},{"key":"fa fa-y-combinator","value":"y-combinator"},{"key":"fa fa-y-combinator-square","value":"y-combinator-square"},{"key":"fa fa-yahoo","value":"yahoo"},{"key":"fa fa-yc","value":"yc"},{"key":"fa fa-yc-square","value":"yc-square"},{"key":"fa fa-yelp","value":"yelp"},{"key":"fa fa-yoast","value":"yoast"},{"key":"fa fa-youtube","value":"youtube"},{"key":"fa fa-youtube-play","value":"youtube-play"},{"key":"fa fa-youtube-square","value":"youtube-square"},{"key":"fa fa-ambulance","value":"ambulance"},{"key":"fa fa-h-square","value":"h-square"},{"key":"fa fa-heart","value":"heart"},{"key":"fa fa-heart-o","value":"heart-o"},{"key":"fa fa-heartbeat","value":"heartbeat"},{"key":"fa fa-hospital-o","value":"hospital-o"},{"key":"fa fa-medkit","value":"medkit"},{"key":"fa fa-plus-square","value":"plus-square"},{"key":"fa fa-stethoscope","value":"stethoscope"},{"key":"fa fa-user-md","value":"user-md"},{"key":"fa fa-wheelchair","value":"wheelchair"},{"key":"fa fa-wheelchair-alt","value":"wheelchair-alt"}];
        var html = "<p>Font Icons:</p><select name='postFontIcon' id='postFontIcon'>" +
            "<option value=''>Select</option>";
        for(i =0; i< listFont.length; i++){
            tagI= `<em class='${listFont[i].key}' ></em> &nbsp; ${listFont[i].value} `;
            html+= `<option value=" ${listFont[i].key}" data-html="${tagI}" >${listFont[i].value}</option>`;
        }
        html += "</select>";
        return html;

    }

    function renderSelect(type = 'categories', post_type = '') {
        var dom = [];

        jQuery.ajax({
            type: "POST",
            url: ajaxurl,
            data: { action: 'my_action' , param: type, post_type: post_type },
            async: false

        }).done(function( msg ) {
            var dataResponse = msg.response;
            var html;
            var types = {
                post_types: 'Post Types',
                posts: 'Posts',
                categories: 'Categories'
            };

            if (dataResponse) {
                html = '<p>' + types[type] + ':</p>'
                html += '<select name="'+ type +'_id" class="select-search" style="width: 100%; border: 1px solid #ccc">' +
                    '<option value="0" data-html="Select">Select</option>';

                for (var key in dataResponse) {
                    if (key === 'object_level') continue;

                    if (dataResponse['object_level'] == 2) {
                        html += '<optgroup label="' + key + '">';

                        for (var subKey in dataResponse[key]) {
                            var seleted = (type === "post_types" && subKey === 'post') ? 'selected' : '';
                            html += '<option data-html="' + dataResponse[key][subKey] + '" value="' + subKey + '" ' + seleted + '>' + dataResponse[key][subKey] + '</option>';
                        }

                        html += '</optgroup>';
                    } else {
                        html += '<option data-html="' + dataResponse[key] + '" value="' + key + '">' + dataResponse[key] + '</option>';
                    }
                }

                html += '</select>';
            } else {
                html = '<p>Not found!</p>'
            }

            dom.push(html);
        });

        return dom[0];
    }

    /**
    *   Render the mobile order select options
    */
    function mobileOrderOptions() {
        var html = '<p>Mobile order:</p>' +
            '<select style="width: 100%; border: 1px solid #ccc" name="mobile_order">' +
            '<option value="normal">Normal</option>' +
            '<option value="reverse">Reverse</option>' +
            '</select>';
        return html;
    }

    /**
     *   Render the mobile order select options
     */
    function imagePositionOptions() {
        var html = '<p>Play button postion:</p>' +
            '<select style="width: 100%; border: 1px solid #ccc" name="image_position">' +
            '<option value="left">Left</option>' +
            '<option value="right">Right</option>' +
            '<option value="center">Center</option>' +
            '</select>';
        return html;
    }

    /**
     *   Render the button colors select options
     */
    function buttonColors() {
        var html = '<p>Button color:</p>' +
            '<select style="width: 100%; border: 1px solid #ccc" name="btn_color">' +
            '<option value="btn-primary">Primary</option>' +
            '<option value="btn-secondary" selected>Secondary</option>' +
            '<option value="btn-success-dark">Success Dark</option>' +
            '<option value="btn-info">Info</option>' +
            '<option value="btn-warning">Warning</option>' +
            '<option value="btn-danger">Danger</option>' +
            '<option value="btn-dark">Dark</option>' +
            '</select>';
        return html;
    }

    /**
     *   Render the button colors select options
     */
    // '<option value="text-success-dark">Success Dark</option>' +
    function textColors() {
        var html = '<p>Text color:</p>' +
            '<select style="width: 100%; border: 1px solid #ccc" name="text_color">' +
            '<option value="">Default</option>' +
            '<option value="text-primary">Primary</option>' +
            '<option value="text-secondary">Secondary</option>' +
            '<option value="text-info">Info</option>' +
            '<option value="text-warning">Warning</option>' +
            '<option value="text-danger">Danger</option>' +
            '<option value="text-dark">Dark</option>' +
            '<option value="text-muted">Muted</option>' +
            '<option value="text-white">White</option>' +
            '</select>';
        return html;
    }

    /**
     *   Render the upload image popup
     *   @param name
     *   @param title
     */

    function uploadFileHtml(name, title) {
        var html = '<div class="quest-media-shortcode sub-option section widget-upload" style="margin: 13px 0; display: flex">' +
            '<div style="width: 25%">' +
            '<p>' + title + '</p>' +
            '<input class="upload" type="text" placeholder="No file chosen" name="' + name + '" style="display: none">' +
            '<input class="button upload-button-wdgt" type="button" value="Upload">' +
            '</div>' +
            '<div class="screenshot team-thumb" style="margin: 7px 0px;">' +
            '</div>' +
            '</div>';

        return html;
    }
    /**
     *   Render the input field select options
     *   @param name
     *   @param type
     *   @param label
     *   @param placeholder
     *   @param value
     *   @return html
     */
    function inputField(name, type = 'text', label = '', placeholder = '', value = '')
    {
        var html = '<p>'+ label +':</p>' +
            '<input type="text" name="'+ name + '"' +
            ' placeholder="'+ placeholder +'"' +
            ' value="'+ value +'"' +
            ' style="width: 100%; height: 30px; padding-left: 5px; border: 1px solid #ccc;" />';
        return html;
    }

    /**
     *   register subcategories shortcode into tinymce plugin
     */
    tinymce.create('tinymce.plugins.SubCategoriesShortcode', {
        init: function(ed, url){

            ed.addButton('myblockquotebtn', {
                title: 'Subsection Shortcode',
                image: url + '/img/tree-structure.png',
                type: 'menubutton',
                menu: [
                    {
                        text: 'Categories',
                        onclick: function() {
                            var win = ed.windowManager.open({
                                title: 'Categories',
                                width: 600,
                                height: 420,
                                body: [
                                    {
                                        type : 'container',
                                        html: renderSelect('categories'),
                                        height: 200,
                                    },
                                    {
                                        type: 'container',
                                        html: inputField('new_title', 'text', 'Title (optional)', 'Enter new if you want to change it')
                                    },
                                    {
                                        type: 'container',
                                        html: '<p>Description (optional): </p><textarea name="description" placeholder="Enter new if you want to change it" style="padding: 5px 0 5px 5px; width: 100%; border: 1px solid #ccc;"></textarea>'
                                    },
                                    {
                                        type: 'container',
                                        html: buttonColors()
                                    },
                                    {
                                        type: 'container',
                                        html: inputField('btn_name', 'text', 'Button Name (optional)', 'Enter new if you want to change it')
                                    },
                                    {
                                        type: 'container',
                                        html: inputField('btn_link', 'text', 'Button Link (optional)', 'Enter new if you want to change it')
                                    },
                                ],
                                buttons: [
                                    {
                                        text: "Ok",
                                        subtype: "primary",
                                        onclick: function() {
                                            win.submit();
                                        }
                                    },
                                    {
                                        text: "Cancel",
                                        onclick: function() {
                                            win.close();
                                        }
                                    }
                                ],
                                onsubmit: function(e){
                                    var id = $('select[name="categories_id"]').val();
                                    var btnName = $('input[name="btn_name"]').val();
                                    var btnLink = $('input[name="btn_link"]').val();
                                    var btnColor = $('select[name="btn_color"]').val();
                                    var newTitle = $('input[name="new_title"]').val();
                                    var description = $('textarea[name="description"]').val();

                                    var content = '[sub_content categories_id ="'+ id +'" ';
                                    content += newTitle !== '' ? 'new_title="'+ newTitle +'" ' : '';
                                    content += btnLink !== '' ? 'btn_link="'+ btnLink +'" ' : '';
                                    content += btnName !== '' ? 'btn_name="'+ btnName +'" ' : '';
                                    content += 'btn_color="'+ btnColor +'"]';
                                    content += description.length ? description : '';
                                    content += '[/sub_content]';
                                    ed.insertContent(content);
                                }
                            });
                        }
                    },
                    {
                        text: 'Posts',
                        onclick: function() {
                            var win = ed.windowManager.open({
                                title: 'Posts',
                                width: 600,
                                height: 540,
                                id: 'quest-post-tiny',
                                body: [
                                    {
                                        type : 'container',
                                        html: renderSelect('post_types'),
                                    },
                                    {
                                        type : 'container',
                                        id: 'post-list-select',
                                        html: renderSelect('posts', 'post'),
                                        script: setTimeout(
                                            function(){
                                                $( "#post-list-select .select-search" ).fSelect({
                                                    multiple:false
                                                })
                                            }
                                            , 200),
                                    },
                                    {
                                        type : 'container',
                                        html: renderFont(),
                                        script: setTimeout(
                                            function(){
                                                $( "#postFontIcon" ).fSelect({
                                                    multiple:false
                                                })
                                            }
                                            , 200),
                                    },
                                    {
                                        type: 'container',
                                        html: inputField('new_title', 'text', 'Title (optional)', 'Enter new if you want to change it')
                                    },
                                    {
                                        type: 'container',
                                        html: '<p>Description (optional): </p><textarea name="description" placeholder="Enter new if you want to change it" style="padding: 5px 0 5px 5px; width: 100%; border: 1px solid #ccc;"></textarea>'
                                    },
                                    {
                                        type: 'container',
                                        html: buttonColors()
                                    },
                                    {
                                        type: 'container',
                                        html: inputField('btn_name', 'text', 'Button Name (optional)', 'Enter new if you want to change it')
                                    },
                                    {
                                        type: 'container',
                                        html: inputField('btn_link', 'text', 'Button Link (optional)', 'Enter new if you want to change it')
                                    },
                                ],
                                buttons: [
                                    {
                                        text: "Ok",
                                        subtype: "primary",
                                        onclick: function() {
                                            win.submit();
                                        }
                                    },
                                    {
                                        text: "Cancel",
                                        onclick: function() {
                                            win.close();
                                        }
                                    }
                                ],
                                onsubmit: function(e){
                                    var id = $('select[name="posts_id"]').val();
                                    var btnName = $('input[name="btn_name"]').val();
                                    var btnLink = $('input[name="btn_link"]').val();
                                    var btnColor = $('select[name="btn_color"]').val();
                                    var newTitle = $('input[name="new_title"]').val();
                                    var description = $('textarea[name="description"]').val();
                                    var iconUrl = $('select[name="postFontIcon"]').val();

                                    var content = '[sub_content posts_id ="'+ id +'" ';
                                    content += newTitle !== '' ? 'new_title="'+ newTitle +'" ' : '';
                                    content += btnLink !== '' ? 'btn_link="'+ btnLink +'" ' : '';
                                    content += btnName !== '' ? 'btn_name="'+ btnName +'" ' : '';
                                    content += iconUrl !== '' ? 'icon_url="'+ iconUrl +'" ' : '';
                                    content += 'btn_color="'+ btnColor +'"]';
                                    content += description.length ? description : '';
                                    content += '[/sub_content]';
                                    ed.insertContent(content);
                                }
                            });
                        }
                    },
                    {
                        text: 'Quest Media',
                        onclick: function() {
                            var win = ed.windowManager.open({
                                title: 'Quest Media',
                                width: 600,
                                height: 500,
                                body: [
                                    {
                                        type: 'container',
                                        html: inputField('video_url', 'text', 'Youtube video link')
                                    },
                                    {
                                        type: 'container',
                                        html: imagePositionOptions()
                                    },
                                    {
                                        type: 'container',
                                        html: inputField('image_height', 'text', 'Image height (px, rem, em...)')
                                    },
                                    {
                                        type : 'container',
                                        html: uploadFileHtml('image_url', 'Image'),
                                        height: 200
                                    },
                                ],
                                buttons: [
                                    {
                                        text: "Ok",
                                        subtype: "primary",
                                        onclick: function() {
                                            win.submit();
                                        }
                                    },
                                    {
                                        text: "Cancel",
                                        onclick: function() {
                                            win.close();
                                        }
                                    }
                                ],
                                onsubmit: function(e){
                                    var video_url = $('input[name="video_url"]').val();
                                    var image_url = $('input[name="image_url"]').val();
                                    var image_height = $('input[name="image_height"]').val();
                                    var image_pos = $('select[name="image_position"]').val();

                                    var content = '[quest_media' +
                                        ' image_id="'+ image_url +'"' +
                                        ' height="' + image_height +'"' +
                                        ' position="' + image_pos +'" ';
                                    content += video_url ? 'video_link="'+ video_url +'"' : '';
                                    content += ']';

                                    ed.insertContent(content);

                                }
                            });
                        }
                    },
                    {
                        text: 'Career at Quest',
                        onclick: function() {
                            var content = '[career_at_quest]';
                            ed.insertContent(content);
                        }
                    },
                    {
                        text: 'Quest Links',
                        onclick: function() {
                            var win = ed.windowManager.open({
                                title: 'Quest Links',
                                width: 600,
                                height: 350,
                                id: 'quest-post-tiny',
                                body: [
                                    {
                                        type : 'container',
                                        html: renderSelect('post_types'),
                                    },
                                    {
                                        type : 'container',
                                        id: 'post-list-select',
                                        html: renderSelect('posts', 'post'),
                                        script: setTimeout(
                                            function(){
                                                $( "#post-list-select .select-search" ).fSelect({
                                                    multiple:false
                                                })
                                            }
                                            , 200),
                                    },
                                    {
                                        type: 'container',
                                        html: inputField('new_title', 'text', 'Title')
                                    },
                                    {
                                        type: 'container',
                                        html: inputField('font_size', 'number', 'Font size (px)', '', '14')
                                    },
                                    {
                                        type: 'container',
                                        html: textColors()
                                    }
                                ],
                                buttons: [
                                    {
                                        text: "Ok",
                                        subtype: "primary",
                                        onclick: function() {
                                            win.submit();
                                        }
                                    },
                                    {
                                        text: "Cancel",
                                        onclick: function() {
                                            win.close();
                                        }
                                    }
                                ],
                                onsubmit: function(e){
                                    var id = $('select[name="posts_id"]').val();
                                    var newTitle = $('input[name="new_title"]').val();
                                    var fontSize = $('input[name="font_size"]').val();
                                    var textColor = $('select[name="text_color"]').val();

                                    var content = '[quest_link post_id ="'+ id +'" ';
                                    content += newTitle !== '' ? 'title="'+ newTitle +'" ' : '';
                                    content += 'font_size="'+ fontSize +'" ';
                                    content += 'text_color="'+ textColor +'" ';
                                    content += ']';
                                    ed.insertContent(content);
                                }
                            });
                        }
                    },
                ]
            });

        },
        getInfo: function() {
            return {
                longname : 'My Custom Buttons',
                author : 'Plugin Author',
                authorurl : 'https://www.axosoft.com',
                version : "1.0"
            };
        }
    });
    tinymce.PluginManager.add( 'mytinymceplugin', tinymce.plugins.SubCategoriesShortcode );

    $(document).on('change', 'select[name="post_types_id"]', function (event) {
        // remove the all options of select and label
        $('#post-list-select').find('p').remove();
        $('#post-list-select').find('.fs-wrap').remove();
        // Add the new options
        var newSelect = renderSelect('posts', this.value);
        $('#post-list-select #post-list-select-body').append(newSelect);
        $( "#post-list-select .select-search" ).fSelect({
            multiple:false
        })
    });
})();