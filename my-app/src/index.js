import React from 'react';
import ReactDOM from 'react-dom';
import './index.css';
import * as  firebase from 'firebase';
import injectTapEventPlugin from 'react-tap-event-plugin';
import MuiThemeProvider from 'material-ui/styles/MuiThemeProvider';
import getMuiTheme from 'material-ui/styles/getMuiTheme';

import darkBaseTheme from 'material-ui/styles/baseThemes/darkBaseTheme';
import AppBarExampleIcon from './AppBarExampleIcon';

injectTapEventPlugin();
//Initialize Firebase
var config = {
  apiKey: "AIzaSyDkYdLo3EcIYrJ45UbL3FGMtZCXrpO5C64",
  authDomain: "ifb299-2b973.firebaseapp.com",
  databaseURL: "https://ifb299-2b973.firebaseio.com/",
  storageBucket: "ifb299-2b973.appspot.com",
};
firebase.initializeApp(config);

const App = () => (
  <MuiThemeProvider muiTheme={getMuiTheme(darkBaseTheme)}>
    <AppBarExampleIcon />
  </MuiThemeProvider>
);

ReactDOM.render(
  <App />,
  document.getElementById('root')
);
