var NARASIX = NARASIX || {};

( function( $ ) {

    // USE STRICT
    "use strict";

    var $window = $( window );
    var $document = $( document );

    NARASIX.Utility = {

        getBackendVar: function( variableName ) {
            if ( typeof window[ 'narasixVar' ] === 'undefined' ) {
                return '';
            }

            if ( arguments.length == 1 ) {
                return window[ 'narasixVar' ][ variableName ];
            } else {
                var b = arguments[ 1 ]; // take second argument
                return window[ 'narasixVar' ][ variableName ][ b ];
            }
        }

    };

    NARASIX.documentOnReady = {

        init: function() {
            NARASIX.documentOnReady.modalGlobal();
            NARASIX.documentOnReady.ajaxLoadPosts();
            NARASIX.documentOnReady.backToTop.init();
            NARASIX.documentOnReady.heroPostSliderG();
            NARASIX.documentOnReady.galleryCarousel();
            NARASIX.documentOnReady.lightbox();
            NARASIX.documentOnReady.heroPostSliderF();
            NARASIX.documentOnReady.searchModalAutoFocus();
            NARASIX.documentOnReady.navbarSubMenuToggle();
            NARASIX.documentOnReady.offCanvasMenu();
            NARASIX.documentOnReady.blockPostCarouselA();
            NARASIX.documentOnReady.blockPostCarouselB();
            NARASIX.documentOnReady.socialShare();
            NARASIX.documentOnReady.horizonScroll();
            NARASIX.documentOnReady.blockPostD();
            NARASIX.documentOnReady.navMenuActive();
            NARASIX.documentOnReady.widgetSlider();
            NARASIX.documentOnReady.darkMode();
            NARASIX.documentOnReady.headerStickyMobile();
            NARASIX.documentOnReady.commentHelper();
            NARASIX.documentOnReady.headerSticky.init( {
                fixedHeader: '.js-sticky-header',
                headerPlaceHolder: '.js-sticky-header-holder',
            } );
            NARASIX.documentOnReady.stickySidebar();
            NARASIX.documentOnScroll.init();
        },

        /* ============================================================================
         * Modal Global
         * ==========================================================================*/
        modalGlobal: function() {
          $(document).ready(function () {
            // Open modal
            $(".modal-open").click(function () {
              var modalId = $(this).attr("data-modal");
              $(".modal").removeClass("active");
              $(".overlay").addClass("active");
              $(modalId).addClass("active");
              $("body").addClass("overflow-hidden");
            });
          
            // Close modal
            $(".overlay, .closemodal").click(function () {
              $(".overlay").removeClass("active");
              $(".modal").removeClass("active");
              $("body").removeClass("overflow-hidden");
            });
            
            // Close modal with esc
            $(document).keydown(function(event) { 
              if (event.keyCode === 27) { 
                $(".overlay").removeClass("active");
                $(".modal").removeClass("active");
                $("body").removeClass("overflow-hidden");
              }
            });
          });               
        },

        /* ============================================================================
         * Ajak Load Post
         * ==========================================================================*/
        ajaxLoadPosts: function() {

            var $blocks = $( '.js-nsix-ajax-load-more' );
            var ajaxURL = NARASIX.Utility.getBackendVar( 'ajaxURL' );
            var loadMoreText = NARASIX.Utility.getBackendVar( 'ajaxLoadPost', 'loadMoreText' );
            var loadingText = NARASIX.Utility.getBackendVar( 'ajaxLoadPost', 'loadingText' );
            var noMoreText = NARASIX.Utility.getBackendVar( 'ajaxLoadPost', 'noMoreText' );

            $blocks.each( function() {
                var $block = $( this );
                var $postsContainer = $block.find( '.js-nsix-ajax-content' );
                var $ajaxLoadBtn = $block.find( '.js-ajax-load-posts-btn' );
                var query = $block.data( 'query' ); // get query string data
                var offset = ( $block.data( 'offset' ) !== undefined ) ? $block.data( 'offset' ) : null;
                var postsPerPage = ( $block.data( 'posts-per-page' ) !== undefined ) ? $block.data( 'posts-per-page' ) : null;
                var currentPage = $block.data( 'currentPage' );
                var maxPages = ( $block.data( 'max-pages' ) !== undefined ) ? $block.data( 'max-pages' ) : null;
                var ignoreStickyPosts = ( $block.data( 'ignore-sticky-posts' ) !== undefined ) ? $block.data( 'ignore-sticky-posts' ) : null;
                var layout = ( $block.data( 'layout' ) !== undefined ) ? $block.data( 'layout' ) : null;
                var columns = ( $block.data( 'columns' ) !== undefined ) ? $block.data( 'columns' ) : null;
                var postTemplate = ( $block.data( 'post-template' ) !== undefined ) ? $block.data( 'post-template' ) : null;
                var postHeroTemplate = ( $block.data( 'hero-post-template' ) !== undefined ) ? $block.data( 'hero-post-template' ) : null;
                var postFormatIcon = ( $block.data( 'post-format-icon' ) !== undefined ) ? $block.data( 'post-format-icon' ) : null;
                var excerptLength = ( $block.data( 'excerpt-length' ) !== undefined ) ? $block.data( 'excerpt-length' ) : null;
                var excerptLengthHero = ( $block.data( 'excerpt-length-hero' ) !== undefined ) ? $block.data( 'excerpt-length-hero' ) : null;
                var postMetaAuthor = ( $block.data( 'post-meta-author' ) !== undefined ) ? $block.data( 'post-meta-author' ) : null;
                var postMetaDate = ( $block.data( 'post-meta-date' ) !== undefined ) ? $block.data( 'post-meta-date' ) : null;

                var args = {
                    block: $block,
                    postsContainer: $postsContainer,
                    ajaxLoadBtn: $ajaxLoadBtn,
                    query: query,
                    offset: offset,
                    postsPerPage: postsPerPage,
                    currentPage: currentPage,
                    maxPages: maxPages,
                    ignoreStickyPosts: ignoreStickyPosts,
                    layout: layout,
                    columns: columns,
                    postTemplate: postTemplate,
                    postHeroTemplate: postHeroTemplate,
                    postFormatIcon: postFormatIcon,
                    excerptLength: excerptLength,
                    excerptLengthHero: excerptLengthHero,
                    postMetaAuthor: postMetaAuthor,
                    postMetaDate: postMetaDate,
                };

                args = newArgs( args );

                $ajaxLoadBtn.on( 'click', function() {
                    if ( $ajaxLoadBtn.hasClass( 'is-active' ) ) {
                        btnState( $ajaxLoadBtn, 'loading' );
                        ajaxLoad( args );
                    }
                } );
            } );

            // Calculate new query args
            function newArgs( args ) {
                args.currentPage++;
                args.offset += args.postsPerPage;
                args.query = args.query.replace( /\boffset=(\d+)/, 'offset=' + args.offset );

                return args;
            };

            // Change button state
            function btnState( $btn, state ) {
                switch ( state ) {
                    case 'nomore':
                        $btn.removeClass( 'is-active' );
                        $btn.addClass( 'disabled' );
                        $btn.find( '.load-more-btn-text' ).text( noMoreText );
                        break;

                    case 'loading':
                        $btn.removeClass( 'is-active' );
                        $btn.addClass( 'is-loading' );
                        $btn.find( '.load-more-btn-text' ).text( loadingText );
                        break;

                    case 'ready':
                    default:
                        $btn.removeClass( 'is-loading' );
                        $btn.addClass( 'is-active' );
                        $btn.find( '.load-more-btn-text' ).text( loadMoreText );
                        break;
                }
            };

            // Update new data attributes for block.
            function updateState( args ) {
                args.block.attr( 'data-current-page', args.currentPage - 1 );
            };

            // Append loaded posts to existing list
            function appendRespond( respond, args ) {
                var $loadedPosts = $( respond );
                var $postsContainer = args.postsContainer;
                var $ajaxLoadBtn = args.ajaxLoadBtn;

                if ( $loadedPosts ) {
                    $loadedPosts.appendTo( $postsContainer ).css( 'opacity', 0 ).animate( { opacity: 1 }, 500 );
                    btnState( $ajaxLoadBtn, 'ready' );
                }
            };

            // Call AJAX request
            function ajaxLoad( args ) {
                var $ajaxLoadBtn = args.ajaxLoadBtn;
                var ajaxCall = $.ajax( {
                        url: ajaxURL,
                        type: 'post',
                        dataType: 'text',
                        data: {
                            action: 'ajax_load_post',
                            query: args.query,
                            postsPerPage: args.postsPerPage,
                            currentPage: args.currentPage,
                            ignoreStickyPosts: args.ignoreStickyPosts,
                            layout: args.layout,
                            columns: args.columns,
                            postTemplate: args.postTemplate,
                            postHeroTemplate: args.postHeroTemplate,
                            postFormatIcon: args.postFormatIcon,
                            excerptLength: args.excerptLength,
                            excerptLengthHero: args.excerptLengthHero,
                            postMetaAuthor: args.postMetaAuthor,
                            postMetaDate: args.postMetaDate,
                        },
                    } );

                ajaxCall.done( function( respond ) {
                    appendRespond( respond, args );
                    args = newArgs( args );
                    updateState( args );
                    if ( args.currentPage > args.maxPages ) {
                        btnState( $ajaxLoadBtn, 'nomore' );
                        $ajaxLoadBtn.off( 'click' );
                    }
                } );

                ajaxCall.fail( function() {
                    console.log( 'AJAX failed' );
                } );
            };
        },

        /* ============================================================================
         * Gallery Carousel
         * ==========================================================================*/
        galleryCarousel: function() {
            var mySwiper = new Swiper ('.js-nsix-gallery-carousel', {
                slidesPerView: 'auto',
                spaceBetween: 18,
                freeMode: true,
                scrollbar: {
                    el: '.swiper-scrollbar',
                },
            });
        },

        /* ============================================================================
         * Image Lightbox
         * ==========================================================================*/
        lightbox: function() {
            if ( !$( '.pswp' ).length ) {
                var pswpMarkup = '<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true"> <div class="pswp__bg"></div><div class="pswp__scroll-wrap"> <div class="pswp__container"> <div class="pswp__item"></div><div class="pswp__item"></div><div class="pswp__item"></div></div><div class="pswp__ui pswp__ui--hidden"> <div class="pswp__top-bar"> <div class="pswp__counter"></div><button class="pswp__button pswp__button--close" title="Close (Esc)"></button> <button class="pswp__button pswp__button--share" title="Share"></button> <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button> <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button> <div class="pswp__preloader"> <div class="pswp__preloader__icn"> <div class="pswp__preloader__cut"> <div class="pswp__preloader__donut"></div></div></div></div></div><div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap"> <div class="pswp__share-tooltip"></div></div><button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"> </button> <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"> </button> <div class="pswp__caption"> <div class="pswp__caption__center"></div></div></div></div></div>';
                $( '.content-single' ).append( pswpMarkup );
                var pswpElement = document.querySelectorAll('.pswp')[0];
            } else {
                var pswpElement = document.querySelectorAll('.pswp')[0];
            }

            // define options (if needed)
            var options = {
                // optionName: 'option value'
                // for example:
                index: 0 // start at first slide
            };

            var initPhotoSwipeFromDOM = function(gallerySelector) {

                // parse slide data (url, title, size ...) from DOM elements 
                // (children of gallerySelector)
                var parseThumbnailElements = function(el) {
                    var thumbElements = el.childNodes,
                        numNodes = thumbElements.length,
                        items = [],
                        figureEl,
                        linkEl,
                        size,
                        item;

                    for(var i = 0; i < numNodes; i++) {

                        figureEl = thumbElements[i]; // <figure> element

                        // include only element nodes 
                        if(figureEl.nodeType !== 1) {
                            continue;
                        }

                        linkEl = figureEl.children[0]; // <a> element

                        size = linkEl.getAttribute('data-size').split('x');

                        // create slide object
                        item = {
                            src: linkEl.getAttribute('href'),
                            w: parseInt(size[0], 10),
                            h: parseInt(size[1], 10)
                        };



                        if(figureEl.children.length > 1) {
                            // <figcaption> content
                            item.title = figureEl.children[1].innerHTML; 
                        }

                        if(linkEl.children.length > 0) {
                            // <img> thumbnail element, retrieving thumbnail url
                            item.msrc = linkEl.children[0].getAttribute('src');
                        } 

                        item.el = figureEl; // save link to element for getThumbBoundsFn
                        items.push(item);
                    }

                    return items;
                };

                // find nearest parent element
                var closest = function closest(el, fn) {
                    return el && ( fn(el) ? el : closest(el.parentNode, fn) );
                };

                // triggers when user clicks on thumbnail
                var onThumbnailsClick = function(e) {
                    e = e || window.event;
                    e.preventDefault ? e.preventDefault() : e.returnValue = false;

                    var eTarget = e.target || e.srcElement;

                    // find root element of slide
                    var clickedListItem = closest(eTarget, function(el) {
                        return (el.tagName && el.tagName.toUpperCase() === 'FIGURE');
                    });

                    if(!clickedListItem) {
                        return;
                    }

                    // find index of clicked item by looping through all child nodes
                    // alternatively, you may define index via data- attribute
                    var clickedGallery = clickedListItem.parentNode,
                        childNodes = clickedListItem.parentNode.childNodes,
                        numChildNodes = childNodes.length,
                        nodeIndex = 0,
                        index;

                    for (var i = 0; i < numChildNodes; i++) {
                        if(childNodes[i].nodeType !== 1) { 
                            continue; 
                        }

                        if(childNodes[i] === clickedListItem) {
                            index = nodeIndex;
                            break;
                        }
                        nodeIndex++;
                    }



                    if(index >= 0) {
                        // open PhotoSwipe if valid index found
                        openPhotoSwipe( index, clickedGallery );
                    }
                    return false;
                };

                // parse picture index and gallery index from URL (#&pid=1&gid=2)
                var photoswipeParseHash = function() {
                    var hash = window.location.hash.substring(1),
                    params = {};

                    if(hash.length < 5) {
                        return params;
                    }

                    var vars = hash.split('&');
                    for (var i = 0; i < vars.length; i++) {
                        if(!vars[i]) {
                            continue;
                        }
                        var pair = vars[i].split('=');  
                        if(pair.length < 2) {
                            continue;
                        }           
                        params[pair[0]] = pair[1];
                    }

                    if(params.gid) {
                        params.gid = parseInt(params.gid, 10);
                    }

                    return params;
                };

                var openPhotoSwipe = function(index, galleryElement, disableAnimation, fromURL) {
                    var pswpElement = document.querySelectorAll('.pswp')[0],
                        gallery,
                        options,
                        items;

                    items = parseThumbnailElements(galleryElement);

                    // define options (if needed)
                    options = {

                        // define gallery index (for URL)
                        galleryUID: galleryElement.getAttribute('data-pswp-uid'),

                        getThumbBoundsFn: function(index) {
                            // See Options -> getThumbBoundsFn section of documentation for more info
                            var thumbnail = items[index].el.getElementsByTagName('img')[0], // find thumbnail
                                pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
                                rect = thumbnail.getBoundingClientRect(); 

                            return {x:rect.left, y:rect.top + pageYScroll, w:rect.width};
                        },

                        showHideOpacity: true,

                    };

                    // PhotoSwipe opened from URL
                    if(fromURL) {
                        if(options.galleryPIDs) {
                            // parse real index when custom PIDs are used
                            for(var j = 0; j < items.length; j++) {
                                if(items[j].pid == index) {
                                    options.index = j;
                                    break;
                                }
                            }
                        } else {
                            // in URL indexes start from 1
                            options.index = parseInt(index, 10) - 1;
                        }
                    } else {
                        options.index = parseInt(index, 10);
                    }

                    // exit if index not found
                    if( isNaN(options.index) ) {
                        return;
                    }

                    if(disableAnimation) {
                        options.showAnimationDuration = 0;
                    }

                    // Pass data to PhotoSwipe and initialize it
                    gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
                    gallery.init();
                };

                // loop through all gallery elements and bind events
                var galleryElements = document.querySelectorAll( gallerySelector );

                for(var i = 0, l = galleryElements.length; i < l; i++) {
                    galleryElements[i].setAttribute('data-pswp-uid', i+1);
                    galleryElements[i].onclick = onThumbnailsClick;
                }

                // Parse URL and open gallery if it contains #&pid=3&gid=1
                var hashData = photoswipeParseHash();
                if(hashData.pid && hashData.gid) {
                    openPhotoSwipe( hashData.pid ,  galleryElements[ hashData.gid - 1 ], true, true );
                }
            };

            // execute above function
            initPhotoSwipeFromDOM('.js-nsix-lightbox-gallery');
        },

        /* ============================================================================
         * Hero Post Slider F
         * ==========================================================================*/
        heroPostSliderF: function() {
            if ( typeof Swiper === 'function' ) { // check if Swiper script is loaded
              var $heroPostSliderF = $( '.js-hero-post-slider-f' );
              $heroPostSliderF.each( function( i, heroPostSliderF ) {
                var heroPostSliderFConfigs = {
                  speed: 300,
                  parallax: true,
                  preventClicks: true,
                  direction: 'horizontal',
                  loop: true,
                  effect: 'slide',
                  spaceBetween: 15,
                  centeredSlides: true,
                  slidesOffsetBefore: 0,
                  grabCursor: true,
                  breakpoints: {
                      320: {
                          slidesPerView: 1.2,
                          spaceBetween: 10
                      },
                      640: {
                          slidesPerView: 1.6
                      }
                  }
                }
                var swiper = new Swiper( heroPostSliderF, heroPostSliderFConfigs );
                swiper.init();
              });
            }
        },

        /* ============================================================================
         * Hero Post Slider G
         * ==========================================================================*/
        heroPostSliderG: function() {
          if ( $.isFunction( $.fn.slick ) ) { // check if Slick script is loaded
              var $heroPostSliderGs = $( '.js-hero-post-slider-g' );
              $heroPostSliderGs.each( function( i, heroPostSliderG ) {
                  var $heroPostSliderG = $( heroPostSliderG );
                  var $heroPostSliderGNav = $heroPostSliderG.siblings( '.js-hero-post-slider-nav' )
                  var $heroPostSliderGNavItems = $heroPostSliderG.siblings( '.js-hero-post-slider-nav' ).find( '.slider-navigation-item' );
                  var navItemsCount = $heroPostSliderGNavItems.length - 1;
                  var autoplay = ( $heroPostSliderG.data( 'autoplay' ) == true );
                  var speed = parseInt( $heroPostSliderG.data( 'speed' ) );
                  if ( !speed ) {
                      speed = 6000;
                  }

                  // Slick settings.
                  $heroPostSliderG.slick( {
                      slidesToShow: 1,
                      arrows: false,
                      autoplay: autoplay,
                      autoplaySpeed: speed,
                      pauseOnHover: false,
                      fade: true,
                      speed: 400,
                      cssEase: 'ease-in',
                      waitForAnimate: true,
                      adaptiveHeight: true,
                  } );

                  // Change active slider on click.
                  $heroPostSliderGNav.on( 'click', '.slider-navigation-item', function() {
                      var index = $( this ).index();
                      $heroPostSliderG.slick( 'slickGoTo', index );
                  } );

                  // Change active slider nav on change.
                  $heroPostSliderG.on( 'beforeChange', function( event, slick, currentSlide, nextSlide ) {
                      var $currentNavItem = $heroPostSliderGNavItems.eq( currentSlide );
                      var $nextNavItem = $heroPostSliderGNavItems.eq( nextSlide );
                      $heroPostSliderGNavItems.removeClass( 'is-active' );
                      $nextNavItem.addClass( 'is-active' );
                  } );
              } );
          }
        },
        
        /* ============================================================================
         * Post Carousel A
         * ==========================================================================*/
        blockPostCarouselA: function() {
            if ( typeof Swiper === 'function' ) { // check if Swiper script is loaded
                var $carousels = $( '.js-post-carousel-a' );
                $carousels.each( function( i, carousel ) {
                    var $carousel = $( carousel );
                    var spaceBetween = 20;
                    var slidesPerView = 4.45;
                    var $paginationCurrent = $carousel.siblings( '.i_nav' ).find( '.nsix-carousel-pagination-current' );
                    var $paginationTotal = $carousel.siblings( '.i_nav' ).find( '.nsix-carousel-pagination-total' );
                    var $paginationCurrentHidden;
                    var $paginationTotalHidden;
                    var $prevBtn = $carousel.siblings( '.i_nav' ).find( '.nsix-carousel-prev-btn' );
                    var $nextBtn = $carousel.siblings( '.i_nav' ).find( '.nsix-carousel-next-btn' );
                    var $prevBtn = $carousel.siblings( '.i_nav' ).find( '.nsix-carousel-prev-btn' );
                    var carouselConfigs = {
                        init: false,
                        slidesPerView: 'auto',
                        spaceBetween: spaceBetween,
                        watchOverflow: true,
                        freeMode: true,
                        grabCursor: true,
                        pagination: {
                            el: '.nsix-carousel-hidden-pagination',
                            type: 'fraction',
                        },
                    }

                    if ( !$carousel.hasClass( 'nsix-carousel-auto-width' ) ) {
                        carouselConfigs.slidesPerView = 1.45;
                        carouselConfigs.breakpoints = {
                            576: {
                                slidesPerView: 2.45,
                            },
                            768: {
                                slidesPerView: 3.45,
                            },
                            992: {
                                slidesPerView: 4.45,
                            },
                            1200: {
                                slidesPerView: slidesPerView,
                            }
                        };
                    }

                    var swiper = new Swiper( carousel, carouselConfigs );

                    swiper.once( 'init', function () {
                        $paginationCurrentHidden = $carousel.find( '.nsix-carousel-hidden-pagination .swiper-pagination-current' );
                        $paginationTotalHidden = $carousel.find( '.nsix-carousel-hidden-pagination .swiper-pagination-total' );
                        $paginationTotal.text( $paginationTotalHidden.text() );
                    } );

                    swiper.init();

                    swiper.on( 'slideChange', function () {
                        $paginationCurrent.text( $paginationCurrentHidden.text() );
                    } );

                    swiper.on( 'resize', function () {
                        $paginationCurrentHidden = $carousel.find( '.nsix-carousel-hidden-pagination .swiper-pagination-current' );
                        $paginationTotalHidden = $carousel.find( '.nsix-carousel-hidden-pagination .swiper-pagination-total' );
                        $paginationCurrent.text( $paginationCurrentHidden.text() );
                        $paginationTotal.text( $paginationTotalHidden.text() );
                    } );

                    // Previous button
                    $prevBtn.on( 'click', function( e ) {
                        swiper.slidePrev();
                    } );

                    // Next button
                    $nextBtn.on( 'click', function( e ) {
                        swiper.slideNext();
                    } );
                } );
            }
        },

        /* ============================================================================
         * Post Carousel B
         * ==========================================================================*/
        blockPostCarouselB: function() {
            if ( typeof Swiper === 'function' ) { // check if Swiper script is loaded
                var $carousels = $( '.js-post-carousel-b' );
                $carousels.each( function( i, carousel ) {
                    var $carousel = $( carousel );
                    var spaceBetween = 20;
                    var slidesPerView = 4.45;
                    var carouselConfigs = {
                        init: false,
                        slidesPerView: 'auto',
                        spaceBetween: spaceBetween,
                        watchOverflow: true,
                        freeMode: true,
                        grabCursor: true,
                        navigation: {
                            nextEl: ".button--next",
                            prevEl: ".button--prev",
                          },
                    }

                    if ( !$carousel.hasClass( 'nsix-carousel-auto-width' ) ) {
                        carouselConfigs.slidesPerView = 1.45;
                        carouselConfigs.breakpoints = {
                            // 576: {
                            //     slidesPerView: 2.45,
                            // },
                            768: {
                                slidesPerView: 2.45,
                            },
                            992: {
                                slidesPerView: 3.45,
                            },
                            1200: {
                                slidesPerView: slidesPerView,
                            }
                        };
                    }

                    var swiper = new Swiper( carousel, carouselConfigs );


                    swiper.init();
                } );
            }
         },

        /* ============================================================================
         * Offcanvas Menu
         * ==========================================================================*/
        offCanvasMenu: function() {
          var $backdrop = $('<div class="nsix-offcanvas-backdrop"></div>');
          var $offcanvas = $('.js-nsix-offcanvas');
          var $offcanvasToggle = $('.js-nsix-offcanvas-toggle');
          var $offcanvasClose = $('.js-nsix-offcanvas-close');
          var $menuItemsHasChildren = $( '.nsix-offcanvas .offcanvas-navigation li.menu-item-has-children' );

          function closeOffcanvas() {
              $offcanvas.removeClass( 'is-active' );
              $('body').removeClass('overflow-hidden');
              $backdrop.removeClass( 'is-shown' );
              setTimeout( function() {
                  $backdrop.detach();
              }, 300 );
          }

          $backdrop.on( 'click', function() {
              closeOffcanvas();
          } );

          $offcanvasToggle.on( 'click', function( e ) {
              e.preventDefault();
              var targetID = $( this ).attr( 'href' );
              var $target = $( targetID );
              $target.toggleClass( 'is-active' );
              $('body').addClass('overflow-hidden');
              $backdrop.appendTo( document.body );
              setTimeout( function() {
                  $backdrop.addClass( 'is-shown' );
              }, 1 );
          } );

          $offcanvasClose.on( 'click', function( e ) {
              e.preventDefault();
              closeOffcanvas();
          } );

          // Toggle submenu on click
          $menuItemsHasChildren.each( function() {
              var $menuItemHasChildren = $( this );

              $menuItemHasChildren.on( 'click', 'a, li', function( e ) {
                  if ( $( e.target ).attr( 'href' ) === '#' ) {
                      e.preventDefault(); // Menu item is just a placeholder link
                  } else {
                      e.stopPropagation();
                  }
              } );

              $menuItemHasChildren.on( 'click', function() {
                  $menuItemHasChildren.toggleClass( 'is-sub-menu-opened' );
              } );
          } );
        },

        /* ============================================================================
         * Navbar Search Modal
         * ==========================================================================*/
        searchModalAutoFocus: function() {
            var $searchModal = $( '#nsix-search-modal' );

            $searchModal.on( 'shown.bs.modal', function() {
                $searchModal.find( '.search-field' ).focus();
            } );

            function search() {
                // Ambil nilai dari input pencarian
                var s = $('input[name=s]').val();
    
                // Jalankan pencarian jika input tidak kosong
                if (s) {
                    // Tampilkan spinner loading
                    $('#search-results').html('<div class="w-full grid justify-center h-44 content-center">' +
                                                  '<svg class="-ml-1 mr-3 h-5 w-5 animate-spin" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">' +
                                                      '<circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>' +
                                                      '<path class="opacity-75" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" fill="currentColor"/>' +
                                                  '</svg>' +
                                              '</div>');
                    // Buat request AJAX
                    $.ajax({
                        url: '<?php echo home_url( '/' ); ?>',
                        data: {
                            s: s,
                            action: 'search'
                        },
                        type: 'GET',
                        dataType: 'html',
                        success: function(response) {
                            // Tampilkan hasil pencarian di tempat yang sesuai
                            $('#search-results').html(response);
                        }
                    });
                } else {
                    // Kosongkan hasil pencarian jika input kosong
                    $('#search-results').html('');
                }
            }
    
            // Event handler untuk input pencarian
            $('input[name=s]').keyup(function() {
                search();
            });
            
        },

        /* ============================================================================
         * Navbar Sub Menu Toggle
         * ==========================================================================*/
        navbarSubMenuToggle: function() {
            var $navbarMenuItem = $( '.site-header-navigation li.menu-item-has-children' );
            $navbarMenuItem.on( 'click', function() {
                $( this ).children( '.sub-menu' ).slideToggle( 200 );
            } );
            $navbarMenuItem.on( 'click', 'a, li', function( e ) {
                e.stopPropagation();
            } );
        },

        /* ============================================================================
         * Sticky Header Desktop
         * ==========================================================================*/
        headerSticky: {
            // settings, obtained from ext
            headerPlaceHolder: '', // static header navbar.
            fixedHeader: '', // fixed header object. 
            isDisabled: false,
            isFixed: false,
            isShown: false,
            windowScrollTop: 0,
            lastWindowScrollTop: 0, // last scrollTop position, used to calculate the scroll direction
            offCheckpoint: 0, // distance from top where fixed header will be hidden.
            onCheckpoint: 0, // distance from top where fixed header can show up.

            init : function init( options ) {

                // Read the settings
                this.fixedHeader = $( options.fixedHeader );
                this.headerPlaceHolder = $( options.headerPlaceHolder );

                // Check if selectors exist
                if( !this.fixedHeader.length ) {
                    return;
                }

                $document.ready( function() {
                    // Unhide header
                    NARASIX.documentOnReady.headerSticky.fixedHeader.css( 'display', 'block' );
                    // Compute on semi dom ready
                    NARASIX.documentOnReady.headerSticky.compute();
                } );

                // Recompute when all the page + logos are loaded
                $window.load( function() {
                    NARASIX.documentOnReady.headerSticky.compute();
                    NARASIX.documentOnReady.headerSticky.updateState();
                } );

            },// End init

            compute: function compute() {
                // Set where from top fixed header starts showing up
                if( !this.headerPlaceHolder.length ) {
                    this.offCheckpoint = 500;
                } else {
                    this.offCheckpoint = $( this.headerPlaceHolder ).offset().top + $( this.headerPlaceHolder ).outerHeight( true ) + 400;
                }

                this.onCheckpoint = this.offCheckpoint + 500;

                // Compute affixed state
                if ( $window.width() < 992 ) {  // Disable on small screen
                    this.isDisabled = true;
                } else {
                    this.windowScrollTop = $window.scrollTop();
                    if ( this.offCheckpoint < this.windowScrollTop ) {
                        this.isFixed = true;
                    }
                }
            },

            updateState: function updateState(){
                // Update affixed state
                if ( this.isFixed ) {
                    this.fixedHeader.addClass( 'is-fixed' );
                } else {
                    this.fixedHeader.removeClass( 'is-fixed' );
                }

                if ( this.isShown ) {
                    this.fixedHeader.addClass( 'is-shown' );
                } else {
                    this.fixedHeader.removeClass( 'is-shown' );
                }
            },

            /**
             * Called by events on scroll
             */

            eventScroll: function eventScroll( scrollTop ) {
                var scrollDirection = '';
                var scrollDelta = 0;

                // check if disabled
                if ( this.isDisabled ) {
                    return;
                }

                // check the direction
                if ( scrollTop != this.lastWindowScrollTop ) { //compute direction only if we have different last scroll top

                    // compute the direction of the scroll
                    if ( scrollTop > this.lastWindowScrollTop ) {
                        scrollDirection = 'down';
                    } else {
                        scrollDirection = 'up';
                    }

                    //calculate the scroll delta
                    scrollDelta = Math.abs( scrollTop - this.lastWindowScrollTop );
                    this.lastWindowScrollTop = scrollTop;

                    // update affix state
                    if ( this.offCheckpoint < scrollTop ) {
                        this.isFixed = true;
                    } else {
                        this.isFixed = false;
                    }

                    // check affix state
                    if ( this.isFixed ) {
                        // We're in affixed state, let's do some check
                        if ( ( scrollDirection == 'down' ) && ( scrollDelta > 14 ) ) {
                            if ( this.isShown ) {
                                this.isShown = false; // hide menu
                            }
                        } else {
                            if ( ( !this.isShown ) && ( scrollDelta > 14 ) && ( this.onCheckpoint < scrollTop ) ) {
                                this.isShown = true; // show menu
                            }
                        }
                    } else {
                        this.isShown = false;
                    }

                    this.updateState(); // update state
                }
            }, // end eventScroll function

            /**
             * Called by events on resize
             */

            eventResize: function eventResize( windowWidth ) {
                if ( windowWidth >= 992 ) {
                    this.isDisabled = false;
                    this.fixedHeader.addClass( 'is-shown' );
                } else {
                    this.isDisabled = true;
                    this.fixedHeader.removeClass( 'is-shown' );
                }
            },
        },

        /* ============================================================================
         * Sticky Header Mobile
         * ==========================================================================*/
        headerStickyMobile: function(){
          var lastScroll = 0;
          var isScrolled = false;
          var topHeader = document.querySelector(".header-mobile-sticky");

          window.addEventListener("scroll", function () {
              if (!topHeader) return;

              var currentScroll = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
              var scrollDirection = currentScroll < lastScroll;
              var shouldToggle = isScrolled && scrollDirection;
              isScrolled = currentScroll > 100;
              topHeader.classList.toggle("sticky-active", shouldToggle);
              lastScroll = currentScroll;
          });
        },

        /* ============================================================================
         * Sticky sidebar
         * ==========================================================================*/
        stickySidebar: function() {
            if ( $.isFunction( $.fn.theiaStickySidebar ) ) { // check if function exists
                var stickySidebarMarginTop = NARASIX.Utility.getBackendVar( 'stickySidebarMarginTop' );
                jQuery( '.js-nsix-sticky-sidebar' ).theiaStickySidebar( {
                    additionalMarginTop: stickySidebarMarginTop,
                    additionalMarginBottom: 20,
                } );
            }
        },

         /* ============================================================================
         * Social Share
         * ==========================================================================*/
        socialShare: function() {
            var swiper = new Swiper('#scroll-share', {
              direction: 'horizontal',
              slidesPerView: 'auto',
              freeMode: true,
              scrollbar: {
                  el: '.swiper-scrollbar',
              },
              mousewheel: true,
          });

          $('.swiper-scrollbar').show();
        },

         /* ============================================================================
         * Block Post D
         * ==========================================================================*/
        blockPostD: function() {
            if ( typeof Swiper === 'function' ) { // check if Swiper script is loaded
              if(window.innerWidth < 1200) {
                  new Swiper(".swiper-block_post_d",{
                      direction: "horizontal",
                      slidesPerView: 1,
                      paginationClickable: !0,
                      spaceBetween: 0,
                      autoplay: 2500,
                      grabCursor: true,
                      navigation: {
                        nextEl: ".button-next",
                        prevEl: ".button-prev",
                      },
                    }
                  )
              } else {
                  new Swiper(".swiper-block_post_d",{
                      direction: "horizontal",
                      slidesPerView: 1,
                      parallax: !0,
                      paginationClickable: !0,
                      spaceBetween: 0,
                      speed: 1500,
                      autoplay: 2500,
                      grabCursor: true,
                      navigation: {
                        nextEl: ".button-next",
                        prevEl: ".button-prev",
                      },
                  }
                )
              }
            }
        },

         /* ============================================================================
         * Scroll Horizontal
         * ==========================================================================*/
        horizonScroll: function() {
          const sliders = document.querySelectorAll('.scrolling-wrapper');
          sliders.forEach(slider => {
              let isDown = false;
              let startX;
              let scrollLeft;

              slider.addEventListener('mousedown', (e) => {
                  let rect = slider.getBoundingClientRect();
                  isDown = true;
                  slider.classList.add('active');
                  // Get initial mouse position
                  startX = e.pageX - rect.left;
                  // Get initial scroll position in pixels from left
                  scrollLeft = slider.scrollLeft;
                  console.log(startX, scrollLeft);
              });

              slider.addEventListener('mouseleave', () => {
                  isDown = false;
                  slider.dataset.dragging = false;
                  slider.classList.remove('active');
              });

              slider.addEventListener('mouseup', () => {
                  isDown = false;
                  slider.dataset.dragging = false;
                  slider.classList.remove('active');
              });

              slider.addEventListener('mousemove', (e) => {
                  if (!isDown) return;
                  let rect = slider.getBoundingClientRect();
                  e.preventDefault();
                  slider.dataset.dragging = true;
                  // Get new mouse position
                  const x = e.pageX - rect.left;
                  // Get distance mouse has moved (new mouse position minus initial mouse position)
                  const walk = (x - startX);
                  // Update scroll position of slider from left (amount mouse has moved minus initial scroll position)
                  slider.scrollLeft = scrollLeft - walk;
                  console.log(x, walk, slider.scrollLeft);
              });
          });

        },

         /* ============================================================================
         * Nav Manu Active
         * ==========================================================================*/
        navMenuActive: function() {
          var currentUrl = window.location.href;
          var menuItems = document.querySelectorAll(".navigation .menu-item a");
          menuItems.forEach(function(item) {
            if (item.href === currentUrl) {
              item.parentElement.classList.add("active");
            } else {
              item.parentElement.classList.remove("active");
            }
          });
        },

         /* ============================================================================
         * Widget Slider
         * ==========================================================================*/
        widgetSlider: function() {
          if ( typeof Swiper === 'function' ) { // check if Swiper script is loaded
          var swiper = new Swiper(".widget-slider", {
            spaceBetween: 10,
            pagination: {
              el: '.swiper-pagination',
              clickable: true,
            },
          });
          }
        },
        
        /* ============================================================================
         * Back to top btn
         * ==========================================================================*/
        backToTop: {
          backTopBtn: null,

          init: function() {
              this.backTopBtn = $( '.js-nsix-back-top-btn' );
              if ( this.backTopBtn.length ) {
                  this.backTopBtn.on( 'click', function() {
                      $( 'html, body' ).animate(
                          {
                              scrollTop: 0,
                          },
                          {
                              duration: 200,
                              easing: 'swing',
                          }
                      );
                  } );
              }
          },

          eventScroll: function eventScroll( scrollTop ) {
              if ( scrollTop > $window.height() ) {
                  this.backTopBtn.addClass( 'is-shown' );
              } else {
                  this.backTopBtn.removeClass( 'is-shown' );
              }
          },
        },

        /* ============================================================================
         * Dark Mode
         * ==========================================================================*/
        darkMode: function(){
            var icon = document.querySelector(".icons");
    
            if (localStorage.theme === 'dark') {
                document.documentElement.classList.add('dark');
                icon.classList.remove("icon-sun");
                icon.classList.add("icon-moon");
            } else {
                document.documentElement.classList.remove('dark');
                icon.classList.remove("icon-moon");
                icon.classList.add("icon-sun");
            }
        },
    
        toggleDarkMode: function() {
            var icon = document.querySelector(".icons");
    
            if (document.documentElement.classList.contains('dark')) {
                icon.classList.remove("icon-sun");
                icon.classList.add("icon-moon");
                document.documentElement.classList.remove('dark');
                localStorage.theme = 'light';
            } else {
                icon.classList.remove("icon-moon");
                icon.classList.add("icon-sun");
                document.documentElement.classList.add('dark');
                localStorage.theme = 'dark';
            }
        },

        /* ============================================================================
         * Comment Helper
         * ==========================================================================*/
        commentHelper: function(){
          jQuery(document).ready(function($) {
            if ($('#commentform').length) {
              $('#commentform').validate({
                onfocusout: function(element) {
                  this.element(element);
                },
                
                rules: {
                  author: {
                    required: true,
                    normalizer: function(value) { return $.trim(value); }
                  },
                
                  email: {
                    required: true,
                    email: true
                  },
                },
                
                messages: {
                  author: "*Name require.",
                  email: "*Email require.",
                },
                
                errorElement: "small",
                errorPlacement: function(error, element) {
                  element.before(error);
                }
              });

            }
          });
        },
    };

    NARASIX.documentOnScroll = {
        ticking: false,
        windowScrollTop: 0, // used to store the scrollTop

        init: function() {
            window.addEventListener( 'scroll', function( e ) {
                if ( !NARASIX.documentOnScroll.ticking ) {
                    window.requestAnimationFrame( function() {
                        NARASIX.documentOnScroll.windowScrollTop = $window.scrollTop();

                        // Functions to call here
                        NARASIX.documentOnReady.backToTop.eventScroll( NARASIX.documentOnScroll.windowScrollTop );
                        NARASIX.documentOnReady.headerSticky.eventScroll( NARASIX.documentOnScroll.windowScrollTop );

                        NARASIX.documentOnScroll.ticking = false;
                    } );
                }
                NARASIX.documentOnScroll.ticking = true;
            } );
        },
    }; // NARASIX.documentOnScroll

    NARASIX.documentOnResize = {
        ticking: false,
        windowWidth: 0, // used to store window's width

        init: function() {
            window.addEventListener('resize', function(e) {
                if (!NARASIX.documentOnResize.ticking) {
                    window.requestAnimationFrame(function() {
                        NARASIX.documentOnResize.windowWidth = $window.width();

                        // Functions to call here
                        NARASIX.documentOnReady.headerSticky.eventResize( NARASIX.documentOnResize.windowWidth );

                        NARASIX.documentOnResize.ticking = false;
                    });
                }
                NARASIX.documentOnResize.ticking = true;
            });
        },
    }; // NARASIX.documentOnResize


    $document.ready( NARASIX.documentOnReady.init );
    $window.on( 'resize', NARASIX.documentOnResize.init );

} )( jQuery );
