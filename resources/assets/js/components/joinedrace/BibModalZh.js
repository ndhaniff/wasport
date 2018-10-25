import React, {Component} from 'react';
import {Button, Modal } from 'antd'
import RaceBib from './RaceBib'

const bibIC = window.location.origin + '/img/ic-bib.png';

class BibModalZh extends Component {

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
    return (
      <div>

        <Button onClick={this.showModal}>
          <img src= {bibIC} /><br />
          <span>号码布</span></Button>

        <Modal
          visible={this.state.visible}
          onOk={this.handleOk}
          onCancel={this.handleCancel}
          width={'850px'}
          footer={[
            <a href="#" download="race_bib.jpg" className="ant-button" id="btn-download-canvas" onClick={this.downloadCanvas}>Download</a>,
          ]} >
          <RaceBib raceCategory = {this.props.raceCategory}/>
        </Modal>
      </div>
    )
  }
}

export default BibModalZh;
