import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import {Button, Modal} from 'antd';
import axios from 'axios';
import CountUp from 'react-countup';
import RaceMedal from './RaceMedalMs'

class MyMedalModalMs extends Component{

  constructor(){
    super();
    this.state = {
      medal : window.medal,
      medalID : '',
    }
  }

  state = { visible: false }

  showModal = (e) => {
    this.setState({
      visible: true,
      medalID: e.currentTarget.dataset.id
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
      if(medal[i]['medal_status'] == 'true') {
        items.push(
          <div className="col-md-4">
            <Button onClick={this.showModal.bind(this)} data-id={medal[i]['mid']}>
              <img src={medal[i]['medal_color']} />
            </Button>
            <span id="medal-msg">Sertai</span>

            <Modal
              visible={this.state.visible}
              onOk={this.handleOk}
              onCancel={this.handleCancel}
              maskStyle={{backgroundColor: 'rgba(0,0,0,.2)'}}
              footer={false} >
              <RaceMedal medalID={this.state.medalID} />
            </Modal>

          </div>)
      }
    }

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

export default MyMedalModalMs

if(document.getElementById('mymedals-ms')){
    ReactDOM.render(<MyMedalModalMs />, document.getElementById('mymedals-ms'))
}
