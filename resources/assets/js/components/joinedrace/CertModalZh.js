import React, {Component} from 'react';
import {Button, Modal} from 'antd'
import Cert from './Certificate'

const certIC = window.location.origin + '/img/ic-cert.png';

class CertModalZh extends Component {

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

  downloadCanvas = () => {
    var temp = this.refs.canvas.toDataURL("image/png;base64;")
    this.setState({ imgData: temp })
  }

  render(){

    for(var i=0; i<allmedal.length; i++) {
      if(allmedal[i]['races_id'] == this.props.raceID) {
        var certItem = <Certificate raceCategory = {this.props.raceCategory} raceTitle = {this.props.raceTitle} certImg = {allmedal[i]['cert_img']} />
      }
    }

    if(this.props.raceStatus == null || this.props.raceStatus == 'fail') {
      var showmodal = <Modal
        visible={this.state.visible}
        onOk={this.handleOk}
        onCancel={this.handleCancel}
        width={'850px'} >
        证书将在赛事结束与上传里程后颁发
        </Modal>
    }
    if(this.props.raceStatus == 'success'){
      var showmodal = <Modal
        visible={this.state.visible}
        onOk={this.handleOk}
        onCancel={this.handleCancel}
        width={'850px'}
        footer={[
          <a href="#" download="certificate.jpg" className="ant-button" id="btn-download-canvas" onClick={this.downloadCanvas}>下载</a>,
        ]} >
        {certItem}
      </Modal>
    }


    return (
      <div>
        <Button onClick={this.showModal}>
          <img src= {certIC} /><br />
          <span>证书</span></Button>
          {showmodal}
      </div>
    )
  }
}

export default CertModalZh;
