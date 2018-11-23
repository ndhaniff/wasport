import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { Button, Select, List, Switch } from 'antd';
import axios from 'axios';
import CountUp from 'react-countup';

class OfflineEn extends Component{

  constructor(){
    super();
    this.state = {
      offline: window.offline,
      current_state: 'all',
      showAll: 'true'
    }
  }

  handleStateChange = (stateChange) => {
    this.setState({ current_state: stateChange })
  }

  render(){

    let listdata = []

    for(var i=0; i<offline.length; i++) {

      let gotolink = "\\offlinedetails\\" + offline[i]['fid']

      if(offline[i]['state'] == this.state.current_state) {
        listdata.push({
          title: offline[i]['title_en'],
          location: offline[i]['location'],
          category: offline[i]['category'],
          day: offline[i]['day'],
          month: offline[i]['month'],
          year: offline[i]['year'],
          link : gotolink
        })
      }
      if(this.state.current_state == 'all') {
        listdata.push({
          title: offline[i]['title_en'],
          location: offline[i]['location'],
          category: offline[i]['category'],
          day: offline[i]['day'],
          month: offline[i]['month'],
          year: offline[i]['year'],
          link : gotolink
        })
      }
    }

    return(
      <div>
          <div className="row" id="offline-select">
            <Select defaultValue="all" style={{ width: 200 }} onChange={this.handleStateChange}>
              <Option value="all">All</Option>
              <option value="Johor">Johor</option>
              <option value="Kedah">Kedah</option>
              <option value="Kelantan">Kelantan</option>
              <option value="Kuala Lumpur">Kuala Lumpur</option>
              <option value="Labuan">Labuan</option>
              <option value="Melaka">Melaka</option>
              <option value="Negeri Sembilan">Negeri Sembilan</option>
              <option value="Pahang">Pahang</option>
              <option value="Perak">Perak</option>
              <option value="Perlis">Perlis</option>
              <option value="Pulau Pinang">Pulau Pinang</option>
              <option value="Sabah">Sabah</option>
              <option value="Sarawak">Sarawak</option>
              <option value="Selangor">Selangor</option>
              <option value="Terengganu">Terengganu</option>
              </Select>
          </div> <br />

          <List
            itemLayout="horizontal"
            dataSource={listdata}
            renderItem={item => (
              <List.Item>
              <List.Item.Meta
                avatar={<div id="offline-date-block"><h3><span id="first">{item.day}</span><br /><span id="second">{item.month} '{item.year}</span></h3></div>}
                title={<a href={item.link}>{item.title}</a>}
                description={<div>{item.location}<br />{item.category}</div>}
              />
              </List.Item>
            )}
          />
      </div>
    )
  }

}

export default OfflineEn

if(document.getElementById('offline-en')){
    ReactDOM.render(<OfflineEn />, document.getElementById('offline-en'))
}
