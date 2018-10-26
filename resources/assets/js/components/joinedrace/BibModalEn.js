import React, {Component} from 'react';
import {Button, Modal} from 'antd'
import RaceBib from './RaceBib'

const bibIC = window.location.origin + '/img/ic-bib.png';

class BibModalEn extends Component {

  constructor(){
    super();
    this.state = {
      allmedal : window.allmedal
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

    for(var i=0; i<allmedal.length; i++) {
      if(allmedal[i]['races_id'] == this.props.raceID) {
        var racebib = <RaceBib raceCategory = {this.props.raceCategory} bibImg = {allmedal[i]['bib_img']}/>
      }
    }

    return (
      <div>

        <Button onClick={this.showModal}>
          <img src= {bibIC} /><br />
          <span>Race bib</span></Button>

        <Modal
          visible={this.state.visible}
          onOk={this.handleOk}
          onCancel={this.handleCancel}
          width={'850px'}
          footer={[
            <a href="#" download="race_bib.jpg" className="ant-button" id="btn-download-canvas" onClick={this.downloadCanvas}>Download</a>,
          ]} >
          {racebib}
        </Modal>
      </div>
    )
  }
}

export default BibModalEn;
