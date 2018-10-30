import React, { Component } from 'react'
import {Tabs,Button, Divider } from 'antd'
import Profile from './subcomponent/ProfileZh'
import Address from './subcomponent/AddressZh'
import Password from './subcomponent/PasswordZh'

const stravaLogo = window.location.origin + '/img/strava.png';
const TabPane = Tabs.TabPane;

function callback(key) {
  console.log(key);
}

class EditProfileTabsZh extends Component{

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
        <TabPane tab="个人资料" key="1">
          <Profile />
        </TabPane>
        <TabPane tab="邮寄地址" key="2">
          <Address />
        </TabPane>
        <TabPane tab="密码" key="3">
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
  if(typeof props.token != "undefined"){
    return (
      <div>
          <Button onClick={props.stravaDisconnect}>终止</Button>
      </div>
    )
  } else {
    return(
      <a href={"https://www.strava.com/oauth/authorize?client_id=28187&redirect_uri="+ window.location.href +"&response_type=code"}>
        <Button>连线</Button>
      </a>
    )
  }
}

export default EditProfileTabsZh
