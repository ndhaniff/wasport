import React, { Component } from 'react'
import {Tabs,Button, Divider } from 'antd'
import Profile from './subcomponent/ProfileMs'
import Address from './subcomponent/AddressMs'
import Password from './subcomponent/PasswordMs'

const TabPane = Tabs.TabPane;

function callback(key) {
  console.log(key);
}

class EditProfileTabsMs extends Component{

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
        <TabPane tab="Profil" key="1">
          <Profile />
        </TabPane>
        <TabPane tab="Alamat" key="2">
          <Address />
        </TabPane>
        <TabPane tab="Kata Laluan" key="3">
          <Password />
        </TabPane>
        <TabPane tab="Strava" key="4">
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
          <Button onClick={props.stravaDisconnect}>Menghentikan</Button>
      </div>
    )
  } else {
    return(
      <a href={"https://www.strava.com/oauth/authorize?client_id=26162&redirect_uri="+ window.location.href +"&response_type=code"}>
        <Button>Menyambung Ke Strava</Button>
      </a>
    )
  }
}

export default EditProfileTabsMs
