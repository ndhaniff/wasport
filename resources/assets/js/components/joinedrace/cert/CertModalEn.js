import React, {Component} from 'react';
import {Button, Modal} from 'antd'
import Certificate from './Certificate'

const certIC = window.location.origin + '/img/ic-cert.png';

class CertModalEn extends Component {

  constructor(){
    super();
    this.state = {
      allmedal : window.allmedal,
      imgData: ''
    }
  }

  state = { visible: false }

  showModal = () => {
    this.setState({
      visible: true,
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

  render(){

    for(var i=0; i<allmedal.length; i++) {
      if(allmedal[i]['races_id'] == this.props.raceID) {
        var certItem = <Certificate raceCategory = {this.props.raceCategory} raceTitle = {this.props.raceTitle}
                                    certImg = {allmedal[i]['cert_img']} raceID = {this.props.raceID} />
      }
    }

    if(this.props.raceStatus == 'success'){
      var showmodal = <Modal
        visible={this.state.visible}
        onOk={this.handleOk}
        onCancel={this.handleCancel}
        width={'890px'}
        footer={false} >
        {certItem}
      </Modal>
    } else {
      var showmodal = <Modal
        visible={this.state.visible}
        onOk={this.handleOk}
        onCancel={this.handleCancel}
        width={'500px'} >
        Your certificate will be given when the race submission period ends and you completed the required distance
        </Modal>
    }

    return (
      <div>
        <Button onClick={this.showModal}>
          <img src= {certIC} /><br />
          <span>Certificate</span></Button>
          {showmodal}
      </div>
    )
  }
}

export default CertModalEn;
