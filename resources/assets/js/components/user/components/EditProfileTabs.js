import React, { Component } from 'react'
import {Tabs,Button, Divider } from 'antd'
import Profile from './subcomponent/Profile'

const TabPane = Tabs.TabPane;

function callback(key) {
  console.log(key);
}

class EditProfileTabs extends Component{

  constructor(){
    super()
    this.form = React.createRef();
    this.state = {
      token : window.token
    }
  }

  stravaDisconnect = () => {
    axios.post('/strava/disconnect')
    .then((res) => {
      console.log(res)
      location.reload()
    })
  }

  render(){
    return(
      <Tabs defaultActiveKey="1" onChange={callback}>
        <TabPane tab="Profile" key="1">
          <Profile />
        </TabPane>
        <TabPane tab="Address" key="2">Content of Tab Pane 2</TabPane>
        <TabPane tab="Password" key="3">Content of Tab Pane 3</TabPane>
        <TabPane tab="My Apps" key="4">
          <MyApp token={this.state.token} stravaDisconnect={this.stravaDisconnect}/>
        </TabPane>
      </Tabs>
    )
  }

}

const MyApp = (props) => {
  if(typeof props.token != "undefined"){
    return (
      <div>
          <Button onClick={props.stravaDisconnect}>Disconnect</Button>
      </div>
    )
  } else {
    return(
      <a href={"https://www.strava.com/oauth/authorize?client_id=26162&redirect_uri="+ window.location.href +"&response_type=code"}>
        <Button>Connect To Strava</Button>
      </a>
    )
  }
}


export default EditProfileTabs