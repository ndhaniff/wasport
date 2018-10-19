import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { Avatar, Tabs } from 'antd';
import RegisterRaceModal from './RegisterRaceModalZh';
import axios from 'axios';
import CountUp from 'react-countup';

class RegisterRaceZh extends Component{

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

export default RegisterRaceZh

if(document.getElementById('register-race-zh')){
    ReactDOM.render(<RegisterRaceZh />, document.getElementById('register-race-zh'))
}
