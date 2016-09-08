import React, { Component } from 'react';
import logo from './logo.svg';
import './App.css';
import * as firebase from 'firebase';

class App extends Component {

  constructor() {
    super();
    this.state = {
      //default for when loading data
      num1: 'EventWebsite',
      num2: 'loading'
    };
  }
  componentDidMount() {
    const rootRef = firebase.database().ref().child('globaldata');
    const num1Ref = rootRef.child('num1');
    const num2Ref = rootRef.child('num2');
    num1Ref.on('value', snap => {
      this.setState({
        num1: snap.val()
      });
    });
    num2Ref.on('value', snap => {
      this.setState({
        num2: snap.val()
      });
    });
  }

  render() {
    return (
      <div className="App">
        <div className="App-header">
          <img src={logo} className="App-logo" alt="logo" />
          <h2>{this.state.num1}</h2>
          <h2>{this.state.num2}</h2>
        </div>

        <p className="App-intro">
        </p>
      </div>
    );
  }
}

export default App;