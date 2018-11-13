import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import CountUp from 'react-countup';
import OrderModal from './OrderModalEn';

const infoIC = window.location.origin + '/img/ic-info.png';

class OrdersEn extends Component{

  constructor(){
    super();
    this.state = {
      orders : window.orders,
    }
  }

  createOrderItems() {
    let items = [];

    for(var i=0; i<orders.length; i++) {
      if(orders[i]['price'] != 0) {

        items.push(
          <div>
          <div className="row">
            <div className="col-sm-5">
              <img src={orders[i]['header']} style={{width: '100%'}} />
            </div>
            <div className="col-sm-7">
              <h5>{orders[i]['title_en']}</h5>
              <p className="orders-info"><img src= {infoIC} />{orders[i]['shipment']}</p>

              <OrderModal orderID = {orders[i]['oid']} />

            </div>
          </div>
          <div id="orders-hr"></div>
          </div>)

      }
    }

    return items;
  }

  render(){

    return(
      <div>
        {this.createOrderItems()}
      </div>
    )
  }

}

export default OrdersEn

if(document.getElementById('user-orders-en')){
    ReactDOM.render(<OrdersEn />, document.getElementById('user-orders-en'))
}
