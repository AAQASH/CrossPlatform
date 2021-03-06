/*
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership.  The ASF licenses this file
 * to you under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License.  You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing,
 * software distributed under the License is distributed on an
 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied.  See the License for the
 * specific language governing permissions and limitations
 * under the License.
 */
var app = {
    // Application Constructor
    initialize: function() {
        this.bindEvents();
    },
    // Bind Event Listeners
    //
    // Bind any events that are required on startup. Common events are:
    // 'load', 'deviceready', 'offline', and 'online'.
    bindEvents: function() {
        document.addEventListener('deviceready', this.onDeviceReady, false);
    },
    // deviceready Event Handler
    //
	
	onResume: function() {
        app.myLog.value="";
        // Clear the badge number - if a new notification is received it will have a number set on it for the badge
        app.setBadge(0);
        app.getPending(); // Get pending since we were reopened and may have been launched from a push notification
    },
	
	setBadge: function(num) {
        var pushNotification = window.plugins.pushNotification;
        app.myLog.value+="Clear badge... \n";
        pushNotification.setApplicationIconBadgeNumber(num);
    },
    // The scope of 'this' is the event. In order to call the 'receivedEvent'
    // function, we must explicitly call 'app.receivedEvent(...);'
    onDeviceReady: function() {
        app.receivedEvent('deviceready');
    },
    // Update DOM on a Received Event
		
    receivedEvent: function(id) {
        var parentElement = document.getElementById(id);
        var listeningElement = parentElement.querySelector('.listening');
        var receivedElement = parentElement.querySelector('.received');
		
		var pushNotification = window.plugins.pushNotification;
		if ( device.platform == 'android' || device.platform == 'Android' || device.platform == "amazon-fireos" )
		{
		   pushNotification.register(app.successHandler, app.errorHandler,{"senderID":"38991355875","ecb":"app.onNotificationGCM"});
		}
		else
		{
			pushNotification.register(app.tokenHandler, app.errorHandler,{"badge":"true","sound":"true","alert":"true","ecb":"onNotificationAPN"});
			//pushNotification.setApplicationIconBadgeNumber(successCallback, errorCallback, 0);
		}
		
		
				
        //listeningElement.setAttribute('style', 'display:none;');
        //receivedElement.setAttribute('style', 'display:block;');
		
        console.log('Received Event: ' + id);				
    },
	
	// result contains any message sent from the plugin call
	successHandler: function(result) {
		console.log("Callback Success! Result = "+result);
		//alert("Callback Success! Result = "+result);
	},
	
	errorHandler:function(error) {
    	alert(error);
	},
	
	tokenHandler:function(result) {
    // Your iOS push server needs to know the token before it can push to this device
    // here is where you might want to send it the token for later use.
     //alert('device token = ' + result);
	 var deviceType = 'ios';
	 setDeviceId(result,deviceType);
    },
	
	onNotificationGCM: function(e) {
        switch( e.event )
        {
            case 'registered':
                if ( e.regid.length > 0 )
                {
                    console.log("Regid " + e.regid);
					var deviceType = 'android';
					setDeviceId(e.regid,deviceType);
					
                }
            break;
 
            case 'message':
              // this is the actual push notification. its format depends on the data model from the push server
              alert('message = '+e.message+' msgcnt = '+e.msgcnt);
            break;
 
            case 'error':
              alert('GCM error = '+e.msg);
            break;
 
            default:
              alert('An unknown GCM event has occurred');
              break;
        }
    },
	
	// iOS
	onNotificationAPN: function(event) {
		if ( event.alert )
		{
			navigator.notification.alert(event.alert);			
		}
	
		if ( event.sound )
		{
			var snd = new Media(event.sound);
			snd.play();
		}
	
		if ( event.badge )
		{
			pushNotification.setApplicationIconBadgeNumber(successHandler, errorHandler, event.badge);
		}
	}
		  					
};
