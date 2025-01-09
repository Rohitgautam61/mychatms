//SETTING UP OUR POPUP
//0 means disabled; 1 means enabled;
var popupStatus = 0;

//loading popup with jQuery magic!
function loadPopup(obj){
	//loads popup only if it is disabled
	if(popupStatus==0){
		obj.find(".backgroundPopup").css({
			"opacity": "0.7"
		});
		obj.find(".backgroundPopup").fadeIn("slow");
		obj.find(".popupContact").fadeIn("slow");
		popupStatus = 1;
	}
}

//disabling popup with jQuery magic!
function disablePopup(){
	//disables popup only if it is enabled
	if(popupStatus==1){
		$(".backgroundPopup").fadeOut("slow");
		$(".popupContact").fadeOut("slow");
		popupStatus = 0;
	}
}

//centering popup
function centerPopup(obj){
	//request data for centering
	var windowWidth = document.documentElement.clientWidth;
	var windowHeight = document.documentElement.clientHeight;
	var popupHeight = obj.find(".popupContact").height();
	var popupWidth = obj.find(".popupContact").width();
	//centering
	obj.find(".popupContact").css({
		"position": "absolute",
		"top": windowHeight/2-popupHeight/2,
		"left": windowWidth/2-popupWidth/2
	});
	//only need force for IE6
	
	obj.find(".backgroundPopup").css({
		"height": windowHeight
	});
	
}

$(document).ready(function(){
						   
	$(".dataTableRow").each(function(){
		$(this).find(".button").click(function(){
			$obj = $(this).parent().parent();
			centerPopup($obj);
			loadPopup($obj);
		});
		
		$(this).find("#popupContactClose").click(function(){
			disablePopup();
		});
		
		$(this).find(".backgroundPopup").click(function(){
			disablePopup();
		});
		
		//Press Escape event!
		$(document).keypress(function(e){
			if(e.keyCode==27 && popupStatus==1){
				disablePopup();
			}
		});
	});
});