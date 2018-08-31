
import React, {Component} from 'react';
import {Button, Modal } from 'antd'
import AddPostForm from './subcomponent/AddPostForm'

class AddPostModal extends Component {

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
        <Button onClick={this.showModal}>Add Feed</Button>
        <Modal
        visible={this.state.visible}
        onOk={this.handleOk}
        onCancel={this.handleCancel}
        footer={null}
      >
      <h3>Submit Run</h3>
      <hr/>
      <AddPostForm />
      </Modal>
      </div>
    )
  }
}

export default AddPostModal;