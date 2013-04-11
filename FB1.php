<!DOCTYPE html>
<html
xmlns="http://www.w3.org/1999/xhtml"
xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<title>Example Of Login_Logout_access_token Using Javascript Graph API
</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script src="http://connect.facebook.net/en_US/all.js"></script>
</head>
<body>

<div id="fb-root"></div>
<script>
var APP_ID="520851241293871";
var secrtid="0a18d5898c3294e994bbf0817fefc0a4";

window.fbAsyncInit = initFacebook;
function initFacebook()
{
    FB.init
    ({
        appId:APP_ID,
        status:true,//check login status
        cookie:true,//enable cookies to allow the server to access the session
        xfbml :true //parse XFBML
    });
    
    FB.getLoginStatus(onFacebookLoginStatus);
    
};
(function() 
{
    var e = document.createElement('script');
    e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
    e.async = true;
    document.getElementById('fb-root').appendChild(e);
}());

function facebookLogout()//登出的動作
{
    FB.logout();
    var loginButtonDiv=document.getElementById("fb-login-button-div");
    loginButtonDiv.style.display="block";
    var logoutButtonDiv=document.getElementById("fb-logout-button-div");
    logoutButtonDiv.style.display="none"; 
}
function facebookLogin()//登入的動作
{
//其中的scope後面接的是權限，可以用","接很多的權限
    var loginUrl="http://www.facebook.com/dialog/oauth/?"+
                 "scope=publish_stream,user_photo_video_tags,read_stream,user_events,user_birthday,offline_access,email,read_friendlists,user_likes,create_event&"+
                 "client_id="+APP_ID+"&"+
                 "redirect_uri="+document.location.href+"&"+
                 "response_type=token";
    window.location=loginUrl;
}

var accessToken;

function onFacebookLoginStatus(response)
{
    if (response.status=="connected" && response.authResponse)//如果有登入
    {
        var loginButtonDiv=document.getElementById("fb-login-button-div");
        loginButtonDiv.style.display="none";
        var logoutButtonDiv=document.getElementById("fb-logout-button-div");
        logoutButtonDiv.style.display="block";
        
       
        
			FB.api('/me', function(response) 
			{
				$('#fb-login-button-div').append(response.name+'已經登入');
				alert("name=" + response.name + " id=" + response.id);
			});
			
			
			
			/*
		var accessToken =   FB.getAuthResponse()['accessToken'];
    var name = "My Event";
    var startTime = "03/20/2013 12:00 PM";
    var endTime = "03/21/2013 06:00 PM";
    var location = "Argentina";
    var description = "description";

    var eventData = {
        "access_token": accessToken,
        "start_time" : startTime,
        "end_time":endTime,
        "location" : location,
        "name" : name,
        "description":description,
        "privacy":"OPEN"
    };
    FB.api("/me/events",'post',eventData,function(response2){
        
		if(response.id){
                alert("We have successfully created a Facebook event with ID: "+response.id);
            }
		else
            {
				alert("error:"+response.error);
			}
		
    });
	
	*/
	
	accessToken = FB.getAccessToken();
	//FB.setAccessToken(accessToken);
	
	
	//accessToken =   FB.getAuthResponse()['accessToken'];
	var event = {  
	"access_token": accessToken,
    name: 'Name of your event', 
    description: 'Description of your event',
    location: 'Location of event',
    start_time: '2013-03-12T09:45:00+0000', // Example Start Date
    privacy_type:'OPEN' // Example End Date
};

FB.api('/me/events', 'post', event, function (result) {
   if(result.id){
                alert("We have successfully created a Facebook event with ID: "+response.id);
            }
		else
            {
				alert("error:"+result.error);
			}
});

    
        
    }
    else
    {
        var loginButtonDiv=document.getElementById("fb-login-button-div");//如果沒登入
        loginButtonDiv.style.display="block"; 
        
    }
}

function createEvent(name, startTime, endTime, location, description) {
    var eventData = {
        "access_token": accessToken,
        "start_time" : startTime,
        "end_time":endTime,
        "location" : location,
        "name" : name,
        "description":description,
        "privacy":"OPEN"
    }
    FB.api("/me/events",'post',eventData,function(response){
        if(response.id){
            alert("We have successfully created a Facebook event with ID: "+response.id);
        }
    })
}

function createMyEvent(){
    var name = "My Amazing Event";
    var startTime = "3/29/2013 12:00 AM";
    var endTime = "3/29/2013 06:00 PM";
    var location = "Dhaka";
    var description = "It will be freaking awesome";
    createEvent(name, startTime,endTime, location, description);
}



</script>



<!--- <div id="fb-login-button-div" style="display:none;"> --->
<div id="fb-login-button-div" >
Please login to enjoy all the features of this application:
<input id="loginButton" onclick="javascript:facebookLogin();" type="button" value="Login To Facebook" >
</div>

<div id="fb-logout-button-div" style="display: none;">
<input id="logoutButton" onclick="javascript:facebookLogout();" type="button" value="Logout From Facebook" >
</div>

</html>
