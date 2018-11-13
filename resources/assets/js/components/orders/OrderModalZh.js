import React, {Component} from 'react';
import {Button, Modal} from 'antd'
import OrderDetails from './OrderDetailsZh'

class OrderModalZh extends Component {

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
          <span>查看订单</span></Button>

        <Modal
          visible={this.state.visible}
          onOk={this.handleOk}
          onCancel={this.handleCancel}
          width={'500px'}
          footer={false} >
          <OrderDetails orderID = {this.props.orderID}/>
        </Modal>
      </div>
    )
  }
}

export default OrderModalZh;
