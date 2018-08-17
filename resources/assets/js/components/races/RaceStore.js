import React, { Component } from 'react'

export const {Provider, Consumer} = React.createContext

export default class RaceStore extends Component{

  constructor(){
    super()
    this.state = {

    }
  }

  render(){
    return(
      <Provider value={{

      }}>
        {this.props.children}
      </Provider>
    )
  }

}
