// Scripts for firebase and firebase messaging
importScripts('https://www.gstatic.com/firebasejs/8.2.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.2.0/firebase-messaging.js');

// Initialize the Firebase app in the service worker by passing the generated config
var firebaseConfig = {
  apiKey: "AIzaSyC8rjnMBJ3d4N5fBG0Ito6ddoMuGx6JEN0",
  authDomain: "skbf-dfes.firebaseapp.com",
  projectId: "skbf-dfes",
  storageBucket: "skbf-dfes.appspot.com",
  messagingSenderId: "239319013166",
  appId: "1:239319013166:web:c6e80ba2367d659ab58cbf",
  measurementId: "G-896CT4BQPE"
};

firebase.initializeApp(firebaseConfig);

// Retrieve firebase messaging
const messaging = firebase.messaging();

messaging.onBackgroundMessage(function(payload) {
  console.log('Received background message ', payload);

  const notificationTitle = payload.notification.title;
  const notificationOptions = {
    body: payload.notification.body,
  };

  self.registration.showNotification(notificationTitle,
    notificationOptions);
});