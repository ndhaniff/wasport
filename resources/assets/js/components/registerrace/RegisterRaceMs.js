import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { Avatar, Tabs } from 'antd';
import RegisterRaceModal from './RegisterRaceModalMs';
import axios from 'axios';
import CountUp from 'react-countup';

class RegisterRaceMs extends Component{

  constructor(){
    super();
    this.state = {
    }
  }

  render(){
    return(
      <div>
        <RegisterRaceModal/>
      </div>
    )
  }

}

export default RegisterRaceMs

if(document.getElementById('register-race-ms')){
    ReactDOM.render(<RegisterRaceMs />, document.getElementById('register-race-ms'))
}
