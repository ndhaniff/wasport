import React, {Component} from 'react';
import {Button, Modal} from 'antd'


const certIC = window.location.origin + '/img/ic-cert.png';

class CertModalMs extends Component {

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
        Sijil anda akan diberikan selepas acara tamat dan anda telah menyelesaikan jarak yang diperlukan
        </Modal>
    }
    if(this.props.raceStatus == 'success'){
      var showmodal = <Modal
        visible={this.state.visible}
        onOk={this.handleOk}
        onCancel={this.handleCancel}
        width={'850px'}
        footer={[
          <a href="#" download="certificate.jpg" className="ant-button" id="btn-download-canvas" onClick={this.downloadCanvas}>Muat Turun</a>,
        ]} >
      Show certificate
      </Modal>
    }


    return (
      <div>

        <Button onClick={this.showModal}>
          <img src= {certIC} /><br />
          <span>Sijil</span></Button>

          {showmodal}

      </div>
    )
  }
}

export default CertModalMs;
