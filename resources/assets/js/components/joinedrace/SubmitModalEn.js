import React, {Component} from 'react';
import {Button, Modal} from 'antd'
import Submission from './SubmitFormEn'

const submitIC = window.location.origin + '/img/ic-submit.png';

class SubmitModalEn extends Component {

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

  render(){

    return (
      <div>
        <Button onClick={this.showModal}>
          <img src= {submitIC} /><br />
          <span>Submission</span></Button>

        <Modal
          visible={this.state.visible}
          onOk={this.handleOk}
          onCancel={this.handleCancel}
          width={'850px'}
          footer={false} >
          <Submission />
        </Modal>
      </div>
    )
  }
}

export default SubmitModalEn;
