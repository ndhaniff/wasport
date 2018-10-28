import React, {Component} from 'react';
import {Button, Modal} from 'antd'


const certIC = window.location.origin + '/img/ic-cert.png';

class CertModalEn extends Component {

  constructor(){
    super();
    this.state = {
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

  downloadCanvas = (event) => {
    this.refs.canvas.toDataURL("image/jpg");
  }

  render(){

    if(this.props.raceStatus == null || this.props.raceStatus == 'fail') {
      var showmodal = <Modal
        visible={this.state.visible}
        onOk={this.handleOk}
        onCancel={this.handleCancel}
        width={'850px'} >
        Your certificate will be given when the race submission period ends and you completed the required distance
        </Modal>
    }
    if(this.props.raceStatus == 'success'){
      var showmodal = <Modal
        visible={this.state.visible}
        onOk={this.handleOk}
        onCancel={this.handleCancel}
        width={'850px'}
        footer={[
          <a href="#" download="certificate.jpg" className="ant-button" id="btn-download-canvas" onClick={this.downloadCanvas}>Download</a>,
        ]} >
      Show certificate
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
