import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { Avatar, Tabs } from 'antd';
import RegisterRaceModal from './RegisterRaceModalMs';
import axios from 'axios';
import CountUp from 'react-countup';

class RegisterRaceMobileMs extends Component{

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

export default RegisterRaceMobileMs

if(document.getElementById('register-race-mobile-ms')){
    ReactDOM.render(<RegisterRaceMobileMs />, document.getElementById('register-race-mobile-ms'))
}
