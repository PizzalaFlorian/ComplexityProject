$( document ).ready(function() {

	var isShow = false;

    $("#Properties").hide();

    $("#showDet").click(function(){
    	if(isShow){
    		isShow = false;
    		$("#Properties").hide();
    	}
    	else{
    		$("#Properties").show();
    		isShow = false;
    	}
    });
});