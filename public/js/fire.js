import firebase from "firebase";
import "firebase/firestore";

var config = {
  apiKey: "",
  authDomain: "lafinca-2370d.firebaseapp.com",
  databaseURL: "https://lafinca-2370d-default-rtdb.firebaseio.com/",
  projectId: "lafinca-2370d-default-rtdb",
  storageBucket: "your_project.appspot.com",
  messagingSenderId: "your_message_sending_id",
};

var fire = firebase.initializeApp(config);
export default fire;