import React, {Component} from 'react';
import {Button, Modal } from 'antd'
import RegisterRaceForm from './RegisterRaceFormMs'

class RegisterRaceModalMs extends Component {

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
        <Button onClick={this.showModal} className="race-register-btn">Daftar</Button>

        <Modal
          visible={this.state.visible}
          onOk={this.handleOk}
          onCancel={this.handleCancel}
          footer={null} >
        <RegisterRaceForm/>
        </Modal>
      </div>
    )
  }
}

export default RegisterRaceModalMs;
