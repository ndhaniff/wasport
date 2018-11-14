import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { Avatar, Tabs } from 'antd';
import RegisterRaceModal from './RegisterRaceModalZh';
import axios from 'axios';
import CountUp from 'react-countup';

class RegisterRaceMobileZh extends Component{

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

export default RegisterRaceMobileZh

if(document.getElementById('register-race-mobile-zh')){
    ReactDOM.render(<RegisterRaceMobileZh />, document.getElementById('register-race-mobile-zh'))
}
