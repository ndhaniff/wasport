import React, { Component } from 'react'

export const {Provider, Consumer} = React.createContext()

class AdminContext extends Component{

  constructor(){
    super()
    this.state = {}
  }

  render(){
    return(
      <Provider value={{
          state : this.state,
        }}>
        {this.props.children}
      </Provider>
    )
  }

}

export default AdminContext