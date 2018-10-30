import React, { Component } from 'react'
import {Tabs,Button, Divider } from 'antd'
import Profile from './subcomponent/Profile'
import Address from './subcomponent/Address'
import Password from './subcomponent/Password'

const stravaLogo = window.location.origin + '/img/strava.png';
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
        <TabPane tab="Address" key="2">
          <Address />
        </TabPane>
        <TabPane tab="Password" key="3">
          <Password />
        </TabPane>
        <TabPane tab="Strava" key="4">
          <img src= {stravaLogo} alt="Strava" /> <br /> <br />
          <MyApp token={this.state.token} stravaDisconnect={this.stravaDisconnect}/>
        </TabPane>
      </Tabs>
    )
  }

}

const MyApp = (props) => {
  if(window.strava_token != ""){
    return (
      <div>
          <Button onClick={props.stravaDisconnect}>Disconnect</Button>
      </div>
    )
  } else {
    return(
      /*<a href={"https://www.strava.com/oauth/authorize?client_id=26162&redirect_uri="+ window.location.href +"&response_type=code"}>
        <Button>Connect To Strava</Button>
      </a>*/
      <a href={"https://www.strava.com/oauth/authorize?client_id=28187&redirect_uri="+ window.location.href +"&response_type=code"}>
        <Button>Connect To Strava</Button>
      </a>
    )
  }
}

export default EditProfileTabs
