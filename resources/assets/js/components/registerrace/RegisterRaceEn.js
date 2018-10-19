import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { Avatar, Tabs } from 'antd';
import RegisterRaceModal from './RegisterRaceModalEn';
import axios from 'axios';
import CountUp from 'react-countup';

class RegisterRaceEn extends Component{

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

export default RegisterRaceEn

if(document.getElementById('register-race-en')){
    ReactDOM.render(<RegisterRaceEn />, document.getElementById('register-race-en'))
}
