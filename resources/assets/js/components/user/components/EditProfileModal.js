
import React, {Component} from 'react';
import {Button, Modal } from 'antd'
import EditProfileTabs from './EditProfileTabs'

class EditProfileModal extends Component {

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
        <Button onClick={this.showModal}>Edit Profile</Button>
        <Modal
        visible={this.state.visible}
        onOk={this.handleOk}
        onCancel={this.handleCancel}
        footer={null}
      >
        <EditProfileTabs/>
      </Modal>
      </div>
    )
  }
}

export default EditProfileModal;