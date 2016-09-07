import React from 'react';
import ReactDOM from 'react-dom';
import injectTapEventPlugin from 'react-tap-event-plugin';
import App from './App';
import './index.css';
import * as  firebase from 'firebase';

// Initialize Firebase
var config = {
  apiKey: "AIzaSyDkYdLo3EcIYrJ45UbL3FGMtZCXrpO5C64",
  authDomain: "ifb299-2b973.firebaseapp.com",
  databaseURL: "https://ifb299-2b973.firebaseio.com/",
  storageBucket: "ifb299-2b973.appspot.com",
};
firebase.initializeApp(config);

injectTapEventPlugin();

ReactDOM.render(
  <App />,
  document.getElementById('root')
);
