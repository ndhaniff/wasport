import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { Avatar, Tabs } from 'antd';
import EditProfileModal from './components/EditProfileModalZh';
import axios from 'axios';
import CountUp from 'react-countup';

class UserProfileZh extends Component{

  constructor(){
    super();
    this.state = {
      id : window.user.id,
      name: window.user.name,
      motto: window.user.motto,
      profileimg : window.user.profileimg
    }
  }

  renderMotto(){
    if(this.state.motto == '')
      return "添加你的座右铭";
    return this.state.motto;
  }

  renderAvatar(){
    var path = window.location.origin + '/storage/uploaded/users/' + this.state.profileimg
    if(this.state.profileimg == '')
      return <Avatar size={125} icon='user'/>
    return <Avatar size={125} icon='user' src={path}/>
  }

  render(){
    return(
      <div>

          <div className="row">
            <div className="col-sm-2">
              {this.renderAvatar()}
            </div>

            <div className="col-sm-10">
              <div className="userprofile-name">{this.state.name}</div>
              <div className="userprofile-motto">{this.renderMotto()}</div>
              <div className="userprofile-id">用户ID : {this.state.id}</div>

              <EditProfileModal/>
            </div>
          </div>

      </div>
    )
  }

}

export default UserProfileZh

if(document.getElementById('user-profile-zh')){
    ReactDOM.render(<UserProfileZh />, document.getElementById('user-profile-zh'))
}
