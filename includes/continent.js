//Made by Joni

function getLeague(strURL)
{
     var xmlhttp=getAjaxObject();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            /* BOC: 
             * PURPOSE: Changes place of setting the response from div of id league_category_div to select id league_category.
             * DESCRIPTION: 
             * 1- We saved and edit any team form and populate the league value on the selection of continent, the form requet does not have league values.
             * 2- Becuase it was populated by the ajax response, so not able to get the option value in the request params.
             * BY PULKIT DHAKA
             * DATE: 28-FEBRUARY-2022
             * PM ID: #127705
             */
             document.getElementById("league_category").innerHTML=xmlhttp.responseText;
            /* EOC: 
             * PURPOSE: Changes place of setting the response from div of id league_category_div to select id league_category.
             * BY PULKIT DHAKA
             * PM ID: #127705
             */
        }
    }

    xmlhttp.open("GET", strURL, true); //open url using get method
    xmlhttp.send(null);
}
function getLeague1(strURL)
{
    var xmlhttp=getAjaxObject();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("league_category").innerHTML=xmlhttp.responseText;
            document.getElementById("team").innerHTML='<option value="0">--Select Team--</option>';
        }
    }

    xmlhttp.open("GET", strURL, true); //open url using get method
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
function getNational(strURL){
    var xmlhttp=getAjaxObject();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("nationalteam").innerHTML=xmlhttp.responseText;
        }
    }

    xmlhttp.open("GET", strURL, true); //open url using get method
    xmlhttp.send(null);
}
function getTeam(strURL)
{
    var xmlhttp=getAjaxObject();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("team").innerHTML=xmlhttp.responseText;
        }
    }

    xmlhttp.open("GET", strURL, true); //open url using get method
    xmlhttp.send(null);
}

function checkvalue(){

    if(document.continent_league.continent.value=='0'){
        document.getElementById('errors').style.display="block";
        document.getElementById('errors').innerHTML="Please select Continent!!!";
        return false;
    }
    if(document.continent_league.category.value==''){
        document.getElementById('errors').style.display="block";
        document.getElementById('errors').innerHTML="Please Enter League!!!";
        return false;
    }
    return true;
}

function checkcontinent(){
    if(document.continent_league.continent.value==''){
        document.getElementById('errors').style.display="block";
        document.getElementById('errors').innerHTML="Please Enter Continent!!!";
        return false;
    }
    return true;
}
function checkclub(){
    if(document.continent_league.continent.value=='0'){
        document.getElementById('errors').style.display="block";
        document.getElementById('errors').innerHTML="Please select Continent!!!";
        return false;
    }
    if(document.continent_league.league_category.value=='0'){
        document.getElementById('errors').style.display="block";
        document.getElementById('errors').innerHTML="Please Select League!!!";
        return false;
    }

    if(document.continent_league.team_name.value==''){
        document.getElementById('errors').style.display="block";
        document.getElementById('errors').innerHTML="Please Enter Team!!!";
        return false;
    }
    return true;
}

function clubshow(id){
     if(id==0){
       document.getElementById('icontinent').style.display='none';
       document.getElementById('iteam').style.display='none';
       document.getElementById('continent_div').style.display='block';
       document.getElementById('league_div').style.display='block';
       document.getElementById('team_div').style.display='block';
       document.getElementById('errors_div').innerHTML="";
    }
    else{
       document.getElementById('icontinent').style.display='block';
       document.getElementById('iteam').style.display='block';
       document.getElementById('continent_div').style.display='none';
       document.getElementById('league_div').style.display='none';
       document.getElementById('team_div').style.display='none';
       document.getElementById('errors_div').innerHTML="";
      
    }
    return true;
}
function checkEmptyField(){
      if(document.getElementById('team_type_0').checked==true){
         if(document.getElementById('continent').value!='0'){
           if(document.getElementById('league_category').value=='0'){
               document.getElementById('errors_div').style.display='block';
               document.getElementById('errors_div').innerHTML="Please Select League!!!";
               return false;
           }
          }
       }

      else{
           if(document.getElementById('nationalcontinent').value!='0'){
              if(document.getElementById('nationalteam').value=='0'){
                document.getElementById('errors_div').style.display='block';
               document.getElementById('errors_div').innerHTML="Please Select Team!!!";
               return false;
           }
        }
      }
    
       return true;
}