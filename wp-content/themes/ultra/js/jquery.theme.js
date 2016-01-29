/**
 * Main theme Javascript - (c) Greg Priday, freely distributable under the terms of the GPL 2.0 license.
 */

jQuery(function($){ 

    // Setup fitvids for entry content and panels
    if(typeof $.fn.fitVids != 'undefined') {
        $('.entry-content, .entry-content .panel' ).fitVids();
    }

    // Substitute any retina images
    var pixelRatio = !!window.devicePixelRatio ? window.devicePixelRatio : 1;
    if( pixelRatio > 1 ) {
        $('img[data-retina-image]').each(function(){
            var $$ = $(this);
            $$.attr('src', $$.data('retina-image'));

            // If the width attribute isn't set, then lets scale to 50%
            if( typeof $$.attr('width') == 'undefined' ) {
                $$.load( function(){
                    var size = [$$.width(), $$.height()];
                    $$.width(size[0]/2);
                    $$.height(size[1]/2);
                } );
            }
        })
    }      

    // Top bar menu hover effects
    $('#top-bar')
        .on('mouseenter', '.top-bar-navigation ul li', function(){
            var $$ = $(this);
            var $ul = $$.find('> ul');
            $ul.css({
                'display' : 'block',
                'opacity' : 0
            }).clearQueue().animate({opacity: 1}, 250);
            $ul.data('final-opacity', 1);
        } )
        .on('mouseleave', '.top-bar-navigation ul li', function(){
            var $$ = $(this);
            var $ul = $$.find('> ul');
            $ul.clearQueue().animate( {opacity: 0}, 250, function(){
                if($ul.data('final-opacity') == 0) {
                    $ul.css('display', 'none');
                }
            });
            $ul.data('final-opacity', 0);
        } ); 

        if( $('body').hasClass('resp') && $('body').hasClass('resp-top-bar') ) {
            // Top bar menu responsive behaviour
            function hidingHeader( selector, breakpointWidth ) {
                return {
                    _selector: selector,
                    _breakpointWidth: breakpointWidth,
                    _duration: 500,
                    _firstRun: true,
                    _forceToShow: false,
                    _animating: false,
                    _currentState: '',
                    _startingState: '',
                    _eventCb: { stateStart: false, stateEnd: false },
    
                    _get: function() {
                        return $(this._selector);
                    },
                    _getState: function() {
                        if( window.innerWidth >= this._breakpointWidth ) return 'show';
                        if( this._forceToShow ) return 'force';
                        return 'hide';
                    },
                    _setNewState: function( newState, start ) {
                        if( this._currentState == newState ) return;
                        if( start ) {
                            if( this._startingState != newState ) {
                                this._startingState = newState;
                                if( this._eventCb.stateStart ) this._eventCb.stateStart( newState );
                            }
                        } else {
                            this._currentState = newState;
                            if( this._eventCb.stateEnd ) this._eventCb.stateEnd( newState );
                        }
                    },
                    _hide: function( animate ) {
                        var header = this._get();
                        var self = this;
                        var css = {
                            'margin-top': -header.height()+'px'
                        };
                        this._setNewState( 'hide', true );
                        if( animate ) {
                            this._animating = true;
                            header.animate( css, {
                                duration: this._duration,
                                step: function( now, fx ) {
                                    if( -self._get().height() != fx.end ) fx.end = -self._get().height();
                                },
                                done: function() {
                                    self._animating = false;
                                    self._setNewState( 'hide' );
                                    self.adjust();
                                }
                            });
                        } else {
                            header.css( css );
                            this._setNewState( 'hide' );
                        }
                    },
                    _show: function( animate ) {
                        var css = {
                            'margin-top': '0px'
                        };
                        var self = this;
                        var state = this._getState();
                        this._setNewState( state, true );
                        if( animate ) {
                            this._animating = true;
                            this._get().animate( css, {
                                duration: this._duration,
                                step: function( now, fx ) {
                                    var margin = -self._get().height();
                                    if( margin != fx.start ) fx.start = margin;
                                },
                                done: function() {
                                    self._animating = false;
                                    self._setNewState( state );
                                    self.adjust();
                                }
                            });
                        } else {
                            this._get().css( css );
                            this._setNewState( state );
                        }
                    },
                    toggle: function() {
                        switch( this._currentState )
                        {
                            case 'force':
                                this._forceToShow = false;
                                break;
                            case 'hide':
                                this._forceToShow = true;
                                break;
                            default:
                                break;
                        }
                        this.adjust();
                    },
                    adjust: function() {
                        if( this._animating ) {
                            return this;
                        }
                        if( this._firstRun ) {
                            switch( this._getState() ) {
                                case 'hide': this._hide(); break;
                                default: this._show();
                            }
                            this._firstRun = false;
                        } else {
                            var state = this._getState();
                            switch( state ) {
                                case 'hide':
                                    if( this._currentState == 'hide' ) this._hide();
                                    else this._hide( true );
                                    break;
                                default:
                                    if( this._currentState == 'hide' ) this._show( true );
                                    else if( this._currentState != state ) this._show();
                            }
                        }
                        return this;
                    },
                    getCurrentState: function() {
                        return this._currentState;
                    },
                    on: function( event, cb ) {
                        switch( event ) {
                            case 'statestart': this._eventCb.stateStart = cb; break;
                            case 'stateend': this._eventCb.stateEnd = cb; break;
                            default:
                                throw 'unknown event: '+event;
                        }
                        return this;
                    }
                };
            };
        };
        
        if( $('body').hasClass('resp') && $('body').hasClass('resp-top-bar') ) {
            $(document).ready( function() {
                $('.top-bar-arrow').css( 'display', 'none' );
                var header = hidingHeader( '#top-bar .container', ultra_resp_top_bar_params.collapse )
                    .on( 'stateend', function( state ) {
                        switch( state ) {
                            case 'force':
                                $('.top-bar-arrow').removeClass( 'show' ).addClass( 'close' );
                                break;
                            case 'hide':
                                $('.top-bar-arrow').removeClass( 'close' ).addClass( 'show' );
                                break;
                            default:
                                $('.top-bar-arrow').removeClass( 'show' ).removeClass( 'close' );
                                break;
                        }
                    })
                    .on( 'statestart', function( state ) {
                        switch( state ) {
                            case 'force':
                                $('.top-bar-arrow').css( 'display', '' );
                                break;
                            case 'hide':
                                $('.top-bar-arrow').css( 'display', '' );
                                break;
                            default:
                                $('.top-bar-arrow').css( 'display', 'none' );
                                break;
                        }
                    })
                    .adjust();
                window.onresize = function() { header.adjust() };
                $('.top-bar-arrow').on( 'click', function() { header.toggle(); } );
            });
        };
              
    // Main menu hover effects
    $('.site-header')
        .on('mouseenter', '.main-navigation ul li', function(){
            var $$ = $(this);
            var $ul = $$.find('> ul');
            $ul.css({
                'display' : 'block',
                'opacity' : 0
            }).clearQueue().animate({opacity: 1}, 250);
            $ul.data('final-opacity', 1);
        } )
        .on('mouseleave', '.main-navigation ul li', function(){
            var $$ = $(this);
            var $ul = $$.find('> ul');
            $ul.clearQueue().animate( {opacity: 0}, 250, function(){
                if($ul.data('final-opacity') == 0) {
                    $ul.css('display', 'none');
                }
            });
            $ul.data('final-opacity', 0);
        } );     

    // Menu search bar
    var isSearchHover = false;
    $(document).click(function(){
        if(!isSearchHover) $('.main-navigation .menu-search .search-form').fadeOut(250);
    });

    $(document)
        .on('click','.search-icon', function(){
            var $$ = $(this).parent();
            $$.find('form').fadeToggle(250);
            setTimeout(function(){
                $$.find('input[name=s]').focus();
            }, 300);
        } );

    $(document)
        .on('mouseenter', '.search-icon', function(){
            isSearchHover = true;
        } )
        .on('mouseleave', '.search-icon', function(){
            isSearchHover = false;
        } );                          

    // Sticky header
    $(window).scroll(function(){
        if ($(this).scrollTop() > 150) {
            $('.site-header-sentinel').addClass('fixed');
        } else {
            $('.site-header-sentinel').removeClass('fixed');
        }
    });

    // Initialize the Flex Slider
    $('.entry-content .flexslider:not(.metaslider .flexslider), #metaslider-demo.flexslider').flexslider( {
        namespace: "flex-ultra-",        
    } );

    // Stretch the main slider
    $('body.full #main-slider[data-stretch="true"]').each(function(){
        var $$ = $(this);
        $$.find('>div').css('max-width', '100%');
        $$.find('.slides li').each(function(){
            var $s = $(this);

            // Move the image into the background
            var $img = $s.find('img.ms-default-image').eq(0);
            if(!$img.length) {
                $img = $s.find('img').eq(0);
            }

            $s.css('background-image', 'url(' + $img.attr('src') + ')');
            $img.css('visibility', 'hidden');
            // Add a wrapper
            $s.wrapInner('<div class="container"></div>');
            // This is because IE doesn't detect links correctly when we stretch slider images.
            var link = $s.find('a');
            if(link.length) {
                $s.mouseover(function () {
                    $s.css('cursor', 'hand');
                });
                $s.mouseout(function () {
                    $s.css('cursor', 'pointer');
                });
                $s.click(function ( event ) {
                    event.preventDefault();
                    var clickTarget = $(event.target);
                    var navTarget = clickTarget.is('a') ? clickTarget : link;
                    window.open( navTarget.attr( 'href' ), navTarget.attr( 'target' ) );
                });
            }
        });
    });

    // Scroll to top
    $(window).scroll( function(){
        if($(window).scrollTop() > 150) {
            $('#scroll-to-top').addClass('displayed');
        }
        else {
            $('#scroll-to-top').removeClass('displayed');
        }
    } );

    $('#scroll-to-top').click( function(){
        $("html, body").animate( { scrollTop: "0px" } );
        return false;
    } );
    
});