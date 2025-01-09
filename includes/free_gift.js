	
		function getProducts(category)
		 {
			var xmlhttp=getAjaxObject();
			xmlhttp.onreadystatechange=function()
			{
				$("#dialog").css('display','block');
			    $("#dialog").html('<div id="waiting"><img src="images/loading.gif"></div>');
				$("#dialog").css('width','100%');
				$("#waiting").center();
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					document.getElementById("product_area").innerHTML = xmlhttp.responseText;
					$("#dialog").css('width','0%');
					$("#waiting").css('display','none');
					$("#dialog").css('display','none');
				}
			}
		
			xmlhttp.open("GET", 'ajax_category_product.php?category='+category, true); //open url using get method
			xmlhttp.send(null);
		 }

         function getoffer(val,flag)
		 {
			 
			var xmlhttp=getAjaxObject();
			xmlhttp.onreadystatechange=function()
			{
				$("#dialog").css('display','block');
			    $("#dialog").html('<div id="waiting"><img src="images/loading.gif"></div>');
				$("#dialog").css('width','100%');
				$("#waiting").center();
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
				    document.getElementById("offer").innerHTML = xmlhttp.responseText;
					$(".cal").each(function() {
						$(this).datepicker();
						var queryDate =  $(this).val();
						if($(this).val()!='0000-00-00'){
						dateParts = queryDate.match(/(\d+)/g);
						realDate = new Date(dateParts[0], dateParts[1] - 1, dateParts[2]);
						$(this).datepicker("setDate", realDate); 
						}
						$(this).datepicker("option", "dateFormat","yy-mm-dd" );
					});
					$('select').css('width','200px');
					$("#dialog").css('width','0%');
					$("#waiting").css('display','none');
					$("#dialog").css('display','none');
				}
			}
		  
		    if(flag==false)
			 xmlhttp.open("GET", 'ajax_category_offer.php?category='+val,true); //open url using get method
			else
			 xmlhttp.open("GET", 'ajax_category_offer.php?product='+val,true); //open url using get method
			 
			xmlhttp.send(null);
		 }
		 
		function getAjaxObject(){
			 var xmlhttp;
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
			 return   xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
			  return  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
		}
			
		 
		 function validate(){
		   var free_offer=document.getElementById('free_gift_cat').value;
		   if(free_offer=='0'|| free_offer==''){
				  alert("Please select offer!!!");
				  return false;
		   }
		   var count=0;
		   var ob = document.getElementById('categories_cat');
		   for (var i = 0; i < ob.options.length; i++){
			    if (ob.options[ i ].selected){
					 if(ob.options[ i ].value!=''){
						 count++;
					}
				}
		   }
		   if(count==0){
		  	  alert("Please select category!!!");
			  return false;
		   }
		   
		   if(document.getElementById('minordercat').value==''){
			  alert("Please enter the minorder price to get free gift!!!");
			  return false;
		   }
		   return confirm('Are you sure to apply offer on category basis?');
		 }
		 
		 function validate_site(){
		   var free_offer=document.getElementById('free_gift_site').value;
		   if(free_offer=='0'|| free_offer==''){
				  alert("Please select offer!!!");
				  return false;
		   }
		  
		    if(document.getElementById('minordersite').value==''){
			  alert("Please enter the minorder price to get free gift!!!");
			  return false;
		   }
		    return confirm('Are you sure to apply offer on site basis?');
		 }
		 
		  function validate_new(flag){
		  
		   if(flag==1){
			  var products = document.getElementById('product');
			  var checked = false;
			  for(var i =0; i < products.length;i++){
				  if(products[i].selected){
					checked = true;  
				  }
			  }
			  if(!checked){
				  alert("Please select product!!!");
			      return false;
			  }
			   /*if(document.getElementById('product:selected').length =='0'){
			     alert("Please select product!!!");
			      return false;
		        }*/
		   }
		   var free_offer=document.getElementById('free_gift_prod').value;
		   
		   if(free_offer=='0'|| free_offer==''){
				  alert("Please select offer!!!");
				  return false;
		   }
		   
		   if(flag==0){
		   if(document.getElementById('categories_prod').selectedIndex=='0'){
			  alert("Please select category!!!");
			  return false;
		   }
		   }
		   
		   if(document.getElementById('prodgroup').value==''){
			  alert("Please enter product group!!!");
			  return false;
		   }
		   
		    if(document.getElementById('minorderprod').value==''){
			  alert("Please enter the minorder price to get free gift!!!");
			  return false;
		   }
		   
		    return confirm('Are you sure to apply offer on products basis?');
		  
		 }
		 
		 
		jQuery.fn.center = function () {
		   this.css("position","fixed");
		   this.css("top", ( $(window).height() - this.height() ) / 2 + "px");
		   this.css("left", ( $(window).width() - this.width() ) / 2 + "px");
		   return this;
		}
			
	
function sitewisepromotion(type) {
		var dialogOpts = {
		title: "Site Wide Promotion",
		modal: true,
		autoOpen: true,
		height: 300,
		width: 450,
		buttons: {"Update":function(){
			          if(confirm('Are you sure to update site wide promotion?')){
			       	   $('#action').val('update_site_promotion_offer');
					   $('#update_site_offer').submit();
					  }
				 },"Cancel": function() { $(this).dialog("close"); } } ,
		open: function() {
			//display correct dialog content
			$("#promotion").html('<div id="waititngD"><img src="images/loading.gif"></div>');
			$("#promotion").load("ajax_category_offer.php?type="+type, function() {
				$("#waititngD").css('display','none');
			}
		 );
		}
	};
	$("#promotion").dialog(dialogOpts);    //end dialog

}		