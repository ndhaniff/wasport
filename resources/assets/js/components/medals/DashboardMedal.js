import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import {Button, Modal} from 'antd';
import axios from 'axios';
import CountUp from 'react-countup';
import RaceMedal from './RaceMedal'

class DashboardMedal extends Component{

  constructor(){
    super();
    this.state = {
      medal : window.medal
    }
  }

  state = { visible: false }

  showModal = (mid) => {
    this.setState({
      visible: true,
      medalID: mid,
      medalInfo: medal
    });
  }

  handleOk = (e) => {
    console.log(e);
    this.setState({
      visible: false,
    });
  }

  handleCancel = (e) => {
    console.log(e);
    this.setState({
      visible: false,
    });
  }

  createMedalItems() {
    let items = [];

    for(var i=0; i<medal.length; i++) {
      items.push(
        <div className="col-md-4">
          <Button onClick={this.showModal(medal[i]['mid'])} >
            <img src={medal[i]['grey_medal']} />
          </Button>

          <Modal
            visible={this.state.visible}
            onOk={this.handleOk}
            onCancel={this.handleCancel}
            footer={false} >
            <RaceMedal medalID = {this.state.medalID}/>
          </Modal>
        </div>)}

    return items;
  }

  render(){

    return(
      <div className="row">
        {this.createMedalItems()}
      </div>
    )
  }

}

export default DashboardMedal

if(document.getElementById('dashboard-medal-en')){
    ReactDOM.render(<DashboardMedal />, document.getElementById('dashboard-medal-en'))
}