jQuery( document ).ready(function() {
    jQuery("#archive").prepend("<option value='' selected='selected' disabled>Filter By</option>");


    var pathname = window.location.pathname; 
    var pageSlug = pathname.split('/').pop();

    if('news' == pageSlug){

        var category    = jQuery('#category').find(":selected").attr('data-termid');
        var archiveyear = jQuery('#archive').find(":selected").text();
        var searchtext  = jQuery('#searchtext').val();
        var pageno      = jQuery('#pageno').val();

        get_news(category, archiveyear, searchtext, pageno);
    }


    jQuery('.getnews').change(function(){
        jQuery('#pageno').val(1);
        var category    = jQuery('#category').find(":selected").attr('data-termid');
        var archiveyear = jQuery('#archive').find(":selected").text();
        var searchtext  = jQuery('#searchtext').val();
        var pageno      = jQuery('#pageno').val();

        get_news(category, archiveyear, searchtext, pageno);
    });

    jQuery(document).keydown(function(e) { 
        if (e.keyCode == 13) {
        jQuery('#pageno').val(1);
        var category    = jQuery('#category').find(":selected").attr('data-termid');
        var archiveyear = jQuery('#archive').find(":selected").text();
        var searchtext  = jQuery('#searchtext').val();
        var pageno      = jQuery('#pageno').val();

        get_news(category, archiveyear, searchtext, pageno); 
        }
    });

    jQuery('#loadmore').click(function(e) { 
        var category    = jQuery('#category').find(":selected").attr('data-termid');
        var archiveyear = jQuery('#archive').find(":selected").text();
        var searchtext  = jQuery('#searchtext').val();
        var pageno      = jQuery('#pageno').val();

        get_news(category, archiveyear, searchtext, pageno); 
    });

    jQuery('#clearall').click(function(e) { 
        jQuery('select').prop('selectedIndex', 0);
        jQuery('#searchtext').val('');
        jQuery('#pageno').val('1');

        var category    = jQuery('#category').find(":selected").attr('data-termid');
        var archiveyear = jQuery('#archive').find(":selected").text();
        var searchtext  = jQuery('#searchtext').val();
        var pageno      = jQuery('#pageno').val();

        get_news(category, archiveyear, searchtext, pageno);
    });


    function get_news($category, $archiveyear, $searchtext, $pageno){

        var category    = jQuery('#category').find(":selected").attr('data-termid');
        var archiveyear = jQuery('#archive').find(":selected").text();
        var searchtext  = jQuery('#searchtext').val();
        var pageno      = jQuery('#pageno').val();



        let
        data = {
                  action         : 'get_news',
                  category       : category,
                  archiveyear    : archiveyear,
                  searchtext     : searchtext,
                  pageno         : pageno        
               }

               jQuery.ajax({
                  url    : solarips.ajaxurl,
                  type   : 'POST',
                  data   : data,      
                  beforeSend: function() {
                            
                  },         
                  success: function(response) {

                    var result = JSON.parse( response  );

                    if(pageno > 1){
                        jQuery('.getnewsfeeds').append( decodeURIComponent(escape(window.atob(result.posts) )));
                    }else{
                        jQuery('.getnewsfeeds').empty().html( decodeURIComponent(escape(window.atob(result.posts) )));
                    }

                    jQuery('#pageno').val( parseInt(jQuery('#pageno').val()) +1 );

                    var count = jQuery('.getnewsfeeds a').length;

                    console.log('Total Record:'+result.total);
                    console.log('Visible Record:'+count);

                    if(count == result.total){
                        jQuery('#loadmore').show();
                        jQuery('#loadmore').text('No More Posts');
                        jQuery('#loadmore').css({'pointer-events':'none'});
                    
                    }else if(result.total == null){
                        jQuery('#loadmore').hide();
                    }else{
                        jQuery('#loadmore').show();
                        jQuery('#loadmore').text('Load More');
                        jQuery('#loadmore').css({'pointer-events':'all'});
                    }


                  }
              });

    }
});