import React, {Component} from 'react';
import {Button, Modal } from 'antd'
import EditProfileTabs from './EditProfileTabsZh'

class EditProfileModalZh extends Component {

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
      <div className="user-edit">
        <Button onClick={this.showModal}>编辑个人资料</Button>

        <Modal
          visible={this.state.visible}
          onOk={this.handleOk}
          onCancel={this.handleCancel}
          footer={null} >
        <EditProfileTabs/>
        </Modal>
      </div>
    )
  }
}

export default EditProfileModalZh;
