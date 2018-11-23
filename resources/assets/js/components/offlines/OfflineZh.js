import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { Button, Select, List, Switch } from 'antd';
import axios from 'axios';
import CountUp from 'react-countup';

class OfflineZh extends Component{

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
          title: offline[i]['title_zh'],
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
          title: offline[i]['title_zh'],
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
              <Option value="all">全部</Option>
              <option value="Johor">柔佛</option>
              <option value="Kedah">吉打</option>
              <option value="Kelantan">吉兰丹</option>
              <option value="Kuala Lumpur">吉隆坡</option>
              <option value="Labuan">纳闽</option>
              <option value="Melaka">马六甲</option>
              <option value="Negeri Sembilan">森美兰</option>
              <option value="Pahang">彭亨</option>
              <option value="Perak">霹雳</option>
              <option value="Perlis">玻璃市</option>
              <option value="Pulau Pinang">槟城</option>
              <option value="Sabah">沙巴</option>
              <option value="Sarawak">砂劳越</option>
              <option value="Selangor">雪兰莪</option>
              <option value="Terengganu">登嘉楼</option>
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

export default OfflineZh

if(document.getElementById('offline-zh')){
    ReactDOM.render(<OfflineZh />, document.getElementById('offline-zh'))
}
