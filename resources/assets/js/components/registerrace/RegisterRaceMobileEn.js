import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { Avatar, Tabs } from 'antd';
import RegisterRaceModal from './RegisterRaceModalEn';
import axios from 'axios';
import CountUp from 'react-countup';

class RegisterRaceMobileEn extends Component{

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

export default RegisterRaceMobileEn

if(document.getElementById('register-race-mobile-en')){
    ReactDOM.render(<RegisterRaceMobileEn />, document.getElementById('register-race-mobile-en'))
}
