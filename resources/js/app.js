import './bootstrap';
import './toggleMenu';
import '../sass/app.scss';

$(document).ready(function(){
    $('#search').on('keyup',function(){
        var query= $(this).val(); 
        $.ajax({
            url:"search",
            type:"GET",
            data:{'search':query},
            success:function(data){ 
                $('#search_list').html(data);
            }
        });
         //end of ajax call
    });
});