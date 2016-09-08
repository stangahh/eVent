import React from 'react';
import ReactDOM from 'react-dom';
import './index.css';
import * as  firebase from 'firebase';
import App from './App';
import injectTapEventPlugin from 'react-tap-event-plugin';
import MuiThemeProvider from 'material-ui/styles/MuiThemeProvider';
import getMuiTheme from 'material-ui/styles/getMuiTheme';
import darkBaseTheme from 'material-ui/styles/baseThemes/darkBaseTheme';
import Main from './Main';
import CardThing from './Card';

injectTapEventPlugin();
//Initialize Firebase
var config = {
  apiKey: "AIzaSyDkYdLo3EcIYrJ45UbL3FGMtZCXrpO5C64",
  authDomain: "ifb299-2b973.firebaseapp.com",
  databaseURL: "https://ifb299-2b973.firebaseio.com/",
  storageBucket: "ifb299-2b973.appspot.com",
};
firebase.initializeApp(config);

const Site = () => (
  <MuiThemeProvider muiTheme={getMuiTheme(darkBaseTheme)}>
    <Main />
  </MuiThemeProvider>
);

const Site2 = () => (
  <MuiThemeProvider muiTheme={getMuiTheme(darkBaseTheme)}>
    <CardThing />
  </MuiThemeProvider>

);

ReactDOM.render(
  <div>
    <Site />
  <App />
  <Site2 />
  </div>,
  document.getElementById('root')
);
