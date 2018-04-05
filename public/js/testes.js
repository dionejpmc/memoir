
<script type="text/javascript">
$( ".target")
    .mouseover(function(event) {
        var self    = $(this),
            eq  = self.index(),
            nome   = self.text();
        var eq_val ='';
        event.preventDefault();
        eq_val = eq;
        var alias = $(".a-href:eq("+eq_val+")").attr("href");
        window.setTimeout(function(){
            if (!$(".msg-popup:eq("+eq_val+")").length) {
                $(".target:eq("+eq_val+")")
                    .append("<div class='msg-popup popup btn btn-primary'"  
                             +"style='width:600px; height:150px; position:fixed; margin-left: 18%;margin-top: -50px; z-index: 2000; opacity:0.9;'>" 
                             +"<div class='arrow bottom right'>"
                             +"</div>"
                             +"<form action='' method='post' accept-charset='utf-8' enctype='multipart/form-data'> <div class='form-group popup'><label>Enviar Mensagem</label>"
                             +"<textarea name='"+alias+"' class='form-control box-msg-ta' style='z-index: 1002; width:570px; height:50px; color:black;'></textarea></div>"
                             +"<button type='subimit' class='form-control btn btn-success btn-x'> Enviar</button>"
                             +"</form>"
                             +"</div>");
                $(".box-msg-ta").val('');
                return ;
            }else{
                    if ($(".msg-popup:eq("+eq_val+")").is(':active') || $(".target:eq("+eq_val+")").is(':hover') || $(".msg-popup:eq("+eq_val+")").is(':hover')) {
                          $(".msg-popup").fadeOut( "slow");
                          $(".msg-popup:eq("+eq_val+")").fadeIn();
                          return; 
                    }else{
                       $(".msg-popup").fadeOut( "slow");
                       return;
                    }
            }
        },2000);
    });
</script>