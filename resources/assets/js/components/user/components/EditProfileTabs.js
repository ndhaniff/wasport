import React, { Component } from 'react'
import {Tabs,Button, Divider } from 'antd'

const TabPane = Tabs.TabPane;

function callback(key) {
  console.log(key);
}

class EditProfileTabs extends Component{

  constructor(){
    super()
    this.state = {
      code : window.token
    }
  }

  render(){
    return(
      <Tabs defaultActiveKey="1" onChange={callback}>
        <TabPane tab="Profile" key="1">Content of Tab Pane 1</TabPane>
        <TabPane tab="Address" key="2">Content of Tab Pane 2</TabPane>
        <TabPane tab="Password" key="3">Content of Tab Pane 3</TabPane>
        <TabPane tab="My Apps" key="4">
          <MyApp code={this.state.token}/>
        </TabPane>
      </Tabs>
    )
  }

}

const MyApp = (props) => {
  if(typeof props.token != "undefined"){
    return (
      <div>
        {console.log(props.token)}
        <Button>Disconnect</Button>
      </div>
    )
  } else {
    return(
      <a href="https://www.strava.com/oauth/authorize?client_id=26162&redirect_uri=http://localhost:8000/en/dashboard&response_type=code">
        <Button>Connect To Strava</Button>
      </a>
    )
  }
}

export default EditProfileTabs