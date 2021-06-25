import firebase from "firebase";
import "firebase/firestore";

var config = {
  apiKey: "AAAAqziVZt4:APA91bEEi9k3D5ZiQ8ZiftqEjtsYIem9M0z3y6ax2OZ3-GnlpTMAqjbV08feseGSU93_b6UA07opnD66WDcd_n2DRJ5jXNtSa_vFeMJviUv-vG6YmhwV5YZfGcHSOlB9JRBghcUHMPd1",
  authDomain: "lafinca-2370d.firebaseapp.com",
  databaseURL: "https://lafinca-2370d-default-rtdb.firebaseio.com/",
  projectId: "lafinca-2370d-default-rtdb",
  storageBucket: "your_project.appspot.com",
  messagingSenderId: "",
};

var fire = firebase.initializeApp(config);
export default fire;