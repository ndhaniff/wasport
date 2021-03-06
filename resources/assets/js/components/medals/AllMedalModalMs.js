import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import {Button, Modal} from 'antd';
import axios from 'axios';
import CountUp from 'react-countup';
import RaceMedal from './RaceMedalMs'

class AllMedalModalMs extends Component{

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
      if(medal[i]['medal_status'] == 'false' && medal[i]['medal_message'] == 'Joined') {
        items.push(
          <div className="col-md-4">
            <Button onClick={this.showModal.bind(this)} data-id={medal[i]['mid']}>
              <img src={medal[i]['medal_grey']} />
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
      if(medal[i]['medal_status'] == 'false' && medal[i]['medal_message'] == 'Open') {
        items.push(
          <div className="col-md-4">
            <Button onClick={this.showModal.bind(this)} data-id={medal[i]['mid']}>
              <img src={medal[i]['medal_grey']} />
            </Button>
            <span id="medal-msg">Buka</span>

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
      if(medal[i]['medal_status'] == 'false' && medal[i]['medal_message'] == 'Closed') {
        items.push(
          <div className="col-md-4">
            <Button onClick={this.showModal.bind(this)} data-id={medal[i]['mid']}>
              <img src={medal[i]['medal_grey']} />
            </Button>
            <span id="medal-msg">Tutup</span>

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

export default AllMedalModalMs

if(document.getElementById('allmedals-ms')){
    ReactDOM.render(<AllMedalModalMs />, document.getElementById('allmedals-ms'))
}
