$(document).ready(function(){
    $("#tab-list a").click(function(){
		$("#tab-list a").each(function(){
	        $(this).parent('li').removeClass('active');
	    });
        $(this).tab('show');
    });
});
