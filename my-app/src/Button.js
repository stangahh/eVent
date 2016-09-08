import React from 'react';
import FlatButton from 'material-ui/FlatButton';
import './App.css';

const FlatButtonExampleSimple = () => (
  <div>
    <FlatButton label="Search Events" primary={true} />
    <FlatButton label="Terms and Conditions" secondary={true} />
  </div>
);

export default FlatButtonExampleSimple;