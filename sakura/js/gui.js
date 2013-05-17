
$(document).ready(function(){

      // deplier les metas extra
      $("#metaall").click(function () {
            if ($(".meta_extra").css("display")=="block")
                              $(".meta_extra").slideUp(); 
                          else 
                              $(".meta_extra").slideDown();     

      });
      
      
      // page mediarama: effet papillon
     if ($(".mediarama").length==1) {
              function showMedia() {                 
                $(".item_media .wrapper").eq(media_current).fadeIn('fast');  
                if  (media_current++ < nb_media)
                          var t = setTimeout(showMedia,200);                             
              }
             
              $(".item_media .wrapper").show().hide(); 
              var nb_media  = $(".item_media .wrapper").length;
              var media_current = 0;  
              
              if  (nb_media>0)
                   var t = setTimeout(showMedia,200);
              
                             
     
     }
     
});      
      