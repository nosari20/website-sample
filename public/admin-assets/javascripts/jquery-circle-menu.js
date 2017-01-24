(function($) {

    $.circleMenu = function(el,options) {
        var plugin = this;
        var $el = $(el);
        var $toggle, $links;
        var open = false, nbLinks, multip = 1, dir;
        
        plugin.options = $.extend({
            direction : 'up', // up down right left
            position:{
              x: 'right',
              y: 'bottom'
            }
        }, options);
      
        plugin.init = function(){
          switch(plugin.options.position.x) {
              case 'right':
                  $el.css('right','15px');
                  break;
              case 'left':
                  $el.css('left','15px');
                  break;
              default:
                  $el.css('right','15px');          
          }
          switch(plugin.options.position.y) {
              case 'top':
                  $el.css('top','15px');
                  break;
              case 'bottom':
                  $el.css('bottom','15px');
                  break;
              default:
                  $el.css('bottom','15px');          
          }
          plugin.createToggle();
          plugin.createLink();
          plugin.initEvents();
        }
        plugin.createToggle = function(){
          //create button
          $toggle = $(document.createElement('button'));
          $toggle.addClass('circle-menu-toggle');
          
          //create icon
          $icon = $(document.createElement('i'));
          $icon.addClass('material-icons');
          $icon.text('add');
          $icon.prop( "aria-hidden", true );
          
          $toggle.append($icon);
          $el.append($toggle);
        }
        plugin.createLink = function(){
          $links = $el.find('li');
          nbLink = $links.length;
          switch(plugin.options.direction) {
              case 'up':
                  dir = 'Y';
                  multip = -1;
                  break;
              case 'down':
                  dir = 'Y';
                  multip = 1;
                  break;
              case 'right':
                  dir = 'X';
                  multip = 1;
                  break;
              case 'left':
                  dir = 'X';
                  multip = -1;
                  break;
              default:
                  dir = 'Y';
                  multip = -1;
          }
          plugin.close();
        }
        plugin.initEvents = function(){
          $toggle.click(function(){
            plugin.handleClick(plugin, $el);
          });
        }
        plugin.handleClick = function(plugin, $el){
          open = !open;
          if(open){
            plugin.open();
          }else{
            plugin.close();
          }
        }
        plugin.open = function(){
           $links.each(function(index){
              plugin.css($(this),'transition-delay',((nbLink-index)*0.1)+'s');
              plugin.css($(this),'transform','translate'+dir+'('+(multip*(index+1)*($(this).height()+10))+'px) scale(1)');
            });
        }
        plugin.close = function(){
             $links.each(function(index){
              plugin.css($(this),'transition-delay',((index+1)*0.1)+'s');
              plugin.css($(this),'transform','translate'+dir+'(0px) scale(0)');
            });

        }
        plugin.css = function($el,prop,value){
          $el.css(prop,value);
          $el.css('-webkit-'+prop,value);
          $el.css('-ms-'+prop,value);
          $el.css('-moz-'+prop,value);
          $el.css('-o-'+prop,value);
        }
        
        

       
        plugin.init();
    }
    
    
    $.fn.circleMenu = function(options) {
        return this.each(function() {    
            if ($(this).attr('upgraded') == undefined) {              
                var plugin = new $.circleMenu(this, options);
                $(this).attr('upgraded', 'true');
            }
        });

    }

}(jQuery));