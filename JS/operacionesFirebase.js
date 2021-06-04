 // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  var firebaseConfig = {
    apiKey: "AIzaSyDtLGwp-XZB8jALcTCu3tWfFrmbZ2AlThw",
    authDomain: "notificacionestianguiztli.firebaseapp.com",
    databaseURL: "https://notificacionestianguiztli-default-rtdb.firebaseio.com",
    projectId: "notificacionestianguiztli",
    storageBucket: "notificacionestianguiztli.appspot.com",
    messagingSenderId: "329055257525",
    appId: "1:329055257525:web:3409afe599ffeb1e570ffc",
    measurementId: "G-DKM3R4WV6E"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();
  

  var referencia = new firebase('https://notificacionestianguiztli-default-rtdb.firebaseio.com/');
 var obj = {
     "Texto":"Hola mundo"
 }
 referencia.set(obj);