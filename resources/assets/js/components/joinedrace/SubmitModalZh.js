import React, {Component} from 'react';
import {Button, Modal} from 'antd'

const submitIC = window.location.origin + '/img/ic-submit.png';

class SubmitModalZh extends Component {

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
          <span>提交</span></Button>

        <Modal
          visible={this.state.visible}
          onOk={this.handleOk}
          onCancel={this.handleCancel}
          width={'850px'}
          footer={false} >
          Show submit form
        </Modal>
      </div>
    )
  }
}

export default SubmitModalZh;
